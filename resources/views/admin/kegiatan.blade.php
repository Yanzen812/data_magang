@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/data_kegiatan.css') }}">

<div class="content">

    <div class="search-panel">
        <h3>DATA KEGIATAN</h3>
        <form method="GET" action="{{ route('kegiatan') }}">
            <div class="top-bar">
                <input type="text" name="search" placeholder="Cari nama, sekolah, atau kegiatan..." value="{{ $request->get('search') }}">
                <button class="btn-blue">Cari</button>
            </div>
        </form>
    </div>

    <div class="data-panel">

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Sekolah Kampus</th>
                        <th>Tanggal</th>
                        <th>Kegiatan</th>
                        <th>Bukti</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kegiatan as $index => $row)
                        <tr>
                            <td>{{ $kegiatan->firstItem() + $index }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->asal_sekolah }}</td>
                            <td>{{ $row->tanggal ? \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') : '-' }}</td>
                            <td>{{ $row->deskripsi_kegiatan }}</td>
                            <td>
                                @if($row->file)
                                    <a href="{{ asset('storage/' . $row->file) }}" class="btn btn-sm btn-info" target="_blank">Lihat</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="deleteKegiatan({{ $row->id }})">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data kegiatan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top: 20px;">
            {{ $kegiatan->links() }}
        </div>
    </div>
</div>

<script>
    function deleteKegiatan(id) {
        if(confirm('Apakah Anda yakin ingin menghapus data kegiatan ini?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/kegiatan/' + id;
            form.innerHTML = '<input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}">';
            document.body.appendChild(form);
            form.submit();
        }
    }

    function loadEditKegiatan(id) {
        // Implementasi untuk load data kegiatan ke modal edit
        console.log('Load edit kegiatan:', id);
    }
</script>

@endsection
