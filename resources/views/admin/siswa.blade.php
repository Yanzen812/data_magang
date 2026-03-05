@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/data_siswa.css') }}">

<div class="content">

    <div class="search-panel">
        <h3>DATA SISWA MAGANG</h3>
        <form method="GET" action="{{ route('siswa') }}">
            <div class="top-bar">
               <input type="text" name="search" placeholder="Cari nama, sekolah, jurusan..." value="{{ $request->get('search') }}" id="search">

                <button type="submit" class="btn-blue">Cari</button>
            </div>
        </form>
    </div>

    <div class="data-panel">
        <div class="action-bar">
            <button class="btn-green" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Data</button>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Asal Sekolah</th>
                        <th>Jurusan</th>
                        <th>Periode</th>
                        <th>Kelompok</th>
                        <th>Kontak</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswa as $index => $row)
                        <tr>
                            <td>{{ $siswa->firstItem() + $index }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->asal_sekolah }}</td>
                            <td>{{ $row->jurusan }}</td>
                            <td>{{ $row->periode }}</td>
                            <td>{{ $row->kelompok }}</td>
                            <td>{{ $row->kontak }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $row->id }}" data-nama="{{ $row->nama }}" data-sekolah="{{ $row->asal_sekolah }}" data-jurusan="{{ $row->jurusan }}" data-periode="{{ $row->periode }}" data-kelompok="{{ $row->kelompok }}" data-kontak="{{ $row->kontak }}">Edit Data</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteSiswa({{ $row->id }})">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data siswa</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top: 20px;">
            {{ $siswa->links() }}
        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formTambah" method="POST" action="{{ route('siswa.store') }}">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" placeholder="Masukkan nama siswa" name="nama" value="{{ old('nama') }}">
                    </div>
                    <div class="mb-3">
                        <label for="sekolah" class="form-label">Sekolah/Kampus</label>
                        <input type="text" class="form-control" id="sekolah" placeholder="Masukkan sekolah atau kampus" name="asal_sekolah" value="{{ old('asal_sekolah') }}">
                    </div>
                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <input type="text" class="form-control" id="jurusan" placeholder="Masukkan jurusan" name="jurusan" value="{{ old('jurusan') }}">
                    </div>
                    <div class="mb-3">
                        <label for="periode" class="form-label">Periode</label>
                        <input type="date" class="form-control" id="periode" name="periode" value="{{ old('periode') }}">
                    </div>
                    <div class="mb-3">
                        <label for="kelompok" class="form-label">Kelompok</label>
                        <input type="text" class="form-control" id="kelompok" placeholder="Masukkan kelompok" name="kelompok" value="{{ old('kelompok') }}">
                    </div>
                    <div class="mb-3">
                        <label for="kontak" class="form-label">Kontak</label>
                        <input type="text" class="form-control" id="kontak" placeholder="Masukkan kontak" name="kontak" value="{{ old('kontak') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEdit" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNama" placeholder="Masukkan nama siswa" name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="editSekolah" class="form-label">Sekolah/Kampus</label>
                        <input type="text" class="form-control" id="editSekolah" placeholder="Masukkan sekolah atau kampus" name="asal_sekolah">
                    </div>
                    <div class="mb-3">
                        <label for="editJurusan" class="form-label">Jurusan</label>
                        <input type="text" class="form-control" id="editJurusan" placeholder="Masukkan jurusan" name="jurusan">
                    </div>
                    <div class="mb-3">
                        <label for="editPeriode" class="form-label">Periode</label>
                        <input type="date" class="form-control" id="editPeriode" name="periode">
                    </div>
                    <div class="mb-3">
                        <label for="editKelompok" class="form-label">Kelompok</label>
                        <input type="text" class="form-control" id="editKelompok" placeholder="Masukkan kelompok" name="kelompok">
                    </div>
                    <div class="mb-3">
                        <label for="editKontak" class="form-label">Kontak</label>
                        <input type="text" class="form-control" id="editKontak" placeholder="Masukkan kontak" name="kontak">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Handle Edit Modal - populate fields from button data attributes
    document.getElementById('editModal').addEventListener('show.bs.modal', function(e) {
        const button = e.relatedTarget;
        const id = button.dataset.id;

        document.getElementById('editNama').value = button.dataset.nama || '';
        document.getElementById('editSekolah').value = button.dataset.sekolah || '';
        document.getElementById('editJurusan').value = button.dataset.jurusan || '';
        document.getElementById('editPeriode').value = button.dataset.periode || '';
        document.getElementById('editKelompok').value = button.dataset.kelompok || '';
        document.getElementById('editKontak').value = button.dataset.kontak || '';

        // Set form action to correct route
        document.getElementById('formEdit').action = '/siswa/' + id;
    });

    function deleteSiswa(id) {
        if(confirm('Apakah Anda yakin ingin menghapus data siswa ini?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/siswa/' + id;
            form.innerHTML = '<input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}">';
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>

@endsection
