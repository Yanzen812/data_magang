@extends('layouts.siswa')

@section('content')
<link rel="stylesheet" href="{{ asset('css/absensisiswa.css') }}">
<div class="absensi-wrapper">
    <div class="absensi-card">
        <h2>ABSENSI</h2>

        <div class="info-row">
            <span>Nama Siswa</span>
            <span>: Ahmad Naufal</span>
        </div>

        <div class="info-row">
            <span>Nomer Induk Siswa</span>
            <span>: 0903882862583</span>
        </div>

        <div class="info-row">
            <span>Sekolah atau Kampus</span>
            <span>: SMKN 10 SURABAYA</span>
        </div>

        <div class="info-row">
            <span>Tanggal</span>
            <span>: 12 Februari 2026</span>
        </div>

        <div class="info-row">
            <span>Waktu</span>
            <span>: Belum Absensi</span>
        </div>

        <div class="info-row">
            <span>Status</span>
            <span>: Belum Absensi</span>
        </div>

        <button class="btn-absen" onclick="openModal()">+ Absensi</button>
    </div>
</div>

<div class="modal-overlay" id="modalAbsensi">
    <div class="modal-box">
        <div class="modal-header">
            <span>ABSENSI</span>
            <button onclick="closeModal()">×</button>
        </div>

        <div class="modal-body">
            <label>Keterangan</label>
            <select>
                <option>Pilih</option>
                <option>Hadir</option>
                <option>Izin</option>
                <option>Sakit</option>
            </select>

            <button class="btn-submit">Absensi</button>
        </div>
    </div>
</div>

    </div>
</div>

<script>
function openModal() {
    document.getElementById('modalAbsensi').style.display = 'flex';
}
function closeModal() {
    document.getElementById('modalAbsensi').style.display = 'none';
}
</script>
@endsection
