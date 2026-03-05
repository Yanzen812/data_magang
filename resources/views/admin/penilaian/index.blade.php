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
                            <td>{{ $row->nama_pembimbing ?? 'N/A' }}</td>
                            <td>
                                @if($row->id)
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#nilaiModal" data-id="{{ $row->id }}" data-siswa-id="{{ $row->siswa_id }}" data-nama="{{ $row->nama }}" data-sekolah="{{ $row->asal_sekolah }}" data-kedisipinan="{{ $row->kedisipinan }}" data-kerja-sama="{{ $row->kerja_sama }}" data-responsibilitas="{{ $row->responsibilitas }}">Edit Nilai</button>
                                    <button class="btn btn-sm btn-danger" onclick="deletePenilaian({{ $row->id }})">Hapus</button>
                                @else
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#nilaiModal" data-siswa-id="{{ $row->siswa_id }}" data-nama="{{ $row->nama }}" data-sekolah="{{ $row->asal_sekolah }}">Tambah Nilai</button>
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

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahModal" tabindex="-1">
<!-- Modal Nilai -->
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
                                        <div id="methodField"></div>
                                        <input type="hidden" id="siswaId" name="id_users">
                    </div>
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
                <button type="button" class="btn btn-primary" onclick="document.getElementById('formNilai').submit()">Simpan</button>
            </div>
        </div>
    </div>
</div>


@endsection
<script>
    // Handle Nilai Modal - populate fields from button data attributes
    document.getElementById('nilaiModal').addEventListener('show.bs.modal', function(e) {
        const button = e.relatedTarget;
        const id = button.dataset.id;
        const siswaId = button.dataset.siswaId;

        document.getElementById('nama').value = button.dataset.nama || '';
        document.getElementById('sekolah').value = button.dataset.sekolah || '';
        document.getElementById('siswaId').value = siswaId;
        
        // Populate existing penilaian values if editing
        if (button.dataset.kedisipinan) {
            document.getElementById('kedisipinan').value = button.dataset.kedisipinan;
            document.getElementById('kerja_sama').value = button.dataset.kerjaSama;
            document.getElementById('responsibilitas').value = button.dataset.responsibilitas;
            document.getElementById('formNilai').action = '/penilaian/' + id;
            document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        } else {
            // For new entries, reset form
            document.getElementById('kedisipinan').value = '';
            document.getElementById('kerja_sama').value = '';
            document.getElementById('responsibilitas').value = '';
            document.getElementById('formNilai').action = '/penilaian';
            document.getElementById('methodField').innerHTML = '';
        }
    });

    function deletePenilaian(id) {
        if(confirm('Apakah Anda yakin ingin menghapus data penilaian ini?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/penilaian/' + id;
            form.innerHTML = '<input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}">';
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
