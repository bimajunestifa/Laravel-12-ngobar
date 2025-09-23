<?php

use Illuminate\Support\Facades\Route;
//panggil controller
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return view('Auth/login');
});


Auth::routes();
//menambahkan route kategoris
Route::resource('kategoris', KategoriController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

