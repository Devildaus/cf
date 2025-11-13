<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data= [
            'title' => 'Manajemen User',
            'user' => User::get(),
            'content' => 'admin.user.index'
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
            'title' => 'Tambah User',
            'content' => 'admin.user.create'
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
            'email' => 'required|unique:users',
            'role' => 'required',
            'password' => 'required',
            're_pass' => 'required|same:password',
        ]);

        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect('/admin/user');
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
            'title' => 'Tambah User',
            'user' => User::find($id),
            'content' => 'admin.user.create'
        ];
        Alert::success('Success', 'Data berhasil ditambahkan');
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = User::find($id);
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        if($request->password == ''){
            $data['password'] = $user->password;
        } else {
        $data['password'] = Hash::make($request['password']);
        }
        $user->update($data);
        Alert::success('Success', 'Data berhasil diubah');
        return redirect('/admin/user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // die('masuk');
        $user = User::find($id);
        $user->delete();
        Alert::success('Success', 'Data berhasil dihapus');
        return redirect('/admin/user');
    }
}
