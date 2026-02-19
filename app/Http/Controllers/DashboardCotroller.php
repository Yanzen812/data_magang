<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');

        return view('dashboard.index', [

            // CARD
            'total_siswa' => DB::table('siswa')->count(),

            'total_hadir' => DB::table('absensi')
                ->where('tanggal', $today)
                ->where('keterangan', 'H')
                ->count(),

            'total_pembimbing' => 0, // belum ada tabel pembimbing

            'izin_sakit' => DB::table('absensi')
                ->where('tanggal', $today)
                ->whereIn('keterangan', ['I', 'S'])
                ->count(),

            // TABEL TERLAMBAT
            'terlambat' => DB::table('absensi as a')
                ->join('siswa as s', 's.id', '=', 'a.siswa_id')
                ->where('a.tanggal', $today)
                ->where('a.keterangan', 'T')
                ->select(
                    's.nama_lengkap',
                    's.asal_sekolah',
                    'a.waktu_hadir'
                )
                ->get(),

            // TABEL AKTIVITAS
            'aktivitas' => DB::table('kegiatan as k')
                ->join('siswa as s', 's.id', '=', 'k.siswa_id')
                ->where('k.tanggal', $today)
                ->select(
                    's.nama_lengkap',
                    'k.tanggal',
                    'k.deskripsi'
                )
                ->get()
        ]);
    }
}
