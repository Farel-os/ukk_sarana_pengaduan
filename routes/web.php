<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FeatureController;

Route::get('/', function () {
    return view('auth.login');
})->name('home.login');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::get('/loginForm', [AuthController::class, 'loginForm'])->name('loginForm');
Route::get('/registerForm', [AuthController::class, 'registerForm'])->name('registerForm');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [Authcontroller::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('dashboardSiswa', [FeatureController::class, 'dashboard'])->name('dashboard.siswa');
    Route::get('/aspirasiSiswa', [FeatureController::class, 'index'])->name('aspirasi.siswa');
    Route::post('/aspirasiSiswa', [FeatureController::class, 'store'])->name('aspirasi.siswa.store');
    Route::get('/aspirasiSiswa/{inputAspirasi}', [FeatureController::class, 'detail'])->name('aspirasi.siswa.detail');

    Route::get('dashboardAdmin', [AdminController::class, 'dashboard'])->name('dashboard.admin');
    Route::get('/admin/aspirasi', [AdminController::class, 'listAspirasi'])->name('admin.aspirasi.index');
    Route::get('/admin/aspirasi/{inputAspirasi}', [AdminController::class, 'show'])->name('admin.aspirasi.show');
    Route::put('/admin/aspirasi/{inputAspirasi}', [AdminController::class, 'update'])->name('admin.aspirasi.update');
    Route::get('/admin/history', [AdminController::class, 'history'])->name('admin.aspirasi.history');
});
