@extends('layouts.siswa')

@section('content')
<link rel="stylesheet" href="{{ asset('css/kegiatansiswa.css') }}">

<div class="content">

    <h3>DATA KEGIATAN</h3>

    <div class="data-panel">

        <div class="action-bar">
            <button class="btn-red" id="btnHapus" style="display:none;">Hapus Data</button>
            <button class="btn-green" id="btnTambah">Tambah Data</button>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kegiatan</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kegiatan as $index => $item)
                        <tr>
                            <td>{{ $kegiatan->firstItem() + $index }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $item->deskripsi_kegiatan }}</td>
                            <td>
                                 @if($item->file)
                                    <a href="{{ Storage::url($item->file) }}" target="_blank" class="btn-view" style="margin-right:8px; background-color: #007bff; color: white; padding: 5px 10px; border-radius: 4px; text-decoration: none;">Lihat</a>
                                @else
                                    <span style="margin-right:8px;">-</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('kegiatan_siswa.delete', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada kegiatan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top: 20px;">
            {{ $kegiatan->links() }}
        </div>

<div class="modal-overlay" id="modalOverlay">
    <div class="modal-box">
        <span class="close-btn" id="closeModal">&times;</span>
        <h3>TAMBAH KEGIATAN</h3>

        <form action="{{ route('kegiatansiswa.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label>Tanggal :</label>
                    <input type="date" name="tanggal" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Kegiatan :</label>
                    <textarea name="deskripsi_kegiatan" placeholder="Masukkan Kegiatan" required></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Bukti :</label>
                    <input type="file" name="file">
                </div>
            </div>

            <button type="submit" class="btn-green">Tambah Data</button>
        </form>
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
</script>

@endsection
