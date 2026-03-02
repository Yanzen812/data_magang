@extends('layouts.siswa')

@section('content')
<link rel="stylesheet" href="{{ asset('css/data_kegiatansiswa.css') }}">

<div class="content">

    <h3>TAMBAH KEGIATAN</h3>

    <div class="data-panel">

        <form action="{{ route('kegiatan_siswa.create') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-container">

                <div class="form-left">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" placeholder="Masukkan Nama Siswa">
                    </div>

                    <div class="form-group">
                        <label>Sekolah/Kampus</label>
                        <input type="text" name="sekolah" placeholder="Masukkan Sekolah/Kampus">
                    </div>

                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal">
                    </div>
                </div>

                <div class="form-right">
                    <div class="form-group">
                        <label>Kegiatan</label>
                        <textarea name="kegiatan" placeholder="Masukkan Kegiatan"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Bukti</label>
                        <input type="file" name="bukti">
                    </div>
                </div>

            </div>

            <div class="form-action">
                <button type="submit" class="btn-green">Simpan</button>
                <a href="{{ route('kegiatan_siswa') }}" class="btn-red">Batal</a>
            </div>

        </form>

    </div>

</div>
@endsection
