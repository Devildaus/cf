<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Gejala;
use App\Models\Role;
use App\Models\Diagnosa;

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

    public function keputusan()
    {
        //
        $data= [
            'title' => 'Hasil Diagnosa',
            'content' => 'admin.diagnosa.keputusan'
        ];
        return view('admin.layouts.wrapper', $data);
    }
}
