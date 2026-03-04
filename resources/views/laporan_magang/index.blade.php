@extends('layouts.siswa')

@section('content')
<link rel="stylesheet" href="{{ asset('css/laporan_magang.css') }}">

<div class="content">

    <h3>Laporan Magang</h3>

    <!-- RINGKASAN -->
    <div class="summary-wrapper">

        <div class="summary-card">
            <div class="summary-title">Nilai Rata-Rata</div>
            <div class="summary-value value-green">95.5</div>
        </div>

        <div class="summary-card">
            <div class="summary-title">Total Kehadiran</div>
            <div class="summary-value value-yellow">65 Hari</div>
        </div>

        <div class="summary-card">
            <div class="summary-title">Total Kegiatan</div>
            <div class="summary-value value-blue">20</div>
        </div>

    </div>

    <!-- RIWAYAT KEGIATAN -->
    <h4>Riwayat Kegiatan</h4>

    <div class="data-panel">

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kegiatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td>Membuat CRUD Dasar</td>
                        <td>
                            <button onclick="openModal(
                                '01 Januari 2026',
                                'Membuat CRUD Dasar',
                                'Membuat fitur tambah, edit, dan hapus data siswa menggunakan Laravel.'
                            )">
                                Lihat
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>

<!-- MODAL DETAIL -->
<div id="modalDetail" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5);">

    <div style="background:white; width:400px; margin:10% auto; padding:20px; position:relative; border-radius:8px;">
        
        <span onclick="closeModal()" 
              style="position:absolute; right:10px; top:5px; cursor:pointer; font-size:20px;">
              &times;
        </span>

        <h3>Detail Kegiatan</h3>

        <p><strong>Tanggal:</strong> <span id="modalTanggal"></span></p>
        <p><strong>Kegiatan:</strong> <span id="modalJudul"></span></p>
        <p><strong>Deskripsi:</strong></p>
        <p id="modalDeskripsi"></p>

    </div>

</div>

<script>
function openModal(tanggal, judul, deskripsi) {
    document.getElementById("modalTanggal").innerText = tanggal;
    document.getElementById("modalJudul").innerText = judul;
    document.getElementById("modalDeskripsi").innerText = deskripsi;
    document.getElementById("modalDetail").style.display = "block";
}

function closeModal() {
    document.getElementById("modalDetail").style.display = "none";
}

window.onclick = function(event) {
    let modal = document.getElementById("modalDetail");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

@endsection