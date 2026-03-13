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
    Route::get('/absensi-siswa', [SiswaController::class, 'absensi_siswa'])->name('absensi_siswa');
    Route::post('/absensi-siswa', [SiswaController::class, 'store_absensi_siswa'])->name('absensi_siswa.store');

    Route::get('/kegiatansiswa', [SiswaController::class, 'kegiatan_siswa'])->name('kegiatansiswa');
    Route::post('/kegiatansiswa', [SiswaController::class, 'store_kegiatan_siswa'])->name('kegiatansiswa.store');

    Route::get('/laporan-magang', [SiswaController::class, 'laporan_magang'])->name('laporan_magang');
    Route::get('/surat-pengantar', [SiswaController::class, 'surat_pengantar'])->name('surat_pengantar');
    Route::get('/profile', [SiswaController::class, 'profile'])->name('profile');
// });

