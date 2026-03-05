<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminController extends Controller
{

    public function absensi(Request $request)
    {
        $query = DB::table('absensi as a')
            ->join('siswa as s', 's.id', '=', 'a.siswa_id')
            ->select('a.id', 's.nama', 's.asal_sekolah', 'a.tanggal', 'a.status', 'a.waktu_datang');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('s.nama', 'like', "%{$search}%")
                  ->orWhere('s.asal_sekolah', 'like', "%{$search}%");
            });
        }

        $absensi = $query
            ->orderBy('a.tanggal', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('admin.absensi', [
            'absensi' => $absensi,
            'request' => $request,
        ]);
    }
        
    public function kegiatan(Request $request)
    {
        $query = DB::table('kegiatan_harian as k')
            ->join('siswa as s', 's.id', '=', 'k.siswa_id')
            ->select('k.id', 's.nama', 's.asal_sekolah', 'k.tanggal', 'k.deskripsi_kegiatan', 'k.file');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('s.nama', 'like', "%{$search}%")
                  ->orWhere('s.asal_sekolah', 'like', "%{$search}%")
                  ->orWhere('k.deskripsi_kegiatan', 'like', "%{$search}%");
            });
        }

        $kegiatan = $query
            ->orderBy('k.tanggal', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('admin.kegiatan', [
            'kegiatan' => $kegiatan,
            'request' => $request,
        ]);
    }

    public function guru(Request $request)
    {
        $query = DB::table('pembimbing')
            ->select('id', 'nama_pembimbing', 'kontak', 'asal_sekolah');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_pembimbing', 'like', "%{$search}%")
                  ->orWhere('asal_sekolah', 'like', "%{$search}%");
            });
        }

        $guru = $query
            ->orderBy('nama_pembimbing')
            ->paginate(10)
            ->withQueryString();

        return view('admin.guru', [
            'guru' => $guru,
            'request' => $request,
        ]);
    }

    public function store_guru(Request $request)
    {
        $data = $request->validate([
            'nama_pembimbing' => 'required|string|max:255',
            'asal_sekolah' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:100',
        ]);
        
        DB::table('pembimbing')->insert($data);

        return redirect()->route('guru')->with('success', 'Data guru pembimbing berhasil ditambahkan');
    }

    public function update_guru(Request $request, $id)
    {
        $data = $request->validate([
            'nama_pembimbing' => 'required|string|max:255',
            'asal_sekolah' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:100',
        ]);
        
        DB::table('pembimbing')->where('id', $id)->update($data);
        
        return redirect()->route('guru')->with('success', 'Data guru pembimbing berhasil diperbarui');
    }

    public function surat(Request $request)
    {
        $query = DB::table('surat_pengantar as sp')
            ->join('pembimbing as pb', 'pb.id', '=', 'sp.id_pembimbing')
            ->select('sp.id', 'sp.file', 'sp.kelompok', 'pb.nama_pembimbing', 'pb.asal_sekolah', 'sp.status');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('sp.kelompok', 'like', "%{$search}%")
                  ->orWhere('pb.nama_pembimbing', 'like', "%{$search}%")
                  ->orWhere('pb.asal_sekolah', 'like', "%{$search}%");
            });
        }

        $surat = $query
            ->orderBy('sp.created_at', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('admin.surat', [
            'surat' => $surat,
            'request' => $request,
        ]);
    }

    public function penilaian(Request $request)
    {
        $query = DB::table('penilaian as p')
            ->join('siswa as s', 's.id', '=', 'p.id_siswa')
            ->leftJoin('pembimbing as pb', 'pb.id', '=', 'p.id_guru')
            ->select(
                'p.id',
                's.id as siswa_id',
                's.nama',
                's.asal_sekolah',
                'pb.nama_pembimbing',
                'p.kedisipinan',
                'p.kerja_sama',
                'p.responsibilitas',
                'p.nilai_akhir'
            );

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('s.nama', 'like', "%{$search}%")
                  ->orWhere('s.asal_sekolah', 'like', "%{$search}%")
                  ->orWhere('pb.nama_pembimbing', 'like', "%{$search}%");
            });
        }

        $penilaian = $query
            ->orderBy('s.nama')
            ->paginate(10)
            ->withQueryString();

        return view('admin.penilaian.index', [
            'penilaian' => $penilaian,
            'request' => $request,
        ]);
    }

    public function store_penilaian(Request $request)
    {
        $data = $request->validate([
            'id_siswa' => 'required|integer|exists:siswa,id',
            'id_guru' => 'required|integer|exists:pembimbing,id',
            'kedisipinan' => 'required|integer|min:1|max:100',
            'kerja_sama' => 'required|integer|min:1|max:100',
            'responsibilitas' => 'required|integer|min:1|max:100',
        ]);

        // Calculate nilai_akhir as average
        $data['nilai_akhir'] = ($data['kedisipinan'] + $data['kerja_sama'] + $data['responsibilitas']) / 3;

        DB::table('penilaian')->insert($data);

        return redirect()->route('penilaian')->with('success', 'Data penilaian berhasil ditambahkan');
    }

    public function update_penilaian(Request $request, $id)
    {
        $data = $request->validate([
            'kedisipinan' => 'required|integer|min:1|max:100',
            'kerja_sama' => 'required|integer|min:1|max:100',
            'responsibilitas' => 'required|integer|min:1|max:100',
        ]);

        // Calculate nilai_akhir as average
        $data['nilai_akhir'] = ($data['kedisipinan'] + $data['kerja_sama'] + $data['responsibilitas']) / 3;

        DB::table('penilaian')->where('id', $id)->update($data);
        
        return redirect()->route('penilaian')->with('success', 'Data penilaian berhasil diperbarui');
    }

    public function destroy_penilaian($id)
    {
        DB::table('penilaian')->where('id', $id)->delete();
        return redirect()->route('penilaian')->with('success', 'Data penilaian berhasil dihapus');
    }


    public function destroy_absensi($id)
    {
        DB::table('absensi')->where('id', $id)->delete();
        return redirect()->route('absensi')->with('success', 'Data absensi berhasil dihapus');
    }

    public function destroy_kegiatan($id)
    {
        DB::table('kegiatan_harian')->where('id', $id)->delete();
        return redirect()->route('kegiatan')->with('success', 'Data kegiatan berhasil dihapus');
    }

    public function destroy_guru($id)
    {
        DB::table('pembimbing')->where('id', $id)->delete();
        return redirect()->route('guru')->with('success', 'Data guru pembimbing berhasil dihapus');
    }
}
