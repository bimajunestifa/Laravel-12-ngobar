<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiswaController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('kategoris', KategoriController::class);
    Route::resource('book', BookController::class);
    Route::resource('peminjam', PeminjamController::class);
    Route::resource('pinjam', PinjamController::class);

    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class);
    });

    Route::middleware('siswa')->group(function () {
        Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
        Route::get('/siswa/peminjam', [SiswaController::class, 'peminjam'])->name('siswa.peminjam');
        Route::get('/siswa/pinjam', [SiswaController::class, 'pinjam'])->name('siswa.pinjam');
    });
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');
