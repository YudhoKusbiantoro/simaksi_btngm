<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIMAKSI') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <!-- WRAPPER FLEX COLUMN -->
    <div class="min-h-screen flex flex-col">

        {{-- HEADER (kalau ada, taruh di sini) --}}
        {{-- @include('layouts.header') --}}

        <!-- MAIN CONTENT -->
        <main class="flex-grow relative">
            @if(session('success'))
                <div id="success-alert"
                    class="fixed top-10 right-10 z-[9999] flex items-center gap-3 bg-[#f0fdf4] border border-[#dcfce7] px-5 py-2 rounded-full shadow-sm transition-all duration-700 lg:mr-4">
                    <div class="text-[#22c55e]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span
                        class="font-medium text-[#166534] text-xs tracking-tight whitespace-nowrap">{{ session('success') }}</span>
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

        <!-- FOOTER (SELALU DI BAWAH) -->
        @include('layouts.footer')

    </div>

</body>

</html>