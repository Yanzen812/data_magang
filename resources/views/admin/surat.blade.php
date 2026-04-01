@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/surat.css') }}">

<div class="content">

    <div class="search-panel">
        <h3>SURAT PENGANTAR</h3>
        <form method="GET" action="{{ route('surat') }}">
            <div class="top-bar">
                <input type="text" name="search" placeholder="Cari kelompok, pembimbing, atau sekolah..." value="{{ $request->get('search') }}">
                <select name="status" class="filter-select">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ $request->get('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="verified" {{ $request->get('status') === 'verified' ? 'selected' : '' }}>Verified</option>
                    <option value="rejected" {{ $request->get('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                <button class="btn-blue">Cari</button>
            </div>
        </form>
    </div>

    <div class="data-panel">
        <div class="action-bar">
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelompok</th>
                        <th>Pembimbing</th>
                        <th>Sekolah/Kampus</th>
                        <th>Status</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($surat as $index => $row)
                        <tr>
                            <td>{{ $surat->firstItem() + $index }}</td>
                            <td>{{ $row->kelompok }}</td>
                            <td>{{ $row->nama_pembimbing }}</td>
                            <td>{{ $row->asal_sekolah }}</td>
                            <td>
                                <select class="status-select" data-id="{{ $row->id }}" data-current="{{ $row->status }}">
                                    <option value="pending" {{ $row->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="verified" {{ $row->status === 'verified' ? 'selected' : '' }}>Verified</option>
                                    <option value="rejected" {{ $row->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </td>
                            <td>
                                @if($row->file)
                                    <a href="{{ asset('storage/' . $row->file) }}" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                @else
                                    <span style="margin-right:8px;">-</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-success save-status-btn" data-id="{{ $row->id }}">Simpan</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data surat pengantar</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top: 20px;">
            {{ $surat->links() }}
        </div>
    </div>
</div>

<style>
    .filter-select {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        background-color: white;
        margin: 0 8px;
        cursor: pointer;
    }

    .filter-select:hover {
        border-color: #888;
    }

    .status-select {
        padding: 5px 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .status-select:hover {
        border-color: #888;
    }

    .btn-success {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-success:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const saveButtons = document.querySelectorAll('.save-status-btn');

    saveButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const selectElement = document.querySelector(`.status-select[data-id="${id}"]`);
            const newStatus = selectElement.value;
            const originalStatus = selectElement.getAttribute('data-current');

            if (newStatus === originalStatus) {
                alert('Status tidak berubah');
                return;
            }

            // Disable button and show loading state
            this.disabled = true;
            const originalText = this.textContent;
            this.textContent = 'Menyimpan...';

            // Send AJAX request
            fetch(`{{ route('surat.update', ':id') }}`.replace(':id', id), {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                body: JSON.stringify({
                    status: newStatus,
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Status berhasil diperbarui');
                    selectElement.setAttribute('data-current', newStatus);
                    this.textContent = originalText;
                    this.disabled = false;
                    // Optional: reload page or update UI
                    // window.location.reload();
                } else {
                    alert('Gagal memperbarui status: ' + (data.message || 'Error tidak diketahui'));
                    selectElement.value = originalStatus;
                    this.textContent = originalText;
                    this.disabled = false;
                }
            })
            .catch(error => {
                alert('Error: ' + error.message);
                selectElement.value = originalStatus;
                this.textContent = originalText;
                this.disabled = false;
            });
        });
    });
});
</script>
@endsection
