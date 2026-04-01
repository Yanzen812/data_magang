@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/penilaian.css') }}">

<div class="content">

    <div class="search-panel">
        <h3>DATA PENILAIAN MAGANG</h3>
        <form method="GET" action="{{ route('penilaian') }}">
            <div class="top-bar">
                <input type="text" name="search" placeholder="Cari nama, sekolah, atau pembimbing..." value="{{ $request->get('search') }}">
                <button class="btn-blue">Cari</button>
            </div>
        </form>
    </div>

    <div class="data-panel">
        {{-- <div class="action-bar">
            <button class="btn-green" data-bs-toggle="modal" data-bs-target="#nilaiModal">Nilai</button>
        </div> --}}

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Sekolah Kampus</th>
                        <th>Guru Pembimbing</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penilaian as $index => $row)
                        <tr>
                            <td>{{ $penilaian->firstItem() + $index }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->asal_sekolah }}</td>
                            <td>{{ $row->pembimbing_siswa_nama ?? $row->nama_pembimbing ?? 'N/A' }}</td>
                            <td>
                                @if($row->id)
                                    <button class="btn btn-sm btn-primary" onclick="openEditModal({{ $row->id }}, {{ $row->siswa_id }}, {{ $row->id_guru }}, {{ $row->pembimbing_siswa_id }}, '{{ $row->nama }}', '{{ $row->asal_sekolah }}', {{ $row->kedisipinan }}, {{ $row->kerja_sama }}, {{ $row->responsibilitas }})">Edit Nilai</button>
                                    <button class="btn btn-sm btn-danger" onclick="openDeleteConfirm({{ $row->id }}, '{{ $row->nama }}')">Hapus</button>
                                @else
                                    <button class="btn btn-sm btn-success" onclick="openTambahModal({{ $row->siswa_id }}, {{ $row->pembimbing_siswa_id }}, '{{ $row->nama }}', '{{ $row->asal_sekolah }}')">Tambah Nilai</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data penilaian</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
        <div style="margin-top: 20px;">
            {{ $penilaian->links() }}
        </div>

<!-- Modal Edit Nilai -->
<div class="modal fade" id="nilaiModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Nilai Penilaian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formNilai" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" placeholder="Nama siswa" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="sekolah" class="form-label">Sekolah/Kampus</label>
                        <input type="text" class="form-control" id="sekolah" placeholder="Sekolah/Kampus" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="guru" class="form-label">Guru Pembimbing</label>
                        <select class="form-control" id="guru" name="id_guru" required>
                            <option value="">-- Pilih Guru Pembimbing --</option>
                            @foreach($pembimbing as $pb)
                                <option value="{{ $pb->id }}">{{ $pb->nama_pembimbing }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="methodField"></div>
                    <input type="hidden" id="siswaId" name="id_siswa">
                    <div class="mb-3">
                        <label for="kedisipinan" class="form-label">Kedisiplinan</label>
                        <input type="number" class="form-control" id="kedisipinan" placeholder="Masukkan nilai kedisiplinan" name="kedisipinan" min="1" max="100" required>
                    </div>
                    <div class="mb-3">
                        <label for="kerja_sama" class="form-label">Kerja Sama</label>
                        <input type="number" class="form-control" id="kerja_sama" placeholder="Masukkan nilai kerja sama" name="kerja_sama" min="1" max="100" required>
                    </div>
                    <div class="mb-3">
                        <label for="responsibilitas" class="form-label">Responsibilitas</label>
                        <input type="number" class="form-control" id="responsibilitas" placeholder="Masukkan nilai responsibilitas" name="responsibilitas" min="1" max="100" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Custom Delete Confirmation Modal -->
<div id="deleteConfirmModal" class="custom-modal" style="display: none;">
    <div class="modal-overlay" onclick="closeDeleteConfirm()"></div>
    <div class="modal-content-custom">
        <div class="modal-header-custom">
            <h5>Konfirmasi Hapus</h5>
            <button type="button" class="close-btn" onclick="closeDeleteConfirm()">×</button>
        </div>
        <div class="modal-body-custom">
            <p id="deleteMessage">Apakah Anda yakin ingin menghapus data penilaian ini?</p>
        </div>
        <div class="modal-footer-custom">
            <button type="button" class="btn btn-secondary" onclick="closeDeleteConfirm()">Batal</button>
            <button type="button" class="btn btn-danger" id="confirmDeleteBtn" onclick="confirmDelete()">Hapus</button>
        </div>
    </div>
</div>

<style>
    /* Custom Modal Styles */
    .custom-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1050;
    }

    .modal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        cursor: pointer;
    }

    .modal-content-custom {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        min-width: 350px;
        max-width: 500px;
        z-index: 1051;
    }

    .modal-header-custom {
        padding: 20px;
        border-bottom: 1px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header-custom h5 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        color: #333;
    }

    .close-btn {
        background: none;
        border: none;
        font-size: 28px;
        cursor: pointer;
        color: #999;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .close-btn:hover {
        color: #333;
    }

    .modal-body-custom {
        padding: 20px;
        color: #666;
        line-height: 1.6;
    }

    .modal-footer-custom {
        padding: 15px 20px;
        border-top: 1px solid #e0e0e0;
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-primary {
        background-color: #0d6efd;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
    }
</style>

@endsection
<script>
    let deleteIdToConfirm = null;

    // Open Tambah Modal untuk siswa baru
    function openTambahModal(siswaId, pembimbingId, nama, sekolah) {
        document.getElementById('nama').value = nama;
        document.getElementById('sekolah').value = sekolah;
        document.getElementById('siswaId').value = siswaId;
        document.getElementById('guru').value = pembimbingId || '';
        document.getElementById('kedisipinan').value = '';
        document.getElementById('kerja_sama').value = '';
        document.getElementById('responsibilitas').value = '';
        document.getElementById('formNilai').action = '/penilaian';
        document.getElementById('methodField').innerHTML = '';

        // Show modal using Bootstrap
        const modal = new bootstrap.Modal(document.getElementById('nilaiModal'));
        modal.show();
    }

    // Open Edit Modal/Popup
    function openEditModal(id, siswaId, guruId, pembimbingId, nama, sekolah, kedisipinan, kerjaSama, responsibilitas) {
        document.getElementById('nama').value = nama;
        document.getElementById('sekolah').value = sekolah;
        document.getElementById('siswaId').value = siswaId;
        // Use guru from penilaian, or fallback to siswa's pembimbing
        document.getElementById('guru').value = guruId || pembimbingId || '';
        document.getElementById('kedisipinan').value = kedisipinan;
        document.getElementById('kerja_sama').value = kerjaSama;
        document.getElementById('responsibilitas').value = responsibilitas;
        document.getElementById('formNilai').action = '/penilaian/' + id;
        document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';

        // Show modal using Bootstrap
        const modal = new bootstrap.Modal(document.getElementById('nilaiModal'));
        modal.show();
    }

    // Submit Form
    function submitForm() {
        const form = document.getElementById('formNilai');

        // Validate form
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        form.submit();
    }

    // Open Delete Confirmation Popup
    function openDeleteConfirm(id, nama) {
        deleteIdToConfirm = id;
        document.getElementById('deleteMessage').innerHTML = `Apakah Anda yakin ingin menghapus data penilaian untuk <strong>${nama}</strong>?`;
        document.getElementById('deleteConfirmModal').style.display = 'block';
    }

    // Close Delete Confirmation Popup
    function closeDeleteConfirm() {
        document.getElementById('deleteConfirmModal').style.display = 'none';
        deleteIdToConfirm = null;
    }

    // Confirm Delete
    function confirmDelete() {
        if (deleteIdToConfirm) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/penilaian/' + deleteIdToConfirm;
            form.innerHTML = '<input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}">';
            document.body.appendChild(form);
            form.submit();
        }
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        const deleteModal = document.getElementById('deleteConfirmModal');
        if (event.target === deleteModal.querySelector('.modal-overlay')) {
            closeDeleteConfirm();
        }
    });
</script>


