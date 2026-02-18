<footer id="kontak" class="bg-gradient-to-b from-green-800 to-green-900 text-white mt-20">
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
            <h4 class="font-semibold mb-3">Kontak & Media Sosial</h4>
            <ul class="text-sm space-y-2 text-green-100">
                <li class="flex items-center gap-2">
                    <span>📍</span> Sleman, DI Yogyakarta
                </li>
                <li class="flex items-center gap-2">
                    <span>☎️</span> (0274) 4478664/4478665
                </li>
                <li class="flex items-center gap-2">
                    <span>✉️</span> tngm@ksdae.menlhk.go.id
                </li>
                <li class="flex items-center gap-2">
                    <a href="https://www.instagram.com/btn_gn_merapi" target="_blank"
                        class="flex items-center gap-2 hover:text-white hover:underline transition">
                        <img src="{{ asset('images/logo-instagram.png') }}" class="w-4 h-4 brightness-0 invert">
                        <span>btn_gn_merapi</span>
                    </a>
                </li>
                <li class="flex items-center gap-2">
                    <a href="https://www.tiktok.com/@btng.merapi?_r=1&_t=ZS-93bMOGScMTP" target="_blank"
                        class="flex items-center gap-2 hover:text-white hover:underline transition">
                        <img src="{{ asset('images/logo-tiktok.png') }}" class="w-4 h-4 brightness-0 invert">
                        <span>btgm.merapi</span>
                    </a>
                </li>
                <li class="flex items-center gap-2">
                    <a href="https://wa.me/6281555777002" target="_blank"
                        class="flex items-center gap-2 hover:text-white hover:underline transition">
                        <img src="{{ asset('images/logo-whatsapp.png') }}" class="w-4 h-4 brightness-0 invert">
                        <span>0815-5577-7002</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Navigasi -->
        <div>
            <h4 class="font-semibold mb-3">Layanan</h4>
            <ul class="text-sm space-y-2 text-green-100">
                <li>
                    <a href="{{ route('home') }}" class="hover:text-white hover:underline transition">
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ route('ajukan') }}" class="hover:text-white hover:underline transition">
                        Ajukan SIMAKSI
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" class="hover:text-white hover:underline transition">
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