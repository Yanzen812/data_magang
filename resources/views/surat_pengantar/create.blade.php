@extends('layouts.app')

@section('content')
<div class="modal">

    <div class="modal-header">
        <h3>TAMBAH SISWA</h3>
        <span class="modal-close">×</span>
    </div>

    <form method="POST" action="#" enctype="multipart/form-data">

        <div class="form-grid">

            <!-- KOLOM KIRI -->
            <div class="form-col">
                <div class="form-row">
                    <label>Nama</label>
                    <input type="text" name="nama" placeholder="Masukkan Nama Siswa">
                </div>

                <div class="form-row">
                    <label>Sekolah atau Kampus</label>
                    <input type="text" name="sekolah" placeholder="Masukkan Nama Sekolah atau Kampus">
                </div>

                <div class="form-row">
                    <label>Kontak</label>
                    <input type="text" name="kontak" placeholder="Masukkan Kontak">
                </div>

                <div class="form-row">
                    <label>Jurusan</label>
                    <input type="text" name="jurusan" placeholder="Masukkan Jurusan">
                </div>
            </div>

            <!-- KOLOM KANAN -->
            <div class="form-col">
                <div class="form-row">
                    <label>Periode Magang</label>
                    <input type="text" name="periode" placeholder="Masukkan Periode Magang">
                </div>

                <div class="form-row">
                    <label>Surat Pengantar</label>
                    <input type="file" name="surat_pengantar">
                </div>
            </div>

        </div>

        <div class="form-action">
            <button type="submit" class="btn-green">Tambah Data</button>
        </div>

    </form>

</div>
@endsection
