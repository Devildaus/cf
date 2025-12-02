<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Gejala;
use App\Models\Role;
use App\Models\Diagnosa;
use App\Models\Penyakit;
use Illuminate\Support\Facades\Http;

class AdminDiagnosaController extends Controller
{
    //
     public function index()
    {
        //
        $data= [
            'title' => 'Diagnosa Penyakit',
            'content' => 'admin.diagnosa.index'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    function createPasien(request $request){
        $data= [
            'name' => $request->name,
            'umur' => $request->umur,
        ];
        $pasien = Pasien::create($data);
        session() ->put('pasien_id', $pasien->id);
        return redirect('/admin/diagnosa/pilih-gejala');
        }


     public function pilihGejala()
    {
        //
        $pasien_id = session() ->get('pasien_id');
        $data= [
            'title' => 'Diagnosa Penyakit',
            'pasien' => Pasien::Find($pasien_id),
            'gejala' => Gejala::get(),
            'gejalaTerpilih' => Diagnosa::with('gejala')->wherePasienId($pasien_id)->groupBy('gejala_id')->get(),
            'content' => 'admin.diagnosa.pilihgejala'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    function pilih()
    {
        $gejala_id = request('gejala_id');
        $cf_user = (float) request('nilai');

        $role = Role::whereGejala_id($gejala_id)->get();
        foreach($role as $r){
            $data= [
                'pasien_id' => session() ->get('pasien_id'),
                'penyakit_id' => $r->penyakit_id,
                'gejala_id' => $gejala_id,
                'nilai_cf' => $cf_user,
                'cf_hasil' => $cf_user * (float) $r->bobot_cf
            ];
            Diagnosa::create($data);            
        }     
        // dd(request()->all());
        return redirect('/admin/diagnosa/pilih-gejala');
    
    }

    function hapusGejalaTerpilih(){
        $gejala_id = request('gejala_id');
        $pasien_id = session() ->get('pasien_id');

        $diagnosa = Diagnosa::whereGejalaId($gejala_id)->wherePasienId($pasien_id)->get();

        foreach($diagnosa as $item){
            $d = Diagnosa::Find($item->id);
            $d->delete();
        }
        return redirect('/admin/diagnosa/pilih-gejala');

    }

    function prosesDiagnosa(){
        $pasien_id = session() ->get('pasien_id');
        $hasil = 0;
        $penyakit_id = '';

        $role = Role::get();
        foreach($role as $r){
            $diagnosa = Diagnosa::wherePasienId($pasien_id)->wherePenyakitId($r->penyakit_id)->whereGejalaId($r->gejala_id)->first();

            if ($diagnosa == null) {
                $data = [
                    'pasien_id' => session() ->get('pasien_id'),
                    'penyakit_id' => $r->penyakit_id,
                    'gejala_id' => $r->gejala_id,
                    'nilai_cf' => 0,
                    'cf_hasil' => 0
                ];

                Diagnosa::create($data);
            }                      
        }

        $penyakit = Penyakit::get();
        foreach($penyakit as $p){
            $diagnosa = Diagnosa::wherePenyakitId($p->id)->wherePasienId($pasien_id)->get();
            $diagnosa_hasil = $this->hitung_cf($diagnosa);
            if ($diagnosa_hasil > $hasil){
                $hasil = $diagnosa_hasil;
                $penyakit_id = $p->id;
            }
        }

        $pasien = Pasien::Find($pasien_id);
        $pasien->akumulasi_cf = $hasil;
        $pasien->persentase = round($hasil * 100);
        $pasien->penyakit_id = $penyakit_id;
        $pasien->save();
        return redirect('/admin/diagnosa/keputusan'.'/'.$pasien_id);
    }

    // versi 1
    // function hitung_cf($data){
    //     $cf_old = 0;
    //     foreach($data as $key => $value){
    //         if ($key == 0){
    //             $cf_old = 0;
    //         } else {
    //             $cf_old = $cf_old + $value->cf_hasil * (1 - $cf_old);                
    //         }
    //     }
    //     return $cf_old;
    // }

    // veri 2
    function hitung_cf($data){
    $cf_old = null;
    foreach($data as $key => $value){
        if ($cf_old === null){
            $cf_old = $value->cf_hasil; 
        } else {
            $cf_old = $cf_old + $value->cf_hasil * (1 - $cf_old); 
        }
    }
    return $cf_old;
}

    // public function keputusan($pasien_id)
    // {
    //     //
    //     if ($pasien_id == null){
    //         $pasien_id = session() ->get('pasien_id');
    //     } 
    //     $data= [
    //         'title' => 'Hasil Diagnosa',
    //         'pasien' => Pasien::with('penyakit')->Find($pasien_id),
    //         'gejala' => Diagnosa::with('gejala')->wherePasienId($pasien_id)->get(),
    //         'content' => 'admin.diagnosa.keputusan'
    //     ];
    //     return view('admin.layouts.wrapper', $data);
    // }

    public function keputusan($pasien_id = null)
    {
        if ($pasien_id == null){
            $pasien_id = session()->get('pasien_id');
        }

        // Ambil data pasien lengkap dengan relasi penyakit
        $pasien = Pasien::with('penyakit')->findOrFail($pasien_id);
        
        // Ambil gejala yang dialami (CF > 0)
        $gejala = Diagnosa::with('gejala')
                    ->wherePasienId($pasien_id)
                    ->where('cf_hasil', '>', 0) // Hanya ambil yang dialami
                    ->get();

        // === LOGIC INTEGRASI AI VIA N8N ===
        // Kita hanya panggil AI jika field deskripsi_ai masih kosong (belum pernah digenerate)
        if (empty($pasien->deskripsi_ai) && $pasien->penyakit) {
            try {
                // 1. Siapkan Payload (Konteks untuk AI)
                $payload = [
                    'nama_pasien' => $pasien->name,
                    'umur' => $pasien->umur,
                    'diagnosa_sistem' => $pasien->penyakit->name,
                    'cf_persen' => round($pasien->persentase) . '%',
                    // Kirim data asli dari DB sebagai acuan utama AI
                    'deskripsi_original' => $pasien->penyakit->desc,
                    'penanganan_original' => $pasien->penyakit->penanganan,
                    // List gejala untuk personalisasi saran
                    'gejala_dialami' => $gejala->map(fn($g) => $g->gejala->name . " (Tingkat Keyakinan: " . $g->cf_hasil . ")")->toArray()
                ];

                // 2. Tembak ke n8n (Pastikan URL benar)
                // Timeout diset agak lama (misal 60 detik) karena AI butuh waktu mikir
                $response = Http::timeout(60)->post(env('N8N_WEBHOOK_URL', 'https://n8n.daus.my.id/webhook-test/generate-diagnosa-ai'), $payload);

                if ($response->successful()) {
                    $hasilAI = $response->json();
                    
                    // Asumsi n8n mengembalikan JSON: { "deskripsi_baru": "...", "saran_baru": "..." }
                    $pasien->update([
                        'deskripsi_ai' => $hasilAI['deskripsi_baru'] ?? $pasien->penyakit->desc,
                        'penanganan_ai' => $hasilAI['saran_baru'] ?? $pasien->penyakit->penanganan
                    ]);
                    
                    // Refresh object pasien agar data baru masuk
                    $pasien->refresh();
                }

            } catch (\Exception $e) {
                // Silent error: Jika AI gagal/timeout, biarkan kosong.
                // View akan otomatis menampilkan data original DB sebagai fallback.
                \Log::error('Gagal generate AI: ' . $e->getMessage());
            }
        }
        // === END LOGIC AI ===

        $data = [
            'title' => 'Hasil Diagnosa',
            'pasien' => $pasien,
            'gejala' => $gejala, // Kirim variabel $gejala yang sudah difilter di atas
            'content' => 'admin.diagnosa.keputusan'
        ];

        return view('admin.layouts.wrapper', $data);
    }
}
