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
            <label>Guru Pembimbing</label>
            <input type="text" placeholder="Masukkan Nama Guru Pembimbing">
        </div>

        <button class="btn-green">Tambah Data</button>
    </form>
</div>
@endsection
