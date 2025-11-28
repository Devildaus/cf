<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Diagnosa;

class AdminPasienController extends Controller
{
    public function index()
    {
        //
        $data= [
            'title' => 'Manajemen Pasien',
            'pasien' => Pasien::with('penyakit')->orderBy('created_at','DESC')->paginate(10),
            'content' => 'admin.pasien.index'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        // $role= Role::with('gejala')->wherepasien_id($id)->get();
        // $data= [
        //     'title' => 'Pasien',
        //     'pasien' => Pasien::find($id),
        //     'gejala' => Gejala::Get(),
        //     'role' => $role,
        //     'content' => 'admin.pasien.show'
        // ];
        // return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // die('masuk');
        $pasien = Pasien::find($id);
        $pasien->delete();
        Alert::success('Success', 'Data berhasil dihapus');
        return redirect('/admin/pasien');
    }

    public function print($pasien_id)
    {
        
        $data= [
            'title' => 'Hasil Diagnosa',
            'pasien' => Pasien::with('penyakit')->Find($pasien_id),
            'gejala' => Diagnosa::with('gejala')->wherePasienId($pasien_id)->get(),            
        ];
        return view('admin.pasien.cetak', $data);
    }



    public function showKirimWaForm($pasien_id)
    {
        $pasien = Pasien::with('penyakit')->find($pasien_id);
        $gejala = Diagnosa::with('gejala')->wherePasienId($pasien_id)->get();

        $data = [
            'title' => 'Kirim Hasil ke WhatsApp',
            'pasien' => $pasien,
            'gejala' => $gejala,
            'preview_pesan' => $this->formatPreviewPesan($pasien, $gejala),
            'content' => 'admin.pasien.kirim-wa'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Format preview pesan untuk ditampilkan di form
     */
    private function formatPreviewPesan($pasien, $gejala)
    {
        $penyakit = $pasien->penyakit;
        $pesan = "HASIL DIAGNOSA PENYAKIT\n\n";
        $pesan .= "Data Pasien:\n";
        $pesan .= "• Nama: {$pasien->name}\n";
        $pesan .= "• Umur: {$pasien->umur} Tahun\n\n";
        
        $pesan .= "Hasil Diagnosa:\n";
        if (isset($penyakit)) {
            $pesan .= "• Nama Penyakit: {$penyakit->name}\n";
            $pesan .= "• Tingkat Kepercayaan: " . round($pasien->persentase) . "%\n";
        } else {
            $pesan .= "• Hasil: Gejala Tidak Akurat\n";
        }
        
        $pesan .= "\nGejala yang Dialami:\n";
        $counter = 1;
        foreach ($gejala as $item) {
            if ($item->cf_hasil != 0) {
                $pesan .= "{$counter}. {$item->gejala->name}\n";
                $counter++;
            }
        }
        
        $pesan .= "\n---\n";
        $pesan .= "Catatan: Hasil ini merupakan diagnosa sistem, disarankan untuk konsultasi dengan dokter.";
        
        return $pesan;
    }

    /**
     * Kirim hasil diagnosa ke WhatsApp
     */
    public function kirimWhatsApp(Request $request, $pasien_id)
    {
        $request->validate([
            'nomor_wa' => 'required|string'
        ]);

        $pasien = Pasien::with('penyakit')->find($pasien_id);
        $gejala = Diagnosa::with('gejala')->wherePasienId($pasien_id)->where('cf_hasil', '!=', 0)->get();

        // Format nomor WhatsApp (hilangkan karakter selain angka)
        $nomor_wa = preg_replace('/[^0-9]/', '', $request->nomor_wa);
        
        // Jika nomor diawali dengan 0, ganti dengan 62
        if (substr($nomor_wa, 0, 1) === '0') {
            $nomor_wa = '62' . substr($nomor_wa, 1);
        }

        // Buat pesan WhatsApp
        $pesan = $this->formatPesanWhatsApp($pasien, $gejala);

        // Encode pesan untuk URL
        $pesan_encoded = urlencode($pesan);

        // Redirect ke WhatsApp
        $wa_url = "https://wa.me/{$nomor_wa}?text={$pesan_encoded}";

        return redirect($wa_url);
    }

    /**
     * Format pesan WhatsApp untuk dikirim
     */
    private function formatPesanWhatsApp($pasien, $gejala)
    {
        $penyakit = $pasien->penyakit;
        
        $pesan = "🔬 *HASIL DIAGNOSA PENYAKIT*\n\n";
        $pesan .= "📋 *Data Pasien:*\n";
        $pesan .= "• Nama: {$pasien->name}\n";
        $pesan .= "• Umur: {$pasien->umur} Tahun\n\n";
        
        $pesan .= "🏥 *Hasil Diagnosa:*\n";
        
        if (isset($penyakit)) {
            $pesan .= "• Nama Penyakit: {$penyakit->name}\n";
            $pesan .= "• Tingkat Kepercayaan: " . round($pasien->persentase) . "%\n\n";
            
            $pesan .= "📝 *Deskripsi:*\n";
            $pesan .= "{$penyakit->desc}\n\n";
            
            $pesan .= "💊 *Penanganan:*\n";
            $pesan .= "{$penyakit->penanganan}\n\n";
        } else {
            $pesan .= "• Hasil: Gejala Tidak Akurat. Silahkan Diagnosa Ulang\n\n";
        }
        
        $pesan .= "🩺 *Gejala yang Dialami:*\n";
        $counter = 1;
        foreach ($gejala as $item) {
            $pesan .= "{$counter}. {$item->gejala->name} (Nilai: {$item->cf_hasil})\n";
            $counter++;
        }
        
        $pesan .= "\n---\n";
        $pesan .= "*Catatan:* Hasil ini merupakan diagnosa sistem, disarankan untuk konsultasi dengan dokter untuk penanganan lebih lanjut.\n\n";
        $pesan .= "Terima kasih 🙏";

        return $pesan;
    }

    
}
