@extends('layouts.admin')

@section('title', 'Data Absensi')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Data Absensi</h1>
    
    <div class="mb-6 flex gap-4">
        <input type="date" class="border p-2 rounded" placeholder="Tanggal">
        <button class="bg-[#5d29d6] text-white px-4 py-2 rounded hover:bg-purple-700">
            Cari
        </button>
    </div>
    
    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border p-2 text-left">Nama Siswa</th>
                <th class="border p-2 text-left">Tanggal</th>
                <th class="border p-2 text-left">Status</th>
                <th class="border p-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border p-2">-</td>
                <td class="border p-2">-</td>
                <td class="border p-2">-</td>
                <td class="border p-2">
                    <button class="text-blue-500 hover:underline">Edit</button> |
                    <button class="text-red-500 hover:underline">Hapus</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
