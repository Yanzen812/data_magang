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

        // also load all siswa for grouping UI
        $siswa = DB::table('siswa')
            ->select('id', 'nama', 'asal_sekolah', 'kelompok')
            ->orderBy('nama')
            ->get();

        // load full pembimbing list for selection
        $pembimbing = DB::table('pembimbing')
            ->select('id', 'nama_pembimbing')
            ->orderBy('nama_pembimbing')
            ->get();

        return view('admin.guru', [
            'guru' => $guru,
            'request' => $request,
            'siswa' => $siswa,
            'pembimbing' => $pembimbing,
        ]);
    }

    /**
     * Assign a kelompok to selected siswa.
     */
    public function assign_group(Request $request)
    {
        $data = $request->validate([
            'kelompok' => 'required|string|max:100',
            'siswa_ids' => 'required|array|min:1',
            'siswa_ids.*' => 'integer|exists:siswa,id',
            'id_pembimbing' => 'nullable|integer|exists:pembimbing,id',
        ]);

        $update = ['kelompok' => $data['kelompok']];
        if (!empty($data['id_pembimbing'])) {
            $update['id_pembimbing'] = $data['id_pembimbing'];
        }

        DB::table('siswa')
            ->whereIn('id', $data['siswa_ids'])
            ->update($update);

        return redirect()->route('guru')->with('success', 'Kelompok dan pembimbing berhasil disimpan untuk siswa terpilih.');
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
            ->leftJoin('pembimbing as pb', 'pb.id', '=', 'sp.id_pembimbing')
            // join siswa and the pembimbing referenced on siswa as fallback
            ->leftJoin('siswa as s', 's.id', '=', 'sp.id_siswa')
            ->leftJoin('pembimbing as pb2', 'pb2.id', '=', 's.id_pembimbing')
            ->select(
                'sp.id',
                'sp.file',
                // prefer kelompok from surat_pengantar, fallback to siswa.kelompok
                DB::raw('COALESCE(sp.kelompok, s.kelompok) as kelompok'),
                // prefer pembimbing on surat, fallback to pembimbing assigned to siswa
                DB::raw('COALESCE(pb.nama_pembimbing, pb2.nama_pembimbing) as nama_pembimbing'),
                // prefer pembimbing asal_sekolah from surat pembimbing, then siswa pembimbing, then siswa.asal_sekolah
                DB::raw('COALESCE(pb.asal_sekolah, pb2.asal_sekolah, s.asal_sekolah) as asal_sekolah'),
                'sp.status'
            );

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('sp.kelompok', 'like', "%{$search}%")
                  ->orWhere('pb.nama_pembimbing', 'like', "%{$search}%")
                  ->orWhere('pb.asal_sekolah', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('sp.status', $status);
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

    public function update_surat(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,verified,rejected',
        ]);

        try {
            DB::table('surat_pengantar')
                ->where('id', $id)
                ->update([
                    'status' => $validated['status'],
                    'updated_at' => now(),
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Status surat berhasil diperbarui',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status surat: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function penilaian(Request $request)
    {
        $query = DB::table('siswa as s')
            ->leftJoin('penilaian as p', 's.id', '=', 'p.id_siswa')
            ->leftJoin('pembimbing as pb', 'pb.id', '=', 'p.id_guru')
            ->leftJoin('pembimbing as pb_siswa', 'pb_siswa.id', '=', 's.id_pembimbing')
            ->select(
                'p.id',
                's.id as siswa_id',
                's.nama',
                's.asal_sekolah',
                'pb.nama_pembimbing',
                'pb_siswa.id as pembimbing_siswa_id',
                'pb_siswa.nama_pembimbing as pembimbing_siswa_nama',
                'p.id_guru',
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

        $pembimbing = DB::table('pembimbing')->select('id', 'nama_pembimbing')->get();

        return view('admin.penilaian', [
            'penilaian' => $penilaian,
            'pembimbing' => $pembimbing,
            'request' => $request,
        ]);
    }

    public function store_penilaian(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan penilaian: ' . $e->getMessage())->withInput();
        }
    }

    public function update_penilaian(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'kedisipinan' => 'required|integer|min:1|max:100',
                'kerja_sama' => 'required|integer|min:1|max:100',
                'responsibilitas' => 'required|integer|min:1|max:100',
            ]);

            // Calculate nilai_akhir as average
            $data['nilai_akhir'] = ($data['kedisipinan'] + $data['kerja_sama'] + $data['responsibilitas']) / 3;
            $data['updated_at'] = now();

            $updated = DB::table('penilaian')->where('id', $id)->update($data);

            if ($updated) {
                return redirect()->route('penilaian')->with('success', 'Data penilaian berhasil diperbarui');
            } else {
                return redirect()->back()->with('error', 'Data penilaian tidak ditemukan')->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui penilaian: ' . $e->getMessage())->withInput();
        }
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
