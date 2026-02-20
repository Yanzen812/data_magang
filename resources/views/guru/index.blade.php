@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/data_guru_pembimbing.css') }}">

<div class="content">

    <div class="search-panel">
        <h3>DATA GURU PEMBIMBING</h3>
        <div class="top-bar">
            <input type="text" placeholder="Pencarian Nama">
            <input type="text" placeholder="Cari Sekolah atau Kampus">
            <button class="btn-blue">Cari</button>
        </div>
    </div>

    <div class="data-panel">
        <div class="action-bar">
            <button class="btn-green">Tambah Data</button>
            <button class="btn-red">Hapus Data</button>
            <button class="btn-yellow">Edit Data</button>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Sekolah Kampus</th>
                        <th>Siswa Bimbingan</th>
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
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
