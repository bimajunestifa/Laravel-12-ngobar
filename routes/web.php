<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\UserController;

// Redirect halaman utama ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route autentikasi bawaan Laravel
Auth::routes();

// Semua route di bawah ini hanya bisa diakses jika user sudah login
Route::middleware(['auth'])->group(function () {

    // Halaman utama (dashboard) - Admin dan Petugas
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Dashboard khusus untuk siswa
    Route::get('/siswa/dashboard', [HomeController::class, 'siswaDashboard'])->name('siswa.dashboard');

    // CRUD kategori buku - Admin dan Petugas
    Route::resource('kategoris', KategoriController::class);

    // CRUD buku - Admin dan Petugas
    Route::resource('book', BookController::class);

    // CRUD data peminjam - Semua role
    Route::resource('peminjam', PeminjamController::class);

    // CRUD data peminjaman - Semua role
    Route::resource('pinjam', PinjamController::class);

    // Manajemen pengguna sistem - Hanya Admin
    Route::resource('users', UserController::class);
});

// Route logout manual
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');
