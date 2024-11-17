<?php

use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\GalleryController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(BukuController::class)->group(function () {
    Route::get('/buku', 'index')->name('buku.index');
    Route::get('/buku/create', 'create')->name('buku.create');
    Route::post('/buku', 'store')->name('buku.store');
    Route::get('/buku/{id}', 'edit')->name('buku.edit');
    Route::put('/buku/{id}', 'update')->name('buku.update');
    Route::post('/buku/{id}', 'update')->name('buku.update');
    Route::delete('/buku/{id}', 'destroy')->name('buku.destroy');
    Route::get('/buku/detail/{id}', 'showCover')->name('buku.detail');
});

Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('regis.store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

Route::resource('gallery', GalleryController::class);
Route::get('/gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
