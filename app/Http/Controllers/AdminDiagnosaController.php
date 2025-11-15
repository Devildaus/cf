<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     public function pilihGejala()
    {
        //
        $data= [
            'title' => 'Diagnosa Penyakit',
            'content' => 'admin.diagnosa.pilihgejala'
        ];
        return view('admin.layouts.wrapper', $data);
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
