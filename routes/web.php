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
Route::get('/kegiatan', function() { return view('kegiatan.index'); })->name('kegiatan');
Route::get('/guru-pembimbing', function() { return view('guru.index'); })->name('guru');
Route::get('/surat-pengantar', function() { return view('surat.index'); })->name('surat');
Route::get('/penilaian', function() { return view('penilaian.index'); })->name('penilaian');
