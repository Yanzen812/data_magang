@extends('layouts.siswa')

@section('content')
<link rel="stylesheet" href="{{ asset('css/surat_pengantar.css') }}">

<div class="content">

    <div class="search-panel">
        <h3>SURAT PENGANTAR</h3>
        <div class="top-bar">
            <input type="text" placeholder="Pencarian Nama">
            <input type="text" placeholder="Cari Sekolah atau Kampus">
            <button class="btn-blue">Cari</button>
        </div>
    </div>

    <div class="data-panel">
        <div class="action-bar">
            <button class="btn-green" id="btnTambah">Tambah Data</button>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Sekolah Kampus</th>
                        <th>Kontak</th>
                        <th>Jurusan</th>
                        <th>Periode Magang</th>
                        <th>Status</th>
                        <th>Surat Pengantar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Budi Santoso</td>
                        <td>SMK Negeri 1</td>
                        <td>08123456789</td>
                        <td>RPL</td>
                        <td>Jan - Mar 2026</td>
                        <td style="color: orange; font-weight:bold;">
                            Menunggu Verifikasi
                        </td>
                        <td>
                            <button class="btn-blue"
                                onclick="openSuratModal(
                                    'Budi Santoso',
                                    'SMK Negeri 1',
                                    'Jan - Mar 2026',
                                    'Menunggu Verifikasi',
                                    'surat_pengantar.pdf'
                                )">
                                Lihat Surat
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- ================= MODAL TAMBAH SISWA ================= -->

<div class="modal-overlay" id="modalOverlay">
    <div class="modal-box">
        <span class="close-btn" id="closeModal">&times;</span>
        <h3>TAMBAH SISWA</h3>

        <form>
            <div class="form-row">
                <div class="form-group">
                    <label>Nama :</label>
                    <input type="text" placeholder="Masukkan Nama Siswa">
                </div>

                <div class="form-group">
                    <label>Periode Magang :</label>
                    <input type="text" placeholder="Masukkan Periode Magang">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Sekolah/Kampus :</label>
                    <input type="text" placeholder="Masukkan Nama Sekolah/Kampus">
                </div>

                <div class="form-group">
                    <label>Surat Pengantar :</label>
                    <input type="file">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Kontak :</label>
                    <input type="text" placeholder="Masukkan Kontak">
                </div>

                <div class="form-group">
                    <label>Jurusan :</label>
                    <input type="text" placeholder="Masukkan Jurusan">
                </div>
            </div>

            <button type="submit" class="btn-green">Tambah Data</button>
        </form>
    </div>
</div>


<!-- ================= MODAL LIHAT SURAT ================= -->

<div class="modal-overlay" id="modalSurat">
    <div class="modal-box">
        <span class="close-btn" id="closeSurat">&times;</span>
        <h3>DETAIL SURAT PENGANTAR</h3>

        <p><strong>Nama:</strong> <span id="suratNama"></span></p>
        <p><strong>Sekolah/Kampus:</strong> <span id="suratSekolah"></span></p>
        <p><strong>Periode Magang:</strong> <span id="suratPeriode"></span></p>

        <p>
            <strong>File Surat:</strong><br>
            <a href="#" target="_blank" id="suratFile">Download Surat</a>
        </p>

        <p style="margin-top:15px;">
            <strong>Status:</strong> 
            <span id="suratStatus" style="color: orange; font-weight:bold;">
                Menunggu Verifikasi
            </span>
        </p>
    </div>
</div>


<!-- ================= SCRIPT ================= -->

<script>
    // Modal Tambah
    const btnTambah = document.getElementById('btnTambah');
    const modalTambah = document.getElementById('modalOverlay');
    const closeModal = document.getElementById('closeModal');

    btnTambah.addEventListener('click', function () {
        modalTambah.style.display = 'flex';
    });

    closeModal.addEventListener('click', function () {
        modalTambah.style.display = 'none';
    });

    window.addEventListener('click', function(e) {
        if (e.target === modalTambah) {
            modalTambah.style.display = 'none';
        }
    });


    // Modal Lihat Surat
    const modalSurat = document.getElementById('modalSurat');
    const closeSurat = document.getElementById('closeSurat');

    function openSuratModal(nama, sekolah, periode, status, file) {
        document.getElementById('suratNama').innerText = nama;
        document.getElementById('suratSekolah').innerText = sekolah;
        document.getElementById('suratPeriode').innerText = periode;
        document.getElementById('suratFile').href = '/storage/surat/' + file;
        document.getElementById('suratStatus').innerText = status;

        modalSurat.style.display = 'flex';
    }

    closeSurat.addEventListener('click', function () {
        modalSurat.style.display = 'none';
    });

    window.addEventListener('click', function(e) {
        if (e.target === modalSurat) {
            modalSurat.style.display = 'none';
        }
    });
</script>

@endsection