<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('login', [
//         'nama_instansi' => 'ABSENSI & KEGIATAN',
//         'logo' => 'default-logo.png'
//     ]);
// });
Route::get('/', [SessionController::class, 'index'])->name('login');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/siswa', function() { return view('siswa.index'); })->name('siswa');
Route::get('/absensi', function() { return view('absensi.index'); })->name('absensi');
