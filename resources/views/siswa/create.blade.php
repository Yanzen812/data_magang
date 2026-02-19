@extends('layouts.app')

@section('content')
<div class="modal">
    <h3>TAMBAH SISWA</h3>

    <form>
        <div class="form-row">
            <label>Nama</label>
            <input type="text" placeholder="Masukkan Nama Siswa">
        </div>

        <div class="form-row">
            <label>Sekolah Kampus</label>
            <input type="text" placeholder="Masukkan Nama Sekolah Kampus">
        </div>

        <div class="form-row">
            <label>Jurusan</label>
            <input type="text" placeholder="Masukkan Nama Jurusan">
        </div>

        <div class="form-row">
            <label>Periode</label>
            <input type="text" placeholder="Masukkan Periode Magang">
        </div>

        <div class="form-row">
            <label>Kelompok</label>
            <input type="text" placeholder="Masukkan Kelompok Anda">
        </div>

        <div class="form-row">
            <label>Status</label>
            <input type="text" placeholder="Aktif">
        </div>

        <div class="form-row">
            <label>Kontak</label>
            <input type="text" placeholder="Masukkan Kontak Anda">
        </div>

        <button class="btn-green">Tambah Data</button>
    </form>
</div>
@endsection
