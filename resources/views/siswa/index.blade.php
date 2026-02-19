@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/data_siswa.css') }}">
<h3>DATA SISWA MAGANG</h3>

<div class="top-bar">
    <input type="text" placeholder="Pencarian">
    <button class="btn-blue">Cari</button>
</div>

<div class="action-bar">
    <button class="btn-green">Tambah Data</button>
    <button class="btn-red">Hapus Data</button>
    <button class="btn-yellow">Edit Data</button>
</div>

<table>
    <thead>
        <tr>
            <th></th>
            <th>No</th>
            <th>Nama</th>
            <th>Sekolah Kampus</th>
            <th>Jurusan</th>
            <th>Periode</th>
            <th>Kelompok</th>
            <th>Status</th>
            <th>Kontak</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><input type="checkbox"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
@endsection
