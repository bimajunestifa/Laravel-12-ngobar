<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\UserController;



// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route otentikasi bawaan Laravel
Auth::routes();

// Semua route di bawah ini hanya bisa diakses jika user sudah login
Route::middleware(['auth'])->group(function () {

    // Halaman utama (dashboard)
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // CRUD kategori buku
    Route::resource('kategoris', KategoriController::class);

    // CRUD buku
    Route::resource('book', BookController::class);

    // CRUD data peminjam
    Route::resource('peminjam', PeminjamController::class);

    // CRUD data peminjaman
    Route::resource('pinjam', PinjamController::class);

    // Manajemen pengguna sistem
    // Untuk sementara: biarkan route users hanya dilindungi oleh 'auth' sehingga halaman bisa dibuka
    Route::resource('users', UserController::class);
});

// Logout manual
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');
