<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminGejalaController;
use App\Http\Controllers\AdminPenyakitController;
use App\Http\Controllers\AdminPasienController;
use App\Http\Controllers\AdminDiagnosaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function (){
    return view('admin.auth.login');
});

Route::prefix('/admin')->group(function (){
    Route::get('dashboard',function () {
        return view('admin.layouts.wrapper');
        //return view('index');    
    });


    Route::get('/diagnosa', [AdminDiagnosaController::class, 'index']);
    Route::get('/diagnosa/pilih-gejala', [AdminDiagnosaController::class, 'pilihGejala']);
    Route::get('/diagnosa/keputusan', [AdminDiagnosaController::class, 'keputusan']);


    Route::resource('/pasien', AdminPasienController::class);
    Route::resource('/user', AdminUserController::class);
    Route::resource('/gejala', AdminGejalaController::class);



    
    Route::delete('/penyakit/delete-role/{id}', [AdminPenyakitController::class, 'deleteRole']);
    Route::post('/penyakit/add-gejala', [AdminPenyakitController::class, 'addGejala']);
    Route::resource('/penyakit', AdminPenyakitController::class);

    
});
