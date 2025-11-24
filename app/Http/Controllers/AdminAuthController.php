<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminAuthController extends Controller
{
    //

    function index() {
        return view('admin.auth.login');
    }

    function login(Request $request) {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect('/admin/diagnosa');
        }

        return back()->with('loginError' , 'Gagal Login! Silahkan periksa kembali email dan password anda.');

    }
    
    function logout() {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        Alert::success('Berhasil Logout', 'Anda telah berhasil logout dari sistem.');

        return redirect('/login');
    }
       
}
