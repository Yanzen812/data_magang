@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/surat.css') }}">

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
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Sekolah Kampus</th>
                        <th>Kontak</th>
                        <th>Jurusan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Nama Siswa</td>
                        <td>SMK Negeri 1</td>
                        <td>08123456789</td>
                        <td>RPL</td>
                        <td>
                            <span class="badge bg-warning text-dark" id="statusBadge">
                                Pending
                            </span>
                        </td>
                        <td style="text-align:center;">
                            <button class="btn-blue"
                                data-bs-toggle="modal"
                                data-bs-target="#lihatSuratModal">
                                Lihat Surat
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ================= MODAL LIHAT SURAT ================= -->
<div class="modal fade" id="lihatSuratModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Surat Pengantar Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <!-- Preview Surat -->
                <div style="border:1px solid #ccc; padding:15px; max-height:400px; overflow:auto; background:#f9f9f9;">
                    <h5 style="text-align:center;">SURAT PENGANTAR MAGANG</h5>
                    <p>Yang bertanda tangan di bawah ini menerangkan bahwa:</p>
                    <p>
                        Nama : Nama Siswa <br>
                        Sekolah : SMK Negeri 1 <br>
                        Jurusan : RPL
                    </p>
                    <p>
                        Adalah benar siswa tersebut mengajukan permohonan magang
                        di perusahaan kami.
                    </p>
                    <p>Demikian surat ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-danger" onclick="tolakSurat()">Tolak</button>
                <button class="btn btn-success" onclick="terimaSurat()">Terima</button>
            </div>

        </div>
    </div>
</div>

<!-- ================= SCRIPT UPDATE STATUS ================= -->
<script>
    function terimaSurat() {
        const badge = document.getElementById("statusBadge");
        badge.className = "badge bg-success";
        badge.innerText = "Terverifikasi";
        var modal = bootstrap.Modal.getInstance(document.getElementById('lihatSuratModal'));
        modal.hide();
    }

    function tolakSurat() {
        const badge = document.getElementById("statusBadge");
        badge.className = "badge bg-danger";
        badge.innerText = "Ditolak";
        var modal = bootstrap.Modal.getInstance(document.getElementById('lihatSuratModal'));
        modal.hide();
    }
</script>

@endsection