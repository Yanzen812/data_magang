@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/penilaian.css') }}">

<div class="content">

    <div class="search-panel">
        <h3>DATA PENILAIAN MAGANG</h3>
        <div class="top-bar">
            <input type="text" placeholder="Pencarian Nama">
            <input type="text" placeholder="Cari Sekolah atau Kampus">
            <button class="btn-blue">Cari</button>
        </div>
    </div>

    <div class="data-panel">
        <div class="action-bar">
            <button class="btn-green" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Data</button>
            <button class="btn-red">Hapus Data</button>
            <button class="btn-yellow" data-bs-toggle="modal" data-bs-target="#editModal">Edit Data</button>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Sekolah Kampus</th>
                        <th>Guru Pembimbing</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: center;"><button class="btn-green">Nilai</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Penilaian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formTambahPenilaian">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" placeholder="Masukkan nama">
                    </div>
                    <div class="mb-3">
                        <label for="sekolah" class="form-label">Sekolah/Kampus</label>
                        <input type="text" class="form-control" id="sekolah" placeholder="Masukkan sekolah atau kampus">
                    </div>
                    <div class="mb-3">
                        <label for="guru" class="form-label">Guru Pembimbing</label>
                        <input type="text" class="form-control" id="guru" placeholder="Masukkan nama guru pembimbing">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Penilaian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formEditPenilaian">
                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNama" placeholder="Masukkan nama">
                    </div>
                    <div class="mb-3">
                        <label for="editSekolah" class="form-label">Sekolah/Kampus</label>
                        <input type="text" class="form-control" id="editSekolah" placeholder="Masukkan sekolah atau kampus">
                    </div>
                    <div class="mb-3">
                        <label for="editGuru" class="form-label">Guru Pembimbing</label>
                        <input type="text" class="form-control" id="editGuru" placeholder="Masukkan nama guru pembimbing">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

@endsection
