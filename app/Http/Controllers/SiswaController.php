<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\KegiatanHarian;
use App\Models\Penilaian;
use App\Models\Siswa;
use App\Models\Surat_pengantar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SiswaController extends Controller
{
    public function siswa(Request $request)
    {
        $query = DB::table('siswa')
            ->select('id', 'nama', 'asal_sekolah', 'jurusan', 'periode', 'kelompok', 'kontak');

        // apply search/filters if provided
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('asal_sekolah', 'like', "%{$search}%")
                  ->orWhere('jurusan', 'like', "%{$search}%")
                  ->orWhere('periode', 'like', "%{$search}%")
                  ->orWhere('kelompok', 'like', "%{$search}%")
                  ->orWhere('kontak', 'like', "%{$search}%");
            });
        }

        $siswa = $query
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString(); // keep search term on pagination links

        return view('admin.siswa', [
            'siswa' => $siswa,
            'request' => $request,
        ]);
    }

    public function absensi_siswa()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'siswa') {
            return Redirect::route('login')->with('error', 'Akses ditolak. Silakan login sebagai siswa.');
        }

        $siswa = Siswa::find($user->siswa_id);

        if (!$siswa) {
            return Redirect::route('login')->with('error', 'Data siswa tidak ditemukan.');
        }

        $absensi = Absensi::where('siswa_id', $siswa->id)
            ->orderBy('tanggal', 'desc')
            ->limit(10)
            ->get();

        $today = now()->toDateString();
        $todayAbsensi = Absensi::where('siswa_id', $siswa->id)->where('tanggal', $today)->first();

        return view('siswa.absensi_siswa', [
            'siswa' => $siswa,
            'absensi' => $absensi,
            'todayAbsensi' => $todayAbsensi,
        ]);
    }

    public function kegiatan_siswa()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'siswa') {
            return Redirect::route('login')->with('error', 'Akses ditolak. Silakan login sebagai siswa.');
        }

        $siswa = Siswa::find($user->siswa_id);

        if (!$siswa) {
            return Redirect::route('login')->with('error', 'Data siswa tidak ditemukan.');
        }

        $kegiatan = KegiatanHarian::where('siswa_id', $siswa->id)
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('siswa.kegiatan_siswa', [
            'siswa' => $siswa,
            'kegiatan' => $kegiatan,
        ]);
    }

    public function store_kegiatan_siswa(Request $request)
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'siswa') {
            return Redirect::route('login')->with('error', 'Akses ditolak. Silakan login sebagai siswa.');
        }

        $siswa = Siswa::find($user->siswa_id);

        if (!$siswa) {
            return Redirect::route('login')->with('error', 'Data siswa tidak ditemukan.');
        }

        $data = $request->validate([
            'deskripsi_kegiatan' => 'required|string|max:500',
            'tanggal' => 'required|date',
            'file' => 'nullable|file|max:2048',
        ]);

        $kegiatanData = [
            'siswa_id' => $siswa->id,
            'deskripsi_kegiatan' => $data['deskripsi_kegiatan'],
            'tanggal' => $data['tanggal'],
        ];

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('kegiatan_files', 'public');
            $kegiatanData['file'] = $path;
        }

        KegiatanHarian::create($kegiatanData);

        return Redirect::route('kegiatansiswa')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function laporan_magang()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'siswa') {
            return Redirect::route('login')->with('error', 'Akses ditolak. Silakan login sebagai siswa.');
        }

        $siswa = Siswa::find($user->siswa_id);

        if (!$siswa) {
            return Redirect::route('login')->with('error', 'Data siswa tidak ditemukan.');
        }

        $totalKehadiran = Absensi::where('siswa_id', $siswa->id)->where('status', 'h')->count();
        $totalKegiatan = KegiatanHarian::where('siswa_id', $siswa->id)->count();
        $rataRataNilai = Penilaian::where('id_siswa', $siswa->id)->avg('nilai_akhir');
        $riwayatKegiatan = KegiatanHarian::where('siswa_id', $siswa->id)
            ->orderBy('tanggal', 'desc')
            ->limit(10)
            ->get();

        return view('siswa.laporan_magang', [
            'siswa' => $siswa,
            'totalKehadiran' => $totalKehadiran,
            'totalKegiatan' => $totalKegiatan,
            'rataRataNilai' => $rataRataNilai,
            'riwayatKegiatan' => $riwayatKegiatan,
        ]);
    }

    public function surat_pengantar()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'siswa') {
            return Redirect::route('login')->with('error', 'Akses ditolak. Silakan login sebagai siswa.');
        }

        $siswa = Siswa::find($user->siswa_id);
        if (!$siswa) {
            return Redirect::route('login')->with('error', 'Data siswa tidak ditemukan.');
        }

        $suratPengantar = Surat_pengantar::with('pembimbing')
            ->where('id_siswa', $siswa->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('siswa.surat_pengantar', [
            'siswa' => $siswa,
            'suratPengantar' => $suratPengantar,
        ]);
    }

    public function profile()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'siswa') {
            return Redirect::route('login')->with('error', 'Akses ditolak. Silakan login sebagai siswa.');
        }

        $siswa = Siswa::find($user->siswa_id);

        if (!$siswa) {
            return Redirect::route('login')->with('error', 'Data siswa tidak ditemukan.');
        }

        return view('siswa.profil', [
            'siswa' => $siswa,
        ]);
    }

    public function store_absensi_siswa(Request $request)
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'siswa') {
            return Redirect::route('login')->with('error', 'Akses ditolak. Silakan login sebagai siswa.');
        }

        $siswa = Siswa::find($user->siswa_id);

        if (!$siswa) {
            return Redirect::route('login')->with('error', 'Data siswa tidak ditemukan.');
        }

        $data = $request->validate([
            'status' => 'required|in:h,i,s,t',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $today = now()->toDateString();

        $exists = Absensi::where('siswa_id', $siswa->id)->where('tanggal', $today)->first();

        if ($exists) {
            return Redirect::back()->with('error', 'Absensi hari ini sudah dilakukan.');
        }

        Absensi::create([
            'siswa_id' => $siswa->id,
            'tanggal' => $today,
            'status' => $data['status'],
            'waktu_datang' => now()->toTimeString(),
            'keterangan' => $data['keterangan'] ?? null,
        ]);

        return Redirect::route('absensi_siswa')->with('success', 'Absensi berhasil disimpan.');
    }


    public function store_siswa(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'asal_sekolah' => 'nullable|string|max:255',
            'jurusan' => 'nullable|string|max:255',
            'periode' => 'nullable|string|max:100',
            'kelompok' => 'nullable|string|max:100',
            'kontak' => 'nullable|string|max:100',
        ]);

        $result = DB::transaction(function () use ($data) {
            $siswa = Siswa::create($data);

            $baseUsername = Str::slug(strtolower($siswa->nama), '_');
            $username = $baseUsername;
            $counter = 1;

            while (User::where('username', $username)->exists()) {
                $username = $baseUsername . '_' . $counter;
                $counter++;
            }

            $passwordPlain = 'password';

            $user = User::create([
                'username' => $username,
                'password' => Hash::make($passwordPlain),
                'role' => 'siswa',
                'siswa_id' => $siswa->id,
            ]);

            return [
                'siswa' => $siswa,
                'user' => $user,
                'password' => $passwordPlain,
            ];
        });

        return redirect()->route('siswa')->with('success', "Data siswa berhasil ditambahkan. Login siswa: {$result['user']->username} / {$result['password']}");
    }
    public function update_siswa(Request $request, $id)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'asal_sekolah' => 'nullable|string|max:255',
            'jurusan' => 'nullable|string|max:255',
            'periode' => 'nullable|string|max:100',
            'kelompok' => 'nullable|string|max:100',
            'kontak' => 'nullable|string|max:100',
        ]);

        DB::table('siswa')->where('id', $id)->update($data);

        return redirect()->route('siswa')->with('success', 'Data siswa berhasil diperbarui');
    }
    public function destroy_siswa($id)
    {
        DB::table('siswa')->where('id', $id)->delete();
        return redirect()->route('siswa')->with('success', 'Data siswa berhasil dihapus');
    }
}
