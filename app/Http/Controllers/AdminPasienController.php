<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Diagnosa;
use App\Models\Role; // Tambahkan ini untuk cek relasi gejala-penyakit
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPasienController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Manajemen Pasien',
            'pasien' => Pasien::with('penyakit')->orderBy('created_at', 'DESC')->paginate(10),
            'content' => 'admin.pasien.index'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    public function print($id)
    {
        $pasien = Pasien::with('penyakit')->findOrFail($id);

        // Gunakan LOGIKA YANG SAMA DENGAN WHATSAPP
        $gejala = $this->getRelevantSymptoms($pasien);

        return view('admin.pasien.cetak', compact('pasien', 'gejala'));
    }


    public function showKirimWaForm($pasien_id)
    {
        $pasien = Pasien::with('penyakit')->findOrFail($pasien_id);

        // Ambil gejala yang relevan dengan penyakit yang terdeteksi
        $gejala = $this->getRelevantSymptoms($pasien);

        $data = [
            'title' => 'Kirim Hasil ke WhatsApp',
            'pasien' => $pasien,
            'gejala' => $gejala,
            'preview_pesan' => $this->generateMessage($pasien, $gejala, true),
            'content' => 'admin.pasien.kirim-wa'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    public function kirimWhatsApp(Request $request, $pasien_id)
    {
        $request->validate([
            'nomor_wa' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);

        try {
            $pasien = Pasien::with('penyakit')->findOrFail($pasien_id);
            $gejala = $this->getRelevantSymptoms($pasien);

            $nomor_wa = $this->sanitizePhoneNumber($request->nomor_wa);
            $pesan = $this->generateMessage($pasien, $gejala, false);
            $token = config('services.fonnte.token');

            if (empty($token)) {
                Alert::error('Gagal', 'Token Fonnte belum dikonfigurasi!');
                return back();
            }

            $response = Http::timeout(15)
                ->withHeaders(['Authorization' => $token])
                ->post('https://api.fonnte.com/send', [
                    'target' => $nomor_wa,
                    'message' => $pesan,
                    'countryCode' => '62',
                ]);

            $respBody = $response->json();

            if ($response->successful() && ($respBody['status'] ?? false) == true) {
                Alert::success('Berhasil', 'Pesan telah masuk antrian Fonnte.');
            } else {
                $reason = $respBody['reason'] ?? 'Gagal menghubungi server Fonnte';
                Alert::error('Gagal', 'Fonnte: ' . $reason);
            }
        } catch (\Exception $e) {
            \Log::error('WA Error: ' . $e->getMessage());
            Alert::error('Error', 'Kesalahan sistem: ' . $e->getMessage());
        }

        return back();
    }

    /**
     * Logic Filter: Mengambil gejala yang dialami (CF > 0) 
     * dan hanya yang termasuk dalam kriteria penyakit hasil diagnosa.
     */
    private function getRelevantSymptoms($pasien)
    {
        // 1. Ambil ID gejala yang terikat pada penyakit yang ditemukan (Basis Aturan)
        $allowedGejalaIds = Role::where('penyakit_id', $pasien->penyakit_id)
                            ->pluck('gejala_id')
                            ->toArray();

        // 2. Filter data diagnosa pasien
        return Diagnosa::with('gejala')
            ->where('pasien_id', $pasien->id)
            ->where('cf_hasil', '>', 0) // Hanya yang dipilih user
            ->whereIn('gejala_id', $allowedGejalaIds) // Hanya yang sesuai penyakit
            ->get()
            ->unique('gejala_id'); // Pastikan tidak ada duplikasi
    }

    private function generateMessage($pasien, $gejala, $isPreview = false)
    {
        $penyakit = $pasien->penyakit;
        
        // Simbol formatting (Preview pakai HTML/Plain, WA pakai Markdown)
        $b_open  = $isPreview ? "" : "*";
        $b_close = $isPreview ? "" : "*";

        $pesan = "🔬 {$b_open}HASIL DIAGNOSA PENYAKIT{$b_close}\n\n";
        
        $pesan .= "📋 {$b_open}Data Pasien:{$b_close}\n";
        $pesan .= "• Nama: {$pasien->name}\n";
        $pesan .= "• Umur: {$pasien->umur} Tahun\n\n";
        
        $pesan .= "🏥 {$b_open}Hasil Diagnosa:{$b_close}\n";
        
        if ($penyakit) {
            $pesan .= "• Penyakit: {$penyakit->name}\n";
            $pesan .= "• Akurasi: " . round($pasien->persentase) . "%\n\n";
            
            // Logika Pengambilan Deskripsi (Prioritas AI)
            // Jika hasil AI pada tabel Pasien ada, pakai itu. Jika kosong, fallback ke deskripsi asli penyakit.
            $deskripsi = !empty($pasien->deskripsi_ai) ? $pasien->deskripsi_ai : $penyakit->desc;
            $pesan .= "📝 {$b_open}Deskripsi:{$b_close}\n{$deskripsi}\n\n";
            
            // Logika Pengambilan Penanganan (Prioritas AI)
            // Mengambil dari penanganan_ai milik pasien, jika kosong fallback ke penanganan asli.
            $penanganan = !empty($pasien->penanganan_ai) ? $pasien->penanganan_ai : $penyakit->penanganan;
            $pesan .= "💊 {$b_open}Saran Penanganan:{$b_close}\n{$penanganan}\n\n";
            
        } else {
            $pesan .= "• Hasil: Gejala Tidak Akurat / Belum Terdeteksi\n\n";
        }
        
        // Menampilkan Gejala Relevan (Hanya yang cf_hasil > 0)
        if ($gejala->count() > 0) {
            $pesan .= "🩺 {$b_open}Gejala Relevan Dialami:{$b_close}\n";
            foreach ($gejala as $index => $item) {
                $no = $index + 1;
                $pesan .= "{$no}. {$item->gejala->name}\n";
            }
        }
        
        $pesan .= "\n---\n";
        $pesan .= "_{$b_open}Catatan:{$b_close} Hasil ini merupakan diagnosa awal sistem menggunakan metode Certainty Factor dan Analisa AI. Segera konsultasikan ke Klinik Nediva Husada untuk pemeriksaan medis lebih lanjut._";

        return $pesan;
    }

    private function sanitizePhoneNumber($number)
    {
        $number = preg_replace('/[^0-9]/', '', $number);
        if (substr($number, 0, 2) === '08') {
            return '62' . substr($number, 1);
        }
        if (substr($number, 0, 1) === '8') {
            return '62' . $number;
        }
        return $number;
    }
}