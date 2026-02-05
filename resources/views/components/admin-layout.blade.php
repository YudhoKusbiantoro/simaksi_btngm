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
                <p class="font-bold tracking-wide text-sm">SIMAKSI</p>
                <p class="text-[10px] opacity-80">Admin Panel</p>
                <p class="text-[10px] opacity-60 mt-0.5 truncate max-w-[120px]" title="{{ Auth::user()->email }}">
                    {{ Auth::user()->email }}
                </p>
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

            <a href="{{ route('admin.laporan.index') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg transition {{ request()->routeIs('admin.laporan.index') ? 'bg-green-700 border-l-4 border-lime-400 font-semibold' : 'hover:bg-green-700' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Laporan
            </a>
            <a href="{{ route('admin.settings.index') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg transition {{ request()->routeIs('admin.settings.index') ? 'bg-green-700 border-l-4 border-lime-400 font-semibold' : 'hover:bg-green-700' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Pengaturan
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" class="mt-4 pt-4 border-t border-green-700/50">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-red-300 hover:text-white hover:bg-red-600/20 transition group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:scale-110 transition-transform"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </nav>

    </aside>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col">


        <main class="flex-1 p-6 relative">
            @if(session('success'))
                <div id="success-alert"
                    class="fixed top-6 right-6 z-[9999] flex items-center gap-3 bg-green-50 border border-green-200 px-6 py-3 rounded-xl shadow-md transition-all duration-500">

                    <!-- ICON -->
                    <div class="bg-green-100 text-green-600 rounded-full p-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>

                    <!-- TEXT -->
                    <span class="font-semibold text-green-800 text-sm">
                        {{ session('success') }}
                    </span>
                </div>

                <script>
                    setTimeout(() => {
                        const alert = document.getElementById('success-alert');
                        if (alert) {
                            alert.style.opacity = '0';
                            alert.style.transform = 'translateY(-20px)';
                            setTimeout(() => alert.remove(), 500);
                        }
                    }, 3000);
                </script>
            @endif

            {{ $slot }}
        </main>
    </div>

</body>

</html>