@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<div class="dashboard-container">

    <h2 class="page-title">DASHBOARD</h2>

    <div class="card-grid">
        <div class="stat-card red">
            <p>Total Siswa Magang</p>
            <h3>50</h3>
        </div>

        <div class="stat-card green">
            <p>Total Hadir</p>
            <h3>45</h3>
        </div>

        <div class="stat-card yellow">
            <p>Total Guru Pembimbing</p>
            <h3>25</h3>
        </div>

        <div class="stat-card pink">
            <p>Izin dan Sakit</p>
            <h3>5</h3>
        </div>
    </div>

    <div class="table-grid">
        <div class="table-box">
            <h4>Siswa Magang yang Terlambat</h4>
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Asal Sekolah</th>
                        <th>Waktu Masuk</th>
                        <th>Keterlambatan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Fafayruz</td>
                        <td>SMA Petra</td>
                        <td>09.15</td>
                        <td>15 Menit</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-box">
            <h4>Aktivitas Hari Ini</h4>
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Kegiatan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Fafayruz</td>
                        <td>05 Februari 2026</td>
                        <td>14.00</td>
                        <td>Mengirim desain</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
