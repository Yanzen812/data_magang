<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body { background:#e5e5e5 }
        .sidebar {
            width:220px;
            background:#2d6bc0;
            min-height:100vh;
            color:#fff;
        }
        .sidebar a {
            display:block;
            color:#fff;
            padding:10px 20px;
            text-decoration:none;
        }
        .sidebar a:hover {
            background:#245aa5;
        }
        .box {
            background:#ddd;
            padding:18px;
            border-radius:4px;
        }
        .red { border-left:6px solid red }
        .green { border-left:6px solid limegreen }
        .yellow { border-left:6px solid gold }
        .pink { border-left:6px solid deeppink }
    </style>
</head>
<body>

<div class="d-flex">

    <div class="sidebar">
        <h5 class="text-center py-3">NUSA INDO</h5>
        <a href="#">Dashboard</a>
        <a href="#">Data Siswa</a>
        <a href="#">Data Absensi</a>
        <a href="#">Data Kegiatan</a>
        <a href="#">Penilaian</a>
        <a href="#">Logout</a>
    </div>

    <div class="flex-fill bg-white m-3 p-4">
        <h3>DASHBOARD</h3>

        <div class="row mt-4">
            <div class="col-md-3">
                <div class="box red">
                    Total Siswa Magang
                    <h4>{{ $total_siswa }}</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box green">
                    Total Hadir
                    <h4>{{ $total_hadir }}</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box yellow">
                    Total Guru Pembimbing
                    <h4>{{ $total_pembimbing }}</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box pink">
                    Izin & Sakit
                    <h4>{{ $izin_sakit }}</h4>
                </div>
            </div>
        </div>

        <div class="row mt-5">

            <div class="col-md-6">
                <h5>Siswa Magang yang Terlambat</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Nama</th>
                        <th>Asal Sekolah</th>
                        <th>Waktu Hadir</th>
                    </tr>
                    @foreach($terlambat as $t)
                    <tr>
                        <td>{{ $t->nama_lengkap }}</td>
                        <td>{{ $t->asal_sekolah }}</td>
                        <td>{{ $t->waktu_hadir }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>

            <div class="col-md-6">
                <h5>Aktivitas Hari Ini</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Kegiatan</th>
                    </tr>
