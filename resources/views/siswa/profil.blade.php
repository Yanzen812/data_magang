@extends('layouts.siswa')

@section('content')
<link rel="stylesheet" href="{{ asset('css/absensisiswa.css') }}">

<div class="container">

    <div class="card p-4 shadow-sm">

            {{-- Flash messages --}}
            @if(session('success'))
                <div class="alert alert-success" style="margin-bottom:12px;">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" style="margin-bottom:12px;">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" style="margin-bottom:12px;">
                    <ul style="margin:0; padding-left:18px;">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <h4 class="fw-bold mb-4">Profil</h4>

        <div class="row mb-2">
            <div class="col-md-3">Nama Siswa :</div>
            <div class="col-md-9">{{ $siswa->nama ?? '-' }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Nomer Induk Siswa :</div>
            <div class="col-md-9">{{ $siswa->id ?? '-' }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Sekolah/kampus :</div>
            <div class="col-md-9">{{ $siswa->asal_sekolah ?? '-' }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Jurusan :</div>
            <div class="col-md-9">{{ $siswa->jurusan ?? '-' }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Periode :</div>
            <div class="col-md-9">{{ $siswa->periode ?? '-' }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">Kelompok :</div>
            <div class="col-md-9">{{ $siswa->kelompok ?? '-' }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">No Tlp :</div>
            <div class="col-md-9">{{ $siswa->kontak ?? '-' }}</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">Jenis Kelamin :</div>
            <div class="col-md-9">{{ $siswa->jenis_kelamin ?? '-' }}</div>
        </div>

        <!-- BUTTON BUKA POPUP -->
        <button class="btn btn-success" onclick="openModal()">
            Password
        </button>
        <button class="btn btn-primary" onclick="openEditModal()">
            Edit Profil
        </button>

    </div>

</div>

<!-- MODAL EDIT PROFIL -->
<div class="modal-overlay" id="modalEditProfil">
    <div class="modal-box">
        <div class="modal-header">
            <span>EDIT PROFIL</span>
            <button onclick="closeEditModal()">×</button>
        </div>

        <div class="modal-body">
            <form method="POST" action="{{ route('profile.update_profil') }}">
                @csrf

                <div class="form-group">
                    <label>Nama Siswa</label>
                    <input type="text" name="nama" value="{{ $siswa->nama ?? '' }}" placeholder="Masukkan Nama" required>
                </div>

                <div class="form-group">
                    <label>Sekolah/Kampus</label>
                    <input type="text" name="asal_sekolah" value="{{ $siswa->asal_sekolah ?? '' }}" placeholder="Masukkan Sekolah/Kampus">
                </div>

                <div class="form-group">
                    <label>Jurusan</label>
                    <input type="text" name="jurusan" value="{{ $siswa->jurusan ?? '' }}" placeholder="Masukkan Jurusan">
                </div>

                <div class="form-group">
                    <label>Periode</label>
                    <input type="text" name="periode" value="{{ $siswa->periode ?? '' }}" placeholder="Masukkan Periode">
                </div>

                <div class="form-group">
                    <label>Kelompok</label>
                    <input type="text" name="kelompok" value="{{ $siswa->kelompok ?? '' }}" placeholder="Masukkan Kelompok">
                </div>

                <div class="form-group">
                    <label>No Telp</label>
                    <input type="text" name="kontak" value="{{ $siswa->kontak ?? '' }}" placeholder="Masukkan No Telp">
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="L" {{ $siswa->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $siswa->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <button type="submit" class="btn-submit">
                    Simpan
                </button>
            </form>
        </div>
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
            <form id="formPassword" method="POST" action="{{ route('profile.update_password') }}">
                @csrf

                <label>Password Baru</label>
                <input id="password_baru" type="password" name="password_baru" placeholder="Masukkan Password Baru" required>

                <label>Konfirmasi Password</label>
                <input id="password_confirm" type="password" name="password_baru_confirmation" placeholder="Konfirmasi Password Baru" required>

                <div id="passwordError" style="color:#a94442; margin-top:8px; display:none;"></div>

                <button type="submit" class="btn-submit">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>


<script>
function openEditModal() {
    document.getElementById('modalEditProfil').style.display = 'flex';
}

function closeEditModal() {
    document.getElementById('modalEditProfil').style.display = 'none';
}

function openModal() {
    document.getElementById('modalPassword').style.display = 'flex';
}

function closeModal() {
    document.getElementById('modalPassword').style.display = 'none';
}

// Tutup modal ketika click di luar
window.addEventListener('click', function(e) {
    const editModal = document.getElementById('modalEditProfil');
    const passModal = document.getElementById('modalPassword');
    if (e.target === editModal) {
        editModal.style.display = 'none';
    }
    if (e.target === passModal) {
        passModal.style.display = 'none';
    }
});

// Client-side password confirmation check
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formPassword');
    if (!form) return;

    const pwd = document.getElementById('password_baru');
    const confirm = document.getElementById('password_confirm');
    const errDiv = document.getElementById('passwordError');

    function clearError() {
        errDiv.style.display = 'none';
        errDiv.textContent = '';
    }

    pwd.addEventListener('input', clearError);
    confirm.addEventListener('input', clearError);

    form.addEventListener('submit', function(e) {
        if (pwd.value !== confirm.value) {
            e.preventDefault();
            errDiv.textContent = 'Konfirmasi password tidak cocok.';
            errDiv.style.display = 'block';
            return false;
        }
        return true;
    });
});
</script>

@endsection
