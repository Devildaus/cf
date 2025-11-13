<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminGejalaController;

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

    Route::resource('/user', AdminUserController::class);
    Route::resource('/gejala', AdminGejalaController::class);
    
});
