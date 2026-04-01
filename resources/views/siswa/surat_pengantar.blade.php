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
                        <th>Aksi</th>
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
                            <td>
                                <span style="padding: 5px 10px; border-radius: 4px;
                                    @if($item->status == 'approved') background-color: #28a745; color: white;
                                    @elseif($item->status == 'rejected') background-color: #dc3545; color: white;
                                    @else background-color: #ffc107; color: black; @endif">
                                    {{ ucfirst($item->status ?? 'pending') }}
                                </span>
                            </td>
                            <td>
                                @if($item->file)
                                    <a href="{{ Storage::url($item->file) }}" target="_blank" class="btn-view">Lihat</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('surat_pengantar.delete', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Belum ada Surat Pengantar.</td>
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
        <h3>TAMBAH SURAT PENGANTAR</h3>

        <form action="{{ route('surat_pengantar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label>Surat Pengantar :</label>
                    <input type="file" name="file" accept=".pdf,.doc,.docx" required>
                    <small>Maksimal 5 MB (format: PDF, DOC, DOCX)</small>
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
