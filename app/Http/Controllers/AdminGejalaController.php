<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminGejalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data= [
            'title' => 'Manajemen Gejala',
            'gejala' => Gejala::orderBy('created_at','DESC')->paginate(10),
            'content' => 'admin.gejala.index'
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
            'title' => 'Tambah Gejala',
            'content' => 'admin.gejala.create'
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
            'kode_gejala' => 'required|unique:gejalas',
            'name' => 'required',
            'nilai_cf' => 'required',
            'jumlah_pilihan' => 'required',
            'penjelasan_pilihan' => 'nullable|string',

        ]);

        Gejala::create($data);
        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect('/admin/gejala');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data= [
            'title' => 'Edit Gejala',
            'gejala' => Gejala::find($id),
            'content' => 'admin.gejala.create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $gejala = Gejala::find($id);
        $data = $request->validate([
            'kode_gejala' => 'required|unique:gejalas,kode_gejala,' . $id,
            'name' => 'required',
            'nilai_cf' => 'required',
            'jumlah_pilihan' => 'required',
            'penjelasan_pilihan' => 'nullable|string',
        ]);

        $gejala->update($data);
        Alert::success('Success', 'Data berhasil diubah');
        return redirect('/admin/gejala');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // die('masuk');
        $gejala = Gejala::find($id);
        $gejala->delete();
        Alert::success('Success', 'Data berhasil dihapus');
        return redirect('/admin/gejala');
    }
}
