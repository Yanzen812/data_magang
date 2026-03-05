<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');

        return view('admin.dashboard', [

            // CARD
            'total_siswa' => DB::table('siswa')->count(),

            'total_hadir' => DB::table('absensi')
                ->where('tanggal', $today)
                ->where('status', 'h')
                ->count(),

            'total_pembimbing' => DB::table('pembimbing')->count(), 
            'izin_sakit' => DB::table('absensi')
                ->where('tanggal', $today)
                ->whereIn('status', ['i', 's'])
                ->count(),

            // TABEL TERLAMBAT
            'terlambat' => DB::table('absensi as a')
                ->join('siswa as s', 's.id', '=', 'a.siswa_id')
                ->where('a.tanggal', $today)
                ->where('a.status', 't')
                ->select(
                    's.nama',
                    's.asal_sekolah',
                    'a.waktu_datang'
                )
                ->get(),

            // TABEL AKTIVITAS
            'aktivitas' => DB::table('kegiatan_harian as k')
                ->join('siswa as s', 's.id', '=', 'k.siswa_id')
                ->where('k.tanggal', $today)
                ->orderBy('k.created_at', 'DESC')
                ->select(
                    's.nama',
                    'k.tanggal',
                    'k.deskripsi_kegiatan',
                    'k.updated_at'
                )
                ->get()
        ]);
    }
}
