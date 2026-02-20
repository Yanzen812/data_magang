<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nusa Indo - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">

    <aside class="w-64 bg-[#5d29d6] min-h-screen text-white p-4 fixed">
        <h2 class="text-2xl font-bold mb-8">Nusa Indo</h2>
        <nav class="space-y-2">
            <a href="{{ route('dashboard') }}" class="block p-3 hover:bg-white/10 rounded">Dashboard</a> <hr class="border-white/20 mb-4">
            <a href="{{ route('siswa') }}" class="block p-3 hover:bg-white/10 rounded">Data Siswa</a> <hr class="border-white/20 mb-4">
            <a href="{{ route('absensi') }}" class="block p-3 hover:bg-white/10 rounded">Data Absensi</a> <hr class="border-white/20 mb-4">
            <a href="{{ route('kegiatan') }}" class="block p-3 hover:bg-white/10 rounded">Data Kegiatan</a> <hr class="border-white/20 mb-4">
            <a href="{{ route('guru') }}" class="block p-3 hover:bg-white/10 rounded">Data Guru Pembimbing</a> <hr class="border-white/20 mb-4">
            <a href="{{ route('surat') }}" class="block p-3 hover:bg-white/10 rounded">Surat Pengantar</a><hr class="border-white/20 mb-4">
            <a href="{{ route('penilaian') }}" class="block p-3 hover:bg-white/10 rounded">Penilaian</a>
        </nav>
        {{-- <div class="absolute bottom-8 left-0 w-full px-4"> --}}
        <hr class="border-white/20 mb-4"> <a href="{{ route('absensi') }}" class="block p-3 hover:bg-white/10 rounded">Logout
        </a>
    {{-- </div> --}}
    </aside>

    <main class="flex-1 ml-64 p-8">
        @yield('content')
    </main>

</body>
</html>