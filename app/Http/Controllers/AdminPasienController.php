<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPasienController extends Controller
{
    public function index()
    {
        //
        $data= [
            'title' => 'Manajemen Pasien',
            'pasien' => Pasien::get(),
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
        $data= [
            'title' => 'Tambah Pasien',
            'content' => 'admin.pasien.create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'penanganan' => 'required',

        ]);

        Pasien::create($data);
        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect('/admin/pasien');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $role= Role::with('gejala')->wherepasien_id($id)->get();
        $data= [
            'title' => 'Pasien',
            'pasien' => Pasien::find($id),
            'gejala' => Gejala::Get(),
            'role' => $role,
            'content' => 'admin.pasien.show'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data= [
            'title' => 'Edit Pasien',
            'pasien' => Pasien::find($id),
            'content' => 'admin.pasien.create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $pasien = Pasien::find($id);
        $data = $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'penanganan' => 'required',
        ]);

        $pasien->update($data);
        Alert::success('Success', 'Data berhasil diubah');
        return redirect('/admin/pasien');
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

    function addGejala(Request $request){
        $data = [
            'pasien_id' => $request->pasien_id,
            'gejala_id' => $request->gejala_id,
            'bobot_cf' => $request->bobot_cf,
        ];

        Role::create($data);
        Alert::success('Success', 'Data berhasil Tersimpan');
        return redirect('/admin/pasien/'.$request->pasien_id);
    }

    function deleteRole($id){        
        $role = Role::find($id);
        $role->delete();
        Alert::success('Success', 'Data berhasil Dihapus');
        return redirect('/admin/pasien/'.$role->pasien_id);
    }
}
