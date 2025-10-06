<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // <-- tambahin ini
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\PinjamController;

// Redirect ke halaman login saat akses root
Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

// Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Resource routes (CRUD otomatis)
Route::resource('kategoris', KategoriController::class);
Route::resource('book', BookController::class);
Route::resource('peminjam', PeminjamController::class);
Route::resource('pinjam', PinjamController::class);
