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
        $role = $role->sortBy(function($role) {
            // Mengambil kode_gejala dari relasi Gejala
            return optional($role->gejala)->kode_gejala;
        })->values();
        $data= [
            'title' => 'Penyakit',
            'penyakit' => Penyakit::find($id),
            'gejala' => Gejala::orderBy('kode_gejala', 'asc')->get(),
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
        
        // 1. Validasi Input
        $request->validate([
            'penyakit_id' => 'required|exists:penyakits,id',
            'gejala_id' => 'required|exists:gejalas,id',
            // bobot_cf dibuat nullable, tetapi harus numeric jika diisi
            'bobot_cf' => 'nullable|numeric|min:0|max:1', 
        ]);

        $bobot_cf_final = $request->bobot_cf;
        
        // 2. >> LOGIKA DEFAULT CF <<
        // Jika bobot_cf kosong/null, ambil nilai nilai_cf dari tabel gejalas
        if (empty($bobot_cf_final) || $bobot_cf_final === null) {
            $gejala = Gejala::find($request->gejala_id);
            
            // Asumsi: kolom bobot CF default di tabel gejalas bernama `nilai_cf`
            if ($gejala) {
                 $bobot_cf_final = $gejala->nilai_cf; 
            } else {
                // Fallback jika gejala tidak ditemukan
                $bobot_cf_final = 0.0; 
            }
        }
        
        // 3. Pengecekan Duplikasi
        $existingRole = Role::where('penyakit_id', $request->penyakit_id)
                           ->where('gejala_id', $request->gejala_id)
                           ->first();
        
        if ($existingRole) {
            Alert::warning('Warning', 'Gejala sudah ada pada penyakit ini.');
            return redirect('/admin/penyakit/'.$request->penyakit_id);
        }

        $data = [
            'penyakit_id' => $request->penyakit_id,
            'gejala_id' => $request->gejala_id,
            'bobot_cf' => $bobot_cf_final, // Gunakan nilai CF yang sudah ditentukan
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
