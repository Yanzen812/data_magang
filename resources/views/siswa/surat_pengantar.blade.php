@extends('layouts.siswa')

@section('content')
<link rel="stylesheet" href="{{ asset('css/surat_pengantar.css') }}">

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
        <div class="action-bar">
            <button class="btn-green" id="btnTambah">Tambah Data</button>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Sekolah Kampus</th>
                        <th>Kontak</th>
                        <th>Jurusan</th>
                        <th>Periode Magang</th>
                        <th>Status</th>
                        <th>Surat Pengantar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suratPengantar as $index => $item)
                        <tr>
                            <td>{{ $suratPengantar->firstItem() + $index }}</td>
                            <td>{{ $item->siswa->nama ?? ($siswa->nama ?? '-') }}</td>
                            <td>{{ $item->siswa->asal_sekolah ?? '-' }}</td>
                            <td>{{ $item->siswa->kontak ?? '-' }}</td>
                            <td>{{ $item->siswa->jurusan ?? '-' }}</td>
                            <td>{{ $item->siswa->periode ?? '-' }}</td>
                            <td>{{ $item->status ?? '-' }}</td>
                            <td>
                                @if($item->file)
                                    <a href="{{ Storage::url($item->file) }}" target="_blank" class="btn-view">Lihat</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada Surat Pengantar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">{{ $suratPengantar->links() }}</div>
    </div>
</div>

<!-- ================= MODAL TAMBAH SISWA ================= -->

<div class="modal-overlay" id="modalOverlay">
    <div class="modal-box">
        <span class="close-btn" id="closeModal">&times;</span>
        <h3>TAMBAH SISWA</h3>

        <form>
            <div class="form-row">
                <div class="form-group">
                    <label>Nama :</label>
                    <input type="text" placeholder="Masukkan Nama Siswa">
                </div>

                <div class="form-group">
                    <label>Periode Magang :</label>
                    <input type="text" placeholder="Masukkan Periode Magang">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Sekolah/Kampus :</label>
                    <input type="text" placeholder="Masukkan Nama Sekolah/Kampus">
                </div>

                <div class="form-group">
                    <label>Surat Pengantar :</label>
                    <input type="file">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Kontak :</label>
                    <input type="text" placeholder="Masukkan Kontak">
                </div>

                <div class="form-group">
                    <label>Jurusan :</label>
                    <input type="text" placeholder="Masukkan Jurusan">
                </div>
            </div>

            <button type="submit" class="btn-green">Tambah Data</button>
        </form>
    </div>
</div>

<!-- ================= SCRIPT MODAL ================= -->

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
