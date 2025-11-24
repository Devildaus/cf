<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\User;
use App\Models\Diagnosa;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'total_pasien' => Pasien::count(),
            'total_penyakit' => Penyakit::count(),
            'total_gejala' => Gejala::count(),
            'total_user' => User::count(),
            'diagnosa_hari_ini' => Diagnosa::whereDate('created_at', today())->count(),
            'content' => 'admin.dashboard',
            'hide_content_header' => true // Tambahkan ini
        ];

        return view('admin.layouts.wrapper', $data);
    }
}