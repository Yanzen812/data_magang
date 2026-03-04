@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/penilaian.css') }}">

<div class="content">

    <div class="search-panel">
        <h3>DATA PENILAIAN MAGANG</h3>
        <div class="top-bar">
            <input type="text" placeholder="Pencarian Nama">
            <input type="text" placeholder="Cari Sekolah atau Kampus">
            <button class="btn-blue">Cari</button>
        </div>
    </div>

    <div class="data-panel">
        <div class="action-bar">
            <button class="btn-green" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Data</button>
            <button class="btn-red">Hapus Data</button>
            <button class="btn-yellow" data-bs-toggle="modal" data-bs-target="#editModal">Edit Data</button>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Sekolah Kampus</th>
                        <th>Guru Pembimbing</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>1</td>
                        <td>Nama Siswa</td>
                        <td>SMK / Kampus</td>
                        <td>Nama Guru</td>
                        <td style="text-align: center;">
                            <button class="btn-green"
                                data-bs-toggle="modal"
                                data-bs-target="#nilaiModal">
                                Nilai
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ================= MODAL TAMBAH ================= -->
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Penilaian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sekolah/Kampus</label>
                        <input type="text" class="form-control" placeholder="Masukkan sekolah atau kampus">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Guru Pembimbing</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama guru pembimbing">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL EDIT ================= -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Penilaian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sekolah/Kampus</label>
                        <input type="text" class="form-control" placeholder="Masukkan sekolah atau kampus">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Guru Pembimbing</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama guru pembimbing">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL NILAI ================= -->
<div class="modal fade" id="nilaiModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Penilaian Siswa Magang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form>

                    <div class="mb-3">
                        <label class="form-label">Disiplin</label>
                        <input type="number" class="form-control nilai-input" id="disiplin" min="0" max="100" placeholder="0 - 100">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kerjasama</label>
                        <input type="number" class="form-control nilai-input" id="kerjasama" min="0" max="100" placeholder="0 - 100">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggung Jawab</label>
                        <input type="number" class="form-control nilai-input" id="tanggungjawab" min="0" max="100" placeholder="0 - 100">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nilai Akhir</label>
                        <input type="number" class="form-control" id="nilaiakhir" readonly>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary">Simpan Nilai</button>
            </div>
        </div>
    </div>
</div>

<!-- ================= SCRIPT AUTO HITUNG ================= -->
<script>
    document.addEventListener("DOMContentLoaded", function () {

        const inputs = document.querySelectorAll('.nilai-input');

        inputs.forEach(input => {
            input.addEventListener('input', hitungNilaiAkhir);
        });

        function hitungNilaiAkhir() {
            let disiplin = parseFloat(document.getElementById('disiplin').value) || 0;
            let kerjasama = parseFloat(document.getElementById('kerjasama').value) || 0;
            let tanggungjawab = parseFloat(document.getElementById('tanggungjawab').value) || 0;

            let rataRata = (disiplin + kerjasama + tanggungjawab) / 3;

            document.getElementById('nilaiakhir').value = rataRata.toFixed(2);
        }

    });
</script>

@endsection