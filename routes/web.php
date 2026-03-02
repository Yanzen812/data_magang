<?php

use App\Http\Controllers\SessionController;
// use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('login', [
//         'nama_instansi' => 'ABSENSI & KEGIATAN',
//         'logo' => 'default-logo.png'
//     ]);
// });
Route::get('/', [SessionController::class, 'index'])->name('login');
Route::post('/', [SessionController::class, 'login'])->name('login_proses');


Route::get('/dashboard', function(){ return view('dashboard'); })->name('dashboard');
Route::get('/siswa', function() { return view('siswa.index'); })->name('siswa');
Route::get('/siswa/create', function() { return view('siswa.create'); })->name('siswa.create');
Route::get('/siswa/{id}/edit', function($id) { return view('siswa.edit', ['id' => $id]); })->name('siswa.edit');
Route::get('/absensi', function() { return view('absensi.index'); })->name('absensi');
Route::get('/kegiatan', function() { return view('kegiatan.index'); })->name('kegiatan');
Route::get('/guru-pembimbing', function() { return view('guru.index'); })->name('guru');
Route::get('/surat', function() { return view('surat.index'); })->name('surat');
Route::get('/penilaian', function() { return view('penilaian.index'); })->name('penilaian');
Route::get('/absensi-siswa', function() { return view('absensi_siswa.index'); })->name('absensi_siswa');
Route::get('/kegiatan-siswa', function() { return view('kegiatan_siswa.index'); })->name('kegiatan_siswa');
Route::get('/kegiatan-siswa/create', function() { return view('kegiatan_siswa.create'); })->name('kegiatan_siswa.create');
Route::get('/laporan-magang', function() { return view('laporan_magang.index'); })->name('laporan_magang');
Route::get('/surat-pengantar', function() { return view('surat_pengantar.index'); })->name('surat_pengantar');
Route::get('/profile', function() { return view('profile.index'); })->name('profile');

