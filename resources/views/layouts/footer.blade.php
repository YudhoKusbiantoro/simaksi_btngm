<footer class="bg-gradient-to-b from-green-800 to-green-900 text-white mt-20">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- Logo & Nama -->
        <div>
            <div class="flex items-center mb-3">
                <img src="{{ asset('images/logo-simaksi.webp') }}" class="w-12 mr-3">
                <h3 class="font-bold text-lg">Taman Nasional Gunung Merapi</h3>
            </div>
            <p class="text-sm text-green-100 leading-relaxed">
                Sistem Informasi Manajemen<br>
                Akses Kawasan Konservasi (SIMAKSI)
            </p>
        </div>

        <!-- Kontak -->
        <div>
            <h4 class="font-semibold mb-3">Kontak</h4>
            <ul class="text-sm space-y-2 text-green-100">
                <li>📍 Sleman, DI Yogyakarta</li>
                <li>☎️ (0341) 491828</li>
                <li>✉️ tngm@ksdae.menlhk.go.id</li>
            </ul>
        </div>

        <!-- Navigasi -->
        <div>
            <h4 class="font-semibold mb-3">Layanan</h4>
            <ul class="text-sm space-y-2 text-green-100">
                <li>
                    <a href="{{ route('home') }}"
                       class="hover:text-white hover:underline transition">
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ route('ajukan') }}"
                       class="hover:text-white hover:underline transition">
                        Ajukan SIMAKSI
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="hover:text-white hover:underline transition">
                        Riwayat Pengajuan
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="border-t border-green-700 text-center py-4 text-sm text-green-200">
        © {{ date('Y') }} Balai Taman Nasional Gunung Merapi. All rights reserved.
    </div>
</footer>
