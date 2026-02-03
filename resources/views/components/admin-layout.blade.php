<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - SIMAKSI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 min-h-screen flex">

<!-- SIDEBAR -->
<aside class="w-64 bg-gradient-to-b from-green-900 to-green-800 text-white flex flex-col shadow-xl">

    <!-- LOGO -->
    <div class="px-6 py-5 flex items-center gap-3 border-b border-green-700">
        <img src="{{ asset('images/logo-simaksi.webp') }}" class="h-10">
        <div>
            <p class="font-bold tracking-wide">SIMAKSI</p>
            <p class="text-xs opacity-80">Admin Panel</p>
        </div>
    </div>

    <!-- MENU -->
    <nav class="flex-1 px-3 py-6 space-y-1 text-sm">

        <!-- Menu Aktif -->
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg bg-green-700 border-l-4 border-lime-400 font-semibold">
            Dashboard
        </a>

        <a href="#"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-green-700 transition">
            Data Pengajuan
        </a>

        <a href="#"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-green-700 transition">
            Laporan
        </a>
    </nav>

    <!-- LOGOUT -->
    <form method="POST" action="{{ route('logout') }}" class="px-4 py-4 border-t border-green-700">
        @csrf
        <button
            class="w-full flex justify-center items-center gap-2 bg-red-600 hover:bg-red-700 py-2 rounded-lg text-sm transition">
            Logout
        </button>
    </form>
</aside>



<!-- MAIN -->
<div class="flex-1 flex flex-col">

    <!-- HEADER -->
    <header class="bg-white shadow px-6 py-4 flex justify-between">
        <h1 class="font-semibold text-gray-700">Dashboard Admin</h1>
        <span class="text-sm text-gray-500">
            {{ Auth::user()->email }}
        </span>
    </header>

    <main class="flex-1 p-6">
        {{ $slot }}
    </main>
</div>

</body>
</html>
