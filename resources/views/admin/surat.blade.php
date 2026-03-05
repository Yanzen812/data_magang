@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/surat.css') }}">

<div class="content">

    <div class="search-panel">
        <h3>SURAT PENGANTAR</h3>
        <form method="GET" action="{{ route('surat') }}">
            <div class="top-bar">
                <input type="text" name="search" placeholder="Cari kelompok, pembimbing, atau sekolah..." value="{{ $request->get('search') }}">
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
                            <td>{{ ucfirst($row->status) }}</td>
                            <td>
                                @if($row->file)
                                    <a href="{{ asset('storage/' . $row->file) }}" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <!-- action buttons if needed -->
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
@endsection
