<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

// Login routes (public)
Route::get('/', [SessionController::class, 'index'])->name('login');
Route::post('/', [SessionController::class, 'login'])->name('login_proses');
Route::post('/logout', [SessionController::class, 'logout'])->name('logout');

// Admin routes (requires admin role)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/siswa', [SiswaController::class, 'siswa'])->name('siswa');
    Route::post('/siswa', [SiswaController::class, 'store_siswa'])->name('siswa.store');
    Route::put('/siswa/{id}', [SiswaController::class, 'update_siswa'])->name('siswa.update');
    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy_siswa'])->name('siswa.destroy');

    Route::get('/absensi', [AdminController::class, 'absensi'])->name('absensi');
    Route::delete('/absensi/{id}', [AdminController::class, 'destroy_absensi'])->name('absensi.destroy');

    Route::get('/kegiatan', [AdminController::class, 'kegiatan'])->name('kegiatan');
    Route::delete('/kegiatan/{id}', [AdminController::class, 'destroy_kegiatan'])->name('kegiatan.destroy');

    Route::get('/guru-pembimbing', [AdminController::class, 'guru'])->name('guru');
    Route::post('/guru', [AdminController::class, 'store_guru'])->name('guru.store');
    Route::put('/guru/{id}', [AdminController::class, 'update_guru'])->name('guru.update');
    Route::delete('/guru/{id}', [AdminController::class, 'destroy_guru'])->name('guru.destroy');

    Route::get('/surat', [AdminController::class, 'surat'])->name('surat');
    Route::get('/penilaian', [AdminController::class, 'penilaian'])->name('penilaian');
    Route::post('/penilaian', [AdminController::class, 'store_penilaian'])->name('penilaian.store');
    Route::put('/penilaian/{id}', [AdminController::class, 'update_penilaian'])->name('penilaian.update');
    Route::delete('/penilaian/{id}', [AdminController::class, 'destroy_penilaian'])->name('penilaian.destroy');


// Siswa routes (requires siswa role)
// Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/absensi-siswa', function() { return view('siswa.absensi_siswa'); })->name('absensi_siswa');
    Route::get('/kegiatansiswa', function() { return view('siswa.kegiatan_siswa'); })->name('kegiatansiswa');
    // Route::get('/kegiatansiswa/create', function() { return view('siswa.kegiatansiswa.create'); })->name('kegiatansiswa.create');
    Route::get('/laporan-magang', function() { return view('siswa.laporan_magang'); })->name('laporan_magang');
    Route::get('/surat-pengantar', function() { return view('siswa.surat_pengantar'); })->name('surat_pengantar');
    Route::get('/profile', function() { return view('siswa.profil'); })->name('profile');
// });

