<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nusa Indo - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex">

    <aside class="w-64 bg-[#5d29d6] min-h-screen text-white p-4 fixed">
        <h2 class="text-2xl font-bold mb-6">Nusa Indo</h2>
        <nav class="space-y-1">
            <a href="{{ route('dashboard') }}" class="block py-2 px-3 hover:bg-white/10 rounded border-b border-white/10">Dashboard</a>
            <a href="{{ route('siswa') }}" class="block py-2 px-3 hover:bg-white/10 rounded border-b border-white/10">Data Siswa</a>
            <a href="{{ route('absensi') }}" class="block py-2 px-3 hover:bg-white/10 rounded border-b border-white/10">Data Absensi</a>
            <a href="{{ route('kegiatan') }}" class="block py-2 px-3 hover:bg-white/10 rounded border-b border-white/10">Data Kegiatan</a>
            <a href="{{ route('guru') }}" class="block py-2 px-3 hover:bg-white/10 rounded border-b border-white/10">Data Guru Pembimbing</a>
            <a href="{{ route('surat') }}" class="block py-2 px-3 hover:bg-white/10 rounded border-b border-white/10">Surat Pengantar</a>
            <a href="{{ route('penilaian') }}" class="block py-2 px-3 hover:bg-white/10 rounded">Penilaian</a>
        </nav>
        <div class="absolute bottom-8 left-0 w-full px-4">
            <hr class="border-white/20 mb-2">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="block py-2 px-3 hover:bg-white/10 rounded w-full text-left">Logout</button>
            </form>
        </div>
    </aside>

    <main class="flex-1 ml-64 p-8">
        @if (session('success'))
            <div class="alert alert-success mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger mb-4" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
