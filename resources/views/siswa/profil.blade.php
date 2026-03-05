@extends('layouts.siswa')

@section('content')
<link rel="stylesheet" href="{{ asset('css/absensisiswa.css') }}">

<div class="container">

    <div class="card p-4 shadow-sm">

        <h4 class="fw-bold mb-4">Profil</h4>

        <div class="row mb-2">
            <div class="col-md-3">Nama Siswa :</div>
            <div class="col-md-9">Ahmad Naufal</div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Nomer Induk Siswa :</div>
            <div class="col-md-9">09038828626583</div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Sekolah/kampus :</div>
            <div class="col-md-9">SMKN 10 SURABAYA</div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Jurusan :</div>
            <div class="col-md-9">Rekayasa Perangkat Lunak</div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Tanggal masuk :</div>
            <div class="col-md-9">01-01-2026</div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Tanggal Selesai :</div>
            <div class="col-md-9">01-03-2026</div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">No Tlp :</div>
            <div class="col-md-9">0877484637393</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">Alamat :</div>
            <div class="col-md-9">Waru</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">Jenis Kelamin :</div>
            <div class="col-md-9">Laki-Laki</div>
        </div>

        <!-- BUTTON BUKA POPUP -->
        <button class="btn btn-success" onclick="openModal()">
            Password
        </button>

    </div>

</div>


<!-- POPUP PASSWORD -->
<div class="modal-overlay" id="modalPassword">
    <div class="modal-box">
        <div class="modal-header">
            <span>UBAH PASSWORD</span>
            <button onclick="closeModal()">×</button>
        </div>

        <div class="modal-body">
            <form method="POST" action="#">
                @csrf

                <label>Password Baru</label>
                <input type="password" placeholder="Masukkan Password Baru">

                <button type="submit" class="btn-submit">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>


<script>
function openModal() {
    document.getElementById('modalPassword').style.display = 'flex';
}

function closeModal() {
    document.getElementById('modalPassword').style.display = 'none';
}
</script>

@endsection