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

            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-green-700 border-l-4 border-lime-400 font-semibold' : 'hover:bg-green-700' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>

            <!-- Data Pengajuan -->
            <a href="{{ route('admin.pengajuan.index') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg transition {{ request()->routeIs('admin.pengajuan.index') ? 'bg-green-700 border-l-4 border-lime-400 font-semibold' : 'hover:bg-green-700' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Data Pengajuan
            </a>

            <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-green-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
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

        <main class="flex-1 p-6 relative">
            @if(session('success'))
                <div id="success-alert"
                    class="fixed top-8 right-8 z-[100] flex items-center gap-3 bg-[#f0fdf4] border border-[#dcfce7] px-5 py-2 rounded-full shadow-sm transition-all duration-700">
                    <div class="text-[#22c55e]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="font-medium text-[#166534] text-xs tracking-tight">{{ session('success') }}</span>
                </div>
                <script>
                    setTimeout(() => {
                        const alert = document.getElementById('success-alert');
                        if (alert) {
                            alert.style.opacity = '0';
                            alert.style.transform = 'translateY(-10px)';
                            setTimeout(() => alert.remove(), 700);
                        }
                    }, 3000);
                </script>
            @endif

            {{ $slot }}
        </main>
    </div>

</body>

</html>