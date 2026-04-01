@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/data_absensi.css') }}">

<div class="content">

    <div class="search-panel">
        <h3>DATA ABSENSI</h3>
        <form method="GET" action="{{ route('absensi') }}">
            <div class="top-bar">
                <input type="text" name="search" placeholder="Cari nama atau sekolah/kampus..." value="{{ $request->get('search') }}">
                <button class="btn-blue">Cari</button>
            </div>
        </form>
    </div>
    <div class="data-panel">
        <div class="action-bar">
            <button class="btn-blue" onclick="window.location.href='{{ route('absensi') }}'">Refresh</button>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Sekolah Kampus</th>
                        <th>Tanggal</th>
                        <th>Waktu Datang</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absensi as $index => $row)
                        <tr>
                            <td>{{ $absensi->firstItem() + $index }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->asal_sekolah }}</td>
                            <td>{{ $row->tanggal ? \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') : '-' }}</td>
                            <td>{{ $row->waktu_datang ?? '-' }}</td>
                            <td>
                                @if($row->status == 'h')
                                    <span class="badge bg-success">Hadir</span>
                                @elseif($row->status == 'i')
                                    <span class="badge bg-warning">Izin</span>
                                @elseif($row->status == 's')
                                    <span class="badge bg-info">Sakit</span>
                                @elseif($row->status == 't')
                                    <span class="badge bg-danger">Terlambat</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="deleteData({{ $row->id }})">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data absensi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top: 20px;">
            {{ $absensi->links() }}
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formEditAbsensi">
                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNama" placeholder="Masukkan nama" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="editSekolah" class="form-label">Sekolah/Kampus</label>
                        <input type="text" class="form-control" id="editSekolah" placeholder="Masukkan sekolah atau kampus" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="editTanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="editTanggal">
                    </div>
                    <div class="mb-3">
                        <label for="editKeterangan" class="form-label">Status</label>
                        <select class="form-control" id="editKeterangan">
                            <option value="h">Hadir</option>
                            <option value="i">Izin</option>
                            <option value="s">Sakit</option>
                            <option value="t">Terlambat</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="updateAbsensi()">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    function deleteData(id) {
        if(confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/absensi/' + id;
            form.innerHTML = '<input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}">';
            document.body.appendChild(form);
            form.submit();
        }
    }

    function loadEditData(id) {
        // TODO: fetch data via AJAX and populate modal fields
        console.log('Load edit data:', id);
    }

    function updateAbsensi() {
        // TODO: submit update via AJAX or form
        console.log('Update absensi');
        // after update, close modal and refresh
        // var modal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
        // modal.hide();
    }
</script>

@endsection
