@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/data_kegiatan.css') }}">

<div class="content">

    <div class="search-panel">
        <h3>DATA KEGIATAN</h3>
        <div class="top-bar">
            <input type="text" placeholder="Pencarian Nama">
            <input type="text" placeholder="Cari Sekolah atau Kampus">
            <button class="btn-blue">Cari</button>
        </div>
    </div>

    <div class="data-panel">
        <div class="action-bar">
            <button class="btn-red">Hapus Data</button>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Sekolah Kampus</th>
                        <th>Tanggal</th>
                        <th>Kegiatan</th>
                        <th>Bukti</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>1</td>
                        <td>Nama Siswa</td>
                        <td>SMK Negeri 1</td>
                        <td>03-03-2026</td>
                        <td>Membuat laporan kegiatan harian</td>
                        <td style="text-align:center;">
                            <button class="btn-blue"
                                data-bs-toggle="modal"
                                data-bs-target="#lihatKegiatanModal">
                                Lihat
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ================= MODAL LIHAT KEGIATAN ================= -->
<div class="modal fade" id="lihatKegiatanModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Detail Kegiatan Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label class="fw-bold">Nama</label>
                    <p>Nama Siswa</p>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Sekolah / Kampus</label>
                    <p>SMK Negeri 1</p>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Tanggal</label>
                    <p>03-03-2026</p>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Deskripsi Kegiatan</label>
                    <div style="background:#f5f5f5; padding:10px; border-radius:5px;">
                        Membuat laporan kegiatan harian dan membantu bagian administrasi perusahaan.
                    </div>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Bukti Kegiatan</label>
                    <div style="text-align:center;">
                        <img src="{{ asset('images/contoh-bukti.jpg') }}" 
                             alt="Bukti Kegiatan" 
                             style="max-width:100%; border-radius:8px;">
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>

@endsection