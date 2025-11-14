<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyakit;
use App\Models\Gejala;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Role;

class AdminPenyakitController extends Controller
{
    public function index()
    {
        //
        $data= [
            'title' => 'Manajemen Penyakit',
            'penyakit' => Penyakit::get(),
            'content' => 'admin.penyakit.index'
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
            'title' => 'Tambah Penyakit',
            'content' => 'admin.penyakit.create'
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

        Penyakit::create($data);
        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect('/admin/penyakit');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $role= Role::with('gejala')->wherepenyakit_id($id)->get();
        $data= [
            'title' => 'Penyakit',
            'penyakit' => Penyakit::find($id),
            'gejala' => Gejala::Get(),
            'role' => $role,
            'content' => 'admin.penyakit.show'
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
            'title' => 'Edit Penyakit',
            'penyakit' => Penyakit::find($id),
            'content' => 'admin.penyakit.create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $penyakit = Penyakit::find($id);
        $data = $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'penanganan' => 'required',
        ]);

        $penyakit->update($data);
        Alert::success('Success', 'Data berhasil diubah');
        return redirect('/admin/penyakit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // die('masuk');
        $penyakit = Penyakit::find($id);
        $penyakit->delete();
        Alert::success('Success', 'Data berhasil dihapus');
        return redirect('/admin/penyakit');
    }

    function addGejala(Request $request){
        $data = [
            'penyakit_id' => $request->penyakit_id,
            'gejala_id' => $request->gejala_id,
            'bobot_cf' => $request->bobot_cf,
        ];

        Role::create($data);
        Alert::success('Success', 'Data berhasil Tersimpan');
        return redirect('/admin/penyakit/'.$request->penyakit_id);
    }

    function deleteRole($id){        
        $role = Role::find($id);
        $role->delete();
        Alert::success('Success', 'Data berhasil Dihapus');
        return redirect('/admin/penyakit/'.$role->penyakit_id);
    }
}
