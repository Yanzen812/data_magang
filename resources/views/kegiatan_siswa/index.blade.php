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
                        <td>1</td>
                        <td>Nama Siswa</td>
                        <td>SMK Negeri 1</td>
                        <td>03-03-2026</td>
                        <td>Membuat laporan harian</td>
                        <td>
                            <a href="#" class="btn-view" onclick="bukaBukti()">Lihat</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>

<!-- ================= MODAL TAMBAH KEGIATAN ================= -->

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

<!-- ================= MODAL LIHAT BUKTI ================= -->

<div class="modal-overlay" id="modalBukti">
    <div class="modal-box" style="max-width:800px;">
        <span class="close-btn" onclick="tutupBukti()">&times;</span>
        <h3>DETAIL KEGIATAN</h3>

        <div style="margin-top:20px;">
            <p><strong>Nama:</strong> Nama Siswa</p>
            <p><strong>Sekolah:</strong> SMK Negeri 1</p>
            <p><strong>Tanggal:</strong> 03-03-2026</p>

            <p><strong>Deskripsi Kegiatan:</strong></p>
            <div style="background:#f4f4f4; padding:10px; border-radius:6px;">
                Membuat laporan harian dan membantu bagian administrasi.
            </div>

            <p style="margin-top:15px;"><strong>Bukti Upload:</strong></p>

            <!-- Preview Gambar -->
            <img src="{{ asset('images/contoh-bukti.jpg') }}" 
                 style="max-width:100%; border-radius:8px;">

            <!-- Jika file PDF gunakan ini -->
            <!--
            <iframe src="{{ asset('file/contoh.pdf') }}" width="100%" height="400px"></iframe>
            -->
        </div>
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

    // ===== MODAL BUKTI =====
    function bukaBukti() {
        document.getElementById('modalBukti').style.display = 'flex';
    }

    function tutupBukti() {
        document.getElementById('modalBukti').style.display = 'none';
    }

    window.addEventListener('click', function(e) {
        const modalBukti = document.getElementById('modalBukti');
        if (e.target === modalBukti) {
            modalBukti.style.display = 'none';
        }
    });
</script>

@endsection