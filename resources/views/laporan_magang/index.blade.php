@extends('layouts.siswa')

@section('content')
<link rel="stylesheet" href="{{ asset('css/laporan_magang.css') }}">

<div class="content">

    <h3>Laporan Magang</h3>

    <!-- RINGKASAN -->
    <div class="summary-wrapper">

        <div class="summary-card">
            <div class="summary-title">Nilai Rata-Rata</div>
            <div class="summary-value value-green">95.5</div>
        </div>

        <div class="summary-card">
            <div class="summary-title">Total Kehadiran</div>
            <div class="summary-value value-yellow">65 Hari</div>
        </div>

        <div class="summary-card">
            <div class="summary-title">Total Kegiatan</div>
            <div class="summary-value value-blue">20</div>
        </div>

    </div>

    <!-- RIWAYAT KEGIATAN -->
    <h4>Riwayat Kegiatan</h4>

    <div class="data-panel">

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kegiatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>01 Januari 2026</td>
                        <td>membuat crud dasar</td>
                        <td>
                            <a href="#" class="btn-view">Lihat</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
