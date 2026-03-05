@extends('layouts.admin')

@php
    use Carbon\Carbon;
@endphp

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<div class="dashboard-container">

    <h2 class="page-title">DASHBOARD</h2>

    <div class="card-grid">
        <div class="stat-card red">
            <p>Total Siswa Magang</p>
            <h3>{{ $total_siswa }}</h3>
        </div>

        <div class="stat-card green">
            <p>Total Hadir</p>
            <h3>{{ $total_hadir }}</h3>
        </div>

        <div class="stat-card yellow">
            <p>Total Guru Pembimbing</p>
            <h3>{{ $total_pembimbing }}</h3>
        </div>

        <div class="stat-card pink">
            <p>Izin dan Sakit</p>
            <h3>{{ $izin_sakit }}</h3>
        </div>
    </div>

    <div class="table-grid">
        <div class="table-box">
            <h4>Siswa Magang yang Terlambat</h4>
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Asal Sekolah</th>
                        <th>Waktu Masuk</th>
                        <th>Keterlambatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($terlambat as $row)
                        <tr>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->asal_sekolah }}</td>
                            <td>{{ $row->waktu_datang }}</td>
                            <td>{{ $row->waktu_datang }} Menit</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada siswa terlambat hari ini</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-box">
            <h4>Aktivitas Hari Ini</h4>
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Kegiatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aktivitas as $act)
                        <tr>
                            <td>{{ $act->nama }}</td>
                            <td>{{ $act->tanggal ? \Carbon\Carbon::parse($act->tanggal)->format('d F Y') : '-' }}</td>
                            <td>{{ $act->updated_at ?? '-' }}</td>
                            <td>{{ $act->deskripsi_kegiatan }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada aktivitas hari ini</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
