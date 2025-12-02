<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PelangganController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pcr', function () {
    return 'Selamat Datang di Website Kampus PCR!';
});

Route::get('/mahasiswa', function () {
    return 'Halo Mahasiswa';
})->name('mahasiswa.show');

Route::get('/nama/{param1}', function ($param1) {
    return 'Nama saya: '.$param1;
});

Route::get('/nama/{param1?}', function ($param1 = '') {
    return 'Nama saya: '.$param1;
});

Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show']);

Route::get('/about', function () {
    return view('halaman-about');
});

Route::get('/home', [HomeController::class,'index'])
        ->name('home');

Route::post('question/store', [QuestionController::class, 'store'])
		->name('question.store');

Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware('checkislogin');


Route::resource('pelanggan', PelangganController::class);

Route::resource('user', UserController::class);

Route::get('auth',[AuthController::class,'index'])->name('auth');

Route::post('auth/login',[AuthController::class,'login'])->name('auth.login');

Route::get('auth/logout',[AuthController::class,'logout'])->name('auth.logout');

Route::group(['middleware' => ['checkrole:Admin']], function(){
    Route::get('user', [UserController::class, 'index'])->name('user.index');
});
