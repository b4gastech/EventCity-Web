<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PanitiaController;

Route::get('/', function () {
    return view('welcome');
});

// Rute untuk menampilkan form
Route::get('/event/baru', function () {
    return view('panitia.create');
});

// Rute untuk memproses simpan data
Route::post('/event/store', [PanitiaController::class, 'store']);

// Rute untuk menampilkan halaman form upload KTP
Route::get('/panitia/verifikasi', function () {
    return view('panitia.upload_ktp');
});

// Rute untuk memproses upload KTP
Route::post('/panitia/upload-ktp', [PanitiaController::class, 'uploadKtp']);