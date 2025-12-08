<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminGejalaController;
use App\Http\Controllers\AdminPenyakitController;
use App\Http\Controllers\AdminPasienController;
use App\Http\Controllers\AdminDiagnosaController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChatbotController;

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

Route::get('/home', function () {
    return redirect('/admin/dashboard');
})->middleware('auth');


Route::get('/login', [AdminAuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AdminAuthController::class, 'login'])->middleware('guest');
Route::get('/logout', [AdminAuthController::class, 'logout'])->middleware('auth');

Route::prefix('/admin')->middleware('auth')->group(function (){
    Route::get('dashboard',function () {
        // return view('admin.layouts.wrapper');        
        //return view('index');    

        return view('admin.layouts.wrapper', [        
        'content' => 'admin.dashboard'
        ]);
    });


    Route::get('/diagnosa', [AdminDiagnosaController::class, 'index']);
    Route::post('/diagnosa/create-pasien', [AdminDiagnosaController::class, 'createPasien']);
    Route::get('/diagnosa/pilih', [AdminDiagnosaController::class, 'pilih']);
    Route::get('/diagnosa/pilih-gejala', [AdminDiagnosaController::class, 'pilihGejala']);
    Route::get('/diagnosa/hapus-gejala', [AdminDiagnosaController::class, 'hapusGejalaTerpilih']);
    Route::get('/diagnosa/proses', [AdminDiagnosaController::class, 'prosesDiagnosa']);
    Route::get('/diagnosa/keputusan/{id}', [AdminDiagnosaController::class, 'keputusan']);

    Route::get('/pasien/cetak/{id}', [AdminPasienController::class, 'print']);


    Route::resource('/pasien', AdminPasienController::class);
    Route::resource('/user', AdminUserController::class);
    Route::resource('/gejala', AdminGejalaController::class);



    
    Route::delete('/penyakit/delete-role/{id}', [AdminPenyakitController::class, 'deleteRole']);
    Route::post('/penyakit/add-gejala', [AdminPenyakitController::class, 'addGejala']);
    Route::resource('/penyakit', AdminPenyakitController::class);


    Route::get('/dashboard', [DashboardController::class, 'index']);

    // web.php - tambahkan route ini setelah route cetak
    Route::get('/pasien/kirim-wa/{id}', [AdminPasienController::class, 'showKirimWaForm']);
    Route::post('/pasien/kirim-wa/{id}', [AdminPasienController::class, 'kirimWhatsApp']);

    Route::get('/konsultasi-diabetes', [ChatbotController::class, 'index'])->name('chatbot.index');
    Route::post('/konsultasi-diabetes/send', [ChatbotController::class, 'sendMessage'])->name('chatbot.send');
    
});
