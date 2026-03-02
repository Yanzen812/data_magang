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
        <h2 class="text-2xl font-bold mb-8">Nusa Indo</h2>
        <nav class="space-y-2">
            <a href="{{ route('absensi_siswa') }}" class="block p-3 hover:bg-white/10 rounded">Absensi</a>
            <a href="{{ route('kegiatan_siswa') }}" class="block p-3 hover:bg-white/10 rounded">Kegiatan</a>
            <a href="{{ route('laporan_magang') }}" class="block p-3 hover:bg-white/10 rounded">Laporan</a>
            <a href="{{ route('surat_pengantar') }}" class="block p-3 hover:bg-white/10 rounded">Surat Pengantar</a>
            <a href="{{ route('profile') }}" class="block p-3 hover:bg-white/10 rounded">Profile</a>
        </nav>
        <nav class="space-y-2">
            <a href="{{ route('login') }}" class="block p-3 hover:bg-white/10 rounded">Logout</a>
        </nav>
    </aside>

    <main class="flex-1 ml-64 p-8">
        @yield('content')
    </main>

</body>
</html>