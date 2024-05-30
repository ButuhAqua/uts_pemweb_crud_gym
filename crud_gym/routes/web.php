<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PelangganController::class, 'index']);
Route::resource('registrasi', FrontendController::class);
//route resource for pelanggan
Route::resource('pelanggans', PelangganController::class);