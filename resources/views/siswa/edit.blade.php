@extends('layouts.app')

@section('content')
<div class="modal">
    <h3>EDIT SISWA</h3>

    <form>
        <div class="form-row">
            <label>Nama</label>
            <input type="text" value="">
        </div>

        <div class="form-row">
            <label>Sekolah Kampus</label>
            <input type="text" value="">
        </div>

        <div class="form-row">
            <label>Jurusan</label>
            <input type="text" value="">
        </div>

        <div class="form-row">
            <label>Periode</label>
            <input type="text" value="">
        </div>

        <div class="form-row">
            <label>Kelompok</label>
            <input type="text" value="">
        </div>

        <div class="form-row">
            <label>Status</label>
            <input type="text" value="">
        </div>

        <div class="form-row">
            <label>Kontak</label>
            <input type="text" value="">
        </div>

        <button class="btn-green">Edit Data</button>
    </form>
</div>
@endsection
