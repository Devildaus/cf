<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Diagnosa;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPasienController extends Controller
{
    // ... Method index, create, store, edit, update, destroy, print BIARKAN SAMA ...
    // ... (Saya skip kode CRUD standar agar fokus ke perbaikan WA) ...

    public function index()
    {
        $data= [
            'title' => 'Manajemen Pasien',
            'pasien' => Pasien::with('penyakit')->orderBy('created_at','DESC')->paginate(10),
            'content' => 'admin.pasien.index'
        ];
        return view('admin.layouts.wrapper', $data);
    }
    
    public function destroy(string $id)
    {
        $pasien = Pasien::find($id);
        if($pasien){
             $pasien->delete();
             Alert::success('Success', 'Data berhasil dihapus');
        } else {
             Alert::error('Error', 'Data tidak ditemukan');
        }
        return redirect('/admin/pasien');
    }

    public function print($pasien_id)
    {
        $data= [
            'title' => 'Hasil Diagnosa',
            'pasien' => Pasien::with('penyakit')->findOrFail($pasien_id), // Pakai findOrFail biar aman
            'gejala' => Diagnosa::with('gejala')->wherePasienId($pasien_id)->get(),            
        ];
        return view('admin.pasien.cetak', $data);
    }

    // === AREA LOGIKA PENGIRIMAN WA ===

    public function showKirimWaForm($pasien_id)
    {
        $pasien = Pasien::with('penyakit')->findOrFail($pasien_id);
        
        // Ambil gejala yang CF-nya tidak 0 (hanya yang dialami)
        $gejala = Diagnosa::with('gejala')
                    ->wherePasienId($pasien_id)
                    ->where('cf_hasil', '!=', 0)
                    ->get();

        $data = [
            'title' => 'Kirim Hasil ke WhatsApp',
            'pasien' => $pasien,
            'gejala' => $gejala,
            // Reuse satu fungsi formatter untuk preview
            'preview_pesan' => $this->generateMessage($pasien, $gejala, true), 
            'content' => 'admin.pasien.kirim-wa'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    public function kirimWhatsApp(Request $request, $pasien_id)
    {
        $request->validate([
            'nomor_wa' => 'required|numeric' // Pastikan angka saja
        ]);

        try {
            $pasien = Pasien::with('penyakit')->findOrFail($pasien_id);
            $gejala = Diagnosa::with('gejala')->wherePasienId($pasien_id)->where('cf_hasil', '!=', 0)->get();

            // 1. Sanitasi Nomor HP (Hapus karakter aneh, handle +62, 08, 62)
            $nomor_wa = $this->sanitizePhoneNumber($request->nomor_wa);

            // 2. Generate Pesan
            $pesan = $this->generateMessage($pasien, $gejala, false); // false = format WA (bold pake *)

            // 3. Ambil Token dari Config (Bukan env langsung)
            $token = config('services.fonnte.token');

            if(empty($token)){
                Alert::error('Gagal', 'Token Fonnte belum disetting!');
                return back();
            }

            // 4. Kirim Request (Pakai Timeout agar tidak loading selamanya jika fonnte down)
            $response = Http::timeout(10) // Maksimal loading 10 detik
                ->withHeaders(['Authorization' => $token])
                ->post('https://api.fonnte.com/send', [
                    'target' => $nomor_wa,
                    'message' => $pesan,
                    'countryCode' => '62', 
                ]);

            // 5. Cek Response
            $respBody = $response->json(); // Langsung array

            if ($response->successful() && ($respBody['status'] ?? false) == true) {
                Alert::success('Berhasil', 'Pesan dalam antrian pengiriman WhatsApp.');
            } else {
                $reason = $respBody['reason'] ?? 'Masalah koneksi ke Fonnte';
                Alert::error('Gagal', 'Fonnte Error: ' . $reason);
            }

        } catch (\Exception $e) {
            // Log error asli untuk developer
            \Log::error('WA Error: ' . $e->getMessage());
            Alert::error('Error', 'Terjadi kesalahan sistem. Cek log.');
        }

        return back();
    }

    /**
     * Satu fungsi untuk generate pesan (Preview & WA asli)
     * Agar tidak kerja 2x (DRY Principle)
     */
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
            
            $pesan .= "📝 {$b_open}Deskripsi:{$b_close}\n";
            $pesan .= "{$penyakit->desc}\n\n";
            
            $pesan .= "💊 {$b_open}Penanganan:{$b_close}\n";
            $pesan .= "{$penyakit->penanganan}\n\n";
        } else {
            $pesan .= "• Hasil: Gejala Tidak Akurat / Belum Terdeteksi\n\n";
        }

        // Cek hasil AI (Jika sudah implementasi kode sebelumnya)
        if (!empty($pasien->deskripsi_ai)) {
            $pesan .= "🤖 {$b_open}Analisa Tambahan AI:{$b_close}\n";
            $pesan .= "{$pasien->deskripsi_ai}\n\n";
        }
        
        $pesan .= "🩺 {$b_open}Gejala Dialami:{$b_close}\n";
        foreach ($gejala as $index => $item) {
            $no = $index + 1;
            $pesan .= "{$no}. {$item->gejala->name} ({$item->cf_hasil})\n";
        }
        
        $pesan .= "\n---\n";
        $pesan .= "_{$b_open}Catatan:{$b_close} Hasil ini diagnosa sistem, segera konsultasi ke dokter._";

        return $pesan;
    }

    /**
     * Helper sanitize nomor HP yang lebih robust
     */
    private function sanitizePhoneNumber($number)
    {
        // Hapus semua karakter kecuali angka
        $number = preg_replace('/[^0-9]/', '', $number);
        
        // Jika dimulai dengan '08', ganti '0' dengan '62'
        if (substr($number, 0, 2) === '08') {
            return '62' . substr($number, 1);
        }
        
        // Jika dimulai dengan '8', tambahkan '62' di depan
        if (substr($number, 0, 1) === '8') {
            return '62' . $number;
        }

        return $number;
    }
}