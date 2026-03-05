<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
// use Illuminate\Http\Request;


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

        DB::table('siswa')->insert($data);

        return redirect()->route('siswa')->with('success', 'Data siswa berhasil ditambahkan');
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
