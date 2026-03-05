@extends('layouts.siswa')

@section('content')
<link rel="stylesheet" href="{{ asset('css/kegiatansiswa.css') }}">

<div class="content">

    <h3>DATA KEGIATAN</h3>

    <div class="data-panel">

        <div class="action-bar">
            <button class="btn-red">Hapus Data</button>
            <button class="btn-green" id="btnTambah">Tambah Data</button>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Sekolah/Kampus</th>
                        <th>Tanggal</th>
                        <th>Kegiatan</th>
                        <th>Bukti</th>
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
                        <td>
                            <a href="#" class="btn-view">Lihat</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

<div class="modal-overlay" id="modalOverlay">
    <div class="modal-box">
        <span class="close-btn" id="closeModal">&times;</span>
        <h3>TAMBAH KEGIATAN</h3>

        <form>
            <div class="form-row">
                <div class="form-group">
                    <label>Nama :</label>
                    <input type="text" placeholder="Masukkan Nama Siswa">
                </div>

                <div class="form-group">
                    <label>Kegiatan :</label>
                    <textarea placeholder="Masukkan Kegiatan"></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Sekolah/Kampus :</label>
                    <input type="text" placeholder="Masukkan Sekolah/Kampus">
                </div>

                <div class="form-group">
                    <label>Bukti :</label>
                    <input type="file">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Tanggal :</label>
                    <input type="date">
                </div>
            </div>

            <button type="submit" class="btn-green">Tambah Data</button>
        </form>
    </div>
</div>

<!-- ================= SCRIPT ================= -->

<script>
    const btnTambah = document.getElementById('btnTambah');
    const modal = document.getElementById('modalOverlay');
    const closeModal = document.getElementById('closeModal');

    btnTambah.addEventListener('click', function () {
        modal.style.display = 'flex';
    });

    closeModal.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
</script>

@endsection