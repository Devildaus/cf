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

    
}
