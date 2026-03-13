@extends('layouts.siswa')

@section('content')
<link rel="stylesheet" href="{{ asset('css/laporan_magang.css') }}">

<div class="content">

    <h3>Laporan Magang</h3>

    <!-- RINGKASAN -->
    <div class="summary-wrapper">

        <div class="summary-card">
            <div class="summary-title">Nilai Rata-Rata</div>
            <div class="summary-value value-green">{{ number_format($rataRataNilai ?? 0, 2) }}</div>
        </div>

        <div class="summary-card">
            <div class="summary-title">Total Kehadiran</div>
            <div class="summary-value value-yellow">{{ $totalKehadiran ?? 0 }} Hari</div>
        </div>

        <div class="summary-card">
            <div class="summary-title">Total Kegiatan</div>
            <div class="summary-value value-blue">{{ $totalKegiatan ?? 0 }}</div>
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
                    @forelse($riwayatKegiatan as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $item->deskripsi_kegiatan }}</td>
                            <td>
                                <a href="#" class="btn-view" onclick="openDetailModal(event, '{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}', '{{ addslashes($item->deskripsi_kegiatan) }}')">Lihat</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada riwayat kegiatan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

<!-- ================= MODAL DETAIL KEGIATAN ================= -->

<div class="modal-overlay" id="modalDetailKegiatan">
    <div class="modal-box">
        <div class="modal-header">
            <span>DETAIL KEGIATAN</span>
            <button onclick="closeDetailModal()">×</button>
        </div>

        <div class="modal-body">
            <div class="info-field">
                <label>Tanggal :</label>
                <p id="detailTanggal">-</p>
            </div>

            <div class="info-field">
                <label>Keterangan Kegiatan :</label>
                <p id="detailKegiatan">-</p>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn-secondary" onclick="closeDetailModal()">Tutup</button>
        </div>
    </div>
</div>

<!-- ================= SCRIPT ================= -->

<script>
function openDetailModal(event, tanggal, kegiatan) {
    event.preventDefault();
    document.getElementById('detailTanggal').textContent = tanggal;
    document.getElementById('detailKegiatan').textContent = kegiatan;
    document.getElementById('modalDetailKegiatan').style.display = 'flex';
}

function closeDetailModal() {
    document.getElementById('modalDetailKegiatan').style.display = 'none';
}

// Tutup modal ketika click di luar
window.addEventListener('click', function(event) {
    const modal = document.getElementById('modalDetailKegiatan');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});
</script>
@endsection
