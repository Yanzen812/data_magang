@extends('layouts.siswa')

@section('content')
<link rel="stylesheet" href="{{ asset('css/absensisiswa.css') }}">
<div class="absensi-wrapper">
    <div class="absensi-card">
        <h2>ABSENSI</h2>

                <div class="info-row">
            <span>Nama Siswa</span>
            <span>: {{ $siswa->nama ?? 'Tidak tersedia' }}</span>
        </div>

        <div class="info-row">
            <span>Nomer Induk Siswa</span>
            <span>: {{ $siswa->id ?? 'Tidak tersedia' }}</span>
        </div>

        <div class="info-row">
            <span>Sekolah atau Kampus</span>
            <span>: {{ $siswa->asal_sekolah ?? 'Tidak tersedia' }}</span>
        </div>

        <div class="info-row">
            <span>Tanggal</span>
            <span>: {{ now()->format('d F Y') }}</span>
        </div>

        <div class="info-row">
            <span>Waktu</span>
            <span>: {{ $todayAbsensi ? $todayAbsensi->waktu_datang : 'Belum Absensi' }}</span>
        </div>

        <div class="info-row">
            <span>Status</span>
            <span>: {{ $todayAbsensi ? strtoupper($todayAbsensi->status) : 'Belum Absensi' }}</span>
        </div>

        <button class="btn-absen" onclick="openModal()" {{ $todayAbsensi ? 'disabled' : '' }}>{{ $todayAbsensi ? 'Absensi Terpenuhi' : '+ Absensi' }}</button>
    </div>

    {{-- <div class="absensi-history">
        <h3>Riwayat Absensi Terbaru</h3>
        @if($absensi->isEmpty())
            <p>Belum ada riwayat absensi.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($absensi as $item)
                        <tr>
                            <td>{{ is_string($item->tanggal) ? \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') : ($item->tanggal ? $item->tanggal->format('d-m-Y') : '-') }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->waktu_datang ?? '-' }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div> --}}
</div>

<div class="modal-overlay" id="modalAbsensi">
    <div class="modal-box">
        <div class="modal-header">
            <span>ABSENSI</span>
            <button onclick="closeModal()">×</button>
        </div>

        <div class="modal-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('absensi_siswa.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control" required {{ $todayAbsensi ? 'disabled' : '' }}>
                        <option value="">Pilih</option>
                        <option value="h">Hadir</option>
                        <option value="i">Izin</option>
                        <option value="s">Sakit</option>
                        <option value="t">Terlambat</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan (opsional)</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control" maxlength="255" placeholder="Contoh: Ada tugas dokter" {{ $todayAbsensi ? 'disabled' : '' }}>
                </div>

                <button type="submit" class="btn-submit" {{ $todayAbsensi ? 'disabled' : '' }}>Absensi</button>
            </form>
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
