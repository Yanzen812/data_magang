@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/data_guru_pembimbing.css') }}">

<div class="content">

    <div class="search-panel">
        <h3>DATA GURU PEMBIMBING</h3>
        <form method="GET" action="{{ route('guru') }}">
            <div class="top-bar">
                <input type="text" name="search" placeholder="Cari nama atau sekolah/kampus..." value="{{ $request->get('search') }}">
                <button class="btn-blue">Cari</button>
            </div>
        </form>
    </div>

    <div class="data-panel">
        <div class="action-bar">
            <button class="btn-green" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Data</button>
            <button class="btn-blue" data-bs-toggle="modal" data-bs-target="#kelompokModal" style="margin-left:8px;">Kelompokkan Siswa</button>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Sekolah/Kampus</th>
                        <th>Kontak</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guru as $index => $row)
                        <tr>
                            <td>{{ $guru->firstItem() + $index }}</td>
                            <td>{{ $row->nama_pembimbing }}</td>
                            <td>{{ $row->asal_sekolah }}</td>
                            <td>{{ $row->kontak }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $row->id }}" data-nama="{{ $row->nama_pembimbing }}" data-sekolah="{{ $row->asal_sekolah }}" data-kontak="{{ $row->kontak }}">Edit Data</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteGuru({{ $row->id }})">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data guru pembimbing</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top: 20px;">
            {{ $guru->links() }}
        </div>
    </div>
</div>

<!-- Modal Kelompokkan Siswa -->
<div class="modal fade" id="kelompokModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kelompokkan Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formKelompok" method="POST" action="{{ route('guru.assign_group') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="kelompokName" class="form-label">Nama Kelompok</label>
                        <input type="text" class="form-control" id="kelompokName" name="kelompok" placeholder="Masukkan nama kelompok (mis. Kelompok A)" required>
                    </div>
                    <div class="mb-3">
                        <label for="pembimbingSelect" class="form-label">Pilih Guru Pembimbing (opsional)</label>
                        <select id="pembimbingSelect" name="id_pembimbing" class="form-select">
                            <option value="">-- Tidak memilih pembimbing --</option>
                            @foreach($pembimbing as $pb)
                                <option value="{{ $pb->id }}">{{ $pb->nama_pembimbing }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pilih Siswa</label>
                        <div style="max-height: 300px; overflow:auto; border:1px solid #ddd; padding:8px;">
                            <div style="margin-bottom:8px;"><input type="checkbox" id="selectAllSiswa"> <label for="selectAllSiswa">Pilih Semua</label></div>
                            @foreach($siswa as $s)
                                <div class="form-check">
                                    <input class="form-check-input siswa-checkbox" type="checkbox" name="siswa_ids[]" value="{{ $s->id }}" id="siswa_{{ $s->id }}">
                                    <label class="form-check-label" for="siswa_{{ $s->id }}">{{ $s->nama }} (@if($s->asal_sekolah) {{ $s->asal_sekolah }} @else - @endif) @if($s->kelompok) - <strong>{{ $s->kelompok }}</strong> @endif</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" onclick="document.getElementById('formKelompok').submit()">Simpan Kelompok</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Guru Pembimbing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formTambahGuru" method="POST" action="{{ route('guru.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" placeholder="Masukkan nama guru" name="nama_pembimbing" value="{{ old('nama_pembimbing') }}">
                    </div>
                    <div class="mb-3">
                        <label for="sekolah" class="form-label">Sekolah/Kampus</label>
                        <input type="text" class="form-control" id="sekolah" placeholder="Masukkan sekolah atau kampus" name="asal_sekolah" value="{{ old('asal_sekolah') }}">
                    </div>
                    <div class="mb-3">
                        <label for="kontak" class="form-label">Kontak</label>
                        <input type="text" class="form-control" id="kontak" placeholder="Masukkan kontak" name="kontak" value="{{ old('kontak') }}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" onclick="document.getElementById('formTambahGuru').submit()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Guru Pembimbing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formEditGuru" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNama" placeholder="Masukkan nama guru" name="nama_pembimbing">
                    </div>
                    <div class="mb-3">
                        <label for="editSekolah" class="form-label">Sekolah/Kampus</label>
                        <input type="text" class="form-control" id="editSekolah" placeholder="Masukkan sekolah atau kampus" name="asal_sekolah">
                    </div>
                    <div class="mb-3">
                        <label for="editKontak" class="form-label">Kontak</label>
                        <input type="text" class="form-control" id="editKontak" placeholder="Masukkan kontak" name="kontak">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" onclick="document.getElementById('formEditGuru').submit()">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Handle Edit Modal - populate fields from button data attributes
    document.getElementById('editModal').addEventListener('show.bs.modal', function(e) {
        const button = e.relatedTarget;
        const id = button.dataset.id;

        document.getElementById('editNama').value = button.dataset.nama || '';
        document.getElementById('editSekolah').value = button.dataset.sekolah || '';
        document.getElementById('editKontak').value = button.dataset.kontak || '';

        // Set form action to correct route
        document.getElementById('formEditGuru').action = '/guru/' + id;
    });

    function deleteGuru(id) {
        if(confirm('Apakah Anda yakin ingin menghapus data guru pembimbing ini?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/guru/' + id;
            form.innerHTML = '<input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}">';
            document.body.appendChild(form);
            form.submit();
        }
    }

    // Select all siswa checkbox handling
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('selectAllSiswa');
        if (selectAll) {
            selectAll.addEventListener('change', function() {
                const checked = this.checked;
                document.querySelectorAll('.siswa-checkbox').forEach(cb => cb.checked = checked);
            });
        }
    });
</script>

@endsection
