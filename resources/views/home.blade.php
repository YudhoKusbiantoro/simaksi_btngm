<x-app-layout>

    <!-- tambahan style untuk smooth scroll + animasi muncul -->
    <style>
        html {
            scroll-behavior: auto;
        }
        section {
            scroll-margin-top: 140px; /* offset navbar */
        }

        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s ease;
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
        section {
        scroll-margin-top: 0;
        }

        
    </style>

    <!-- ================= HERO ================= -->
    <div id="hero"
         class="relative min-h-screen bg-cover bg-center"
         style="background-image: url('{{ asset('images/gunung-merapi.jpeg') }}')">

        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/30 to-black/70"></div>

        <div class="relative z-10 text-white">

            <!-- TOP BAR -->
            <div class="flex justify-between items-center px-6 pt-6 pb-2 text-sm md:text-base font-medium">
                <a href="https://wa.me/6281555777002" target="_blank" class="hover:text-green-300 transition">
                    WhatsApp: <strong>0815-5577-7002</strong>
                </a>

                <div class="flex items-center gap-4">
                    <a href="https://www.tiktok.com/@btng.merapi?_r=1&_t=ZS-93bMOGScMTP" target="_blank">
                        <img src="{{ asset('images/logo-tiktok.png') }}" class="w-5 h-5 brightness-0 invert">
                    </a>
                    <a href="https://www.instagram.com/btn_gn_merapi" target="_blank">
                        <img src="{{ asset('images/logo-instagram.png') }}" class="w-5 h-5 brightness-0 invert">
                    </a>

                    @auth
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                                class="flex items-center gap-1 text-sm md:text-base focus:outline-none">
                            {{ Auth::user()->email }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition
                             class="absolute right-0 mt-2 w-48 bg-white text-gray-700 rounded-xl shadow-xl overflow-hidden z-50">
                            <a href="{{ route('dashboard') }}"
                               class="block px-4 py-2 hover:bg-gray-100 text-sm">
                                Riwayat Pengajuan
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left px-4 py-2 hover:bg-gray-100 text-sm">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                        <a href="{{ route('login') }}" class="underline">Login</a>
                    @endauth
                </div>
            </div>

            <div class="border-t border-white/40 mx-6"></div>

            <!-- NAVBAR -->
            <div id="navbar" x-data="{ mobileMenuOpen: false }"
                 class="flex justify-between items-center px-6 py-2 md:py-3 transition-all duration-300 relative">

                <div class="flex items-center gap-3 text-2xl md:text-3xl font-bold tracking-wider">
                    <img src="{{ asset('images/logo-simaksi.webp') }}" class="h-10">
                    <span>TNGM</span>
                </div>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex gap-6 md:gap-10 font-bold text-sm md:text-base">
                    @foreach([
                        ['Beranda', '#hero'],
                        ['Peraturan', '#peraturan'],
                        ['Panduan', '#panduan'],
                        ['Harga', route('harga')],
                        ['Kontak', '#kontak']
                    ] as $menu)
                    <a href="{{ $menu[1] }}"
                       class="relative pb-1 after:absolute after:left-0 after:-bottom-1
                              after:w-0 after:h-[2px] after:bg-white
                              hover:after:w-full after:transition-all after:duration-300">
                        {{ $menu[0] }}
                    </a>
                    @endforeach
                </nav>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- Mobile Nav Dropdown -->
                <div x-show="mobileMenuOpen"
                     @click.away="mobileMenuOpen = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     class="absolute top-full left-0 w-full bg-white text-gray-800 shadow-lg md:hidden flex flex-col z-50">
                    
                    @foreach([
                        ['Beranda', '#hero'],
                        ['Peraturan', '#peraturan'],
                        ['Panduan', '#panduan'],
                        ['Harga', route('harga')],
                        ['Kontak', '#kontak']
                    ] as $menu)
                    <a href="{{ $menu[1] }}"
                       class="block px-6 py-3 border-b hover:bg-gray-100 font-bold"
                       @click="mobileMenuOpen = false">
                        {{ $menu[0] }}
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- HERO CONTENT -->
            <div class="flex flex-col justify-center items-center text-center min-h-[75vh] px-4">
                <h1 class="text-3xl md:text-5xl font-extrabold mb-4 tracking-wide drop-shadow-lg">
                    Taman Nasional Gunung Merapi
                </h1>
                <p class="max-w-2xl mb-8 text-sm md:text-base text-gray-200 leading-relaxed">
                    Sistem Layanan Izin Kegiatan di Kawasan Konservasi<br>
                    Taman Nasional Gunung Merapi
                </p>

                <a href="{{ route('ajukan') }}"
                   class="bg-gradient-to-r from-green-600 to-green-800 hover:from-green-700 hover:to-green-900
                          px-10 py-3 rounded-full font-semibold shadow-xl
                          transition duration-300 hover:scale-105">
                    Ajukan SIMAKSI
                </a>
            </div>
        </div>
    </div>

    <!-- ================= PERATURAN ================= -->
    <section id="peraturan" class="bg-gradient-to-b from-gray-50 to-gray-200 text-gray-800 py-20">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-green-800">Peraturan & Tata Tertib TNGM</h2>
                <p class="text-sm text-gray-600 mt-2">Kegiatan berikut wajib memiliki izin SIMAKSI</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">

                <!-- CARD JENIS KEGIATAN -->
                <div class="reveal group bg-white rounded-2xl shadow-xl p-6 border
                            transition duration-300 transform cursor-pointer
                            hover:-translate-y-2 hover:bg-green-700 hover:text-white">
                    <h3 class="font-bold text-lg mb-4 border-b pb-2 text-green-800
                               group-hover:text-white group-hover:border-white/30">
                        Jenis Kegiatan Wajib SIMAKSI
                    </h3>

                    <ul class="space-y-3 text-sm">
                        @foreach([
                        'Berkemah','Diklat','Jelajah Alam','Kampanye & Pameran',
                        'Mendaki Gunung','Outbond','Rehabilitasi',
                        'Penelitian','Pengambilan Data','Foto & Handycam',
                        'Film Komersial','Praktik Lapangan','Survei'
                        ] as $kegiatan)
                        <li class="flex items-start gap-3">
                            <span class="mt-1 w-2.5 h-2.5 rounded-full bg-green-700 group-hover:bg-white"></span>
                            <span class="text-gray-700 group-hover:text-white">{{ $kegiatan }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- KANAN -->
                <div class="md:col-span-2 grid md:grid-cols-2 gap-8">

                    <!-- Ketentuan -->
                    <div class="reveal group bg-white rounded-2xl shadow-xl p-8 border
                                transition duration-300 transform cursor-pointer
                                hover:-translate-y-2 hover:bg-green-700 hover:text-white">
                        <h3 class="font-bold text-lg mb-4 border-b pb-2 text-green-800
                                   group-hover:text-white group-hover:border-white/30">
                            Ketentuan Kegiatan
                        </h3>

                        <div class="space-y-6 text-sm leading-relaxed text-gray-700 group-hover:text-white">
                            <div>
                                <h4 class="font-semibold mb-2">Berkemah</h4>
                                <ol class="list-decimal ml-5 space-y-1">
                                    <li>Tiga orang atau lebih</li>
                                    <li>Izin kepada Kadus, Kades, Polsek, Camat, dan Danramil</li>
                                    <li>Menginformasikan ke petugas lapangan</li>
                                </ol>
                            </div>

                            <div>
                                <h4 class="font-semibold mb-2">Mendaki</h4>
                                <ol class="list-decimal ml-5 space-y-1">
                                    <li>Tiga orang atau lebih</li>
                                    <li>Surat dokter, izin orang tua (&lt;17), dan Identitas</li>
                                    <li>Menginformasikan ke petugas lapangan</li>
                                    <li>Peralatan dan perlengkapan yang memadai</li>
                                    <li>Berjalan di jalur yang ditentukan</li>
                                    <li>Tidak membawa hewan peliharaan</li>
                                </ol>
                            </div>

                            <div>
                                <h4 class="font-semibold mb-2">Penelitian</h4>
                                <ol class="list-decimal ml-5 space-y-1">
                                    <li>Presentasi proposal sebelum penelitian</li>
                                    <li>Menyerahkan hasil penelitian</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <!-- Aturan Umum -->
                    <div class="reveal group bg-white rounded-2xl shadow-xl p-8 border
                                transition duration-300 transform cursor-pointer
                                hover:-translate-y-2 hover:bg-green-700 hover:text-white">
                        <h3 class="font-bold text-lg mb-4 border-b pb-2 text-green-800
                                   group-hover:text-white group-hover:border-white/30">
                            Aturan Umum Kawasan
                        </h3>

                        <ol class="list-decimal ml-5 space-y-2 text-sm leading-relaxed text-gray-700 group-hover:text-white">
                            <li>
                                Dilarang melakukan aksi yang merusak.<br>
                                <em class="group-hover:text-green-100">
                                    Take nothing but picture, leave nothing but foot prints, kill nothing but time
                                </em>
                            </li>
                            <li>Dilarang membuat api unggun</li>
                            <li>Penggunaan senjata tajam harus seizin petugas TNGM</li>
                            <li>Bawa serta sampahmu ke luar kawasan</li>
                            <li>Patuhi papan petunjuk dan informasi dari TNGM</li>
                            <li>Bawalah perlengkapan P3K</li>
                        </ol>

                        <div class="mt-6 text-xs text-gray-600 group-hover:text-green-100">
                            Informasi lanjutan:<br>
                            Telp./Faks. Balai TNGM: <strong>(0274) 4478664, 4478665</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= PANDUAN ================= -->
    <section id="panduan" class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-green-800 mb-2">
                    Panduan Pengajuan SIMAKSI Online
                </h2>
                <p class="text-sm text-gray-600">
                    Ikuti tahapan berikut untuk memperoleh SIMAKSI secara resmi dan sah.
                </p>
            </div>

            <div class="grid md:grid-cols-5 gap-6 text-sm">

                @foreach([
                ['1','Pengajuan Online','Pemohon mengisi formulir permohonan melalui website SIMAKSI dengan lengkap dan benar, memilih jenis kegiatan, lokasi, serta tanggal pelaksanaan, kemudian mengunggah seluruh dokumen persyaratan yang diminta.'],
                ['2','Verifikasi','Petugas Balai TNGM memeriksa dan memvalidasi berkas yang diajukan. Jika terdapat kekurangan atau ketidaksesuaian, pemohon diminta melakukan perbaikan dan mengunggah ulang dokumen.'],
                ['3','Penjadwalan Presentasi','Jika administrasi sudah lengkap, petugas akan menjadwalkan presentasi secara daring (Zoom) atau luring. Jika terdapat kendala jadwal, harap segera konfirmasi melalui WhatsApp Admin TNGM.'],
                ['4','Persetujuan','Setelah presentasi selesai dan disetujui, surat izin SIMAKSI akan diproses untuk penandatanganan oleh pejabat berwenang.'],
                ['5','Ambil SIMAKSI','Pemohon datang langsung ke Kantor Balai TNGM untuk mengambil surat izin asli dengan membawa materai Rp10.000 3 lembar dan menunjukkan identitas diri sesuai data pengajuan.']
                ] as $step)

                <div class="reveal group bg-green-50 rounded-2xl shadow-md p-6 text-center
                            transition duration-300 transform cursor-pointer
                            hover:-translate-y-2 hover:bg-green-700 hover:text-white">

                    <div class="w-12 h-12 mx-auto mb-4 rounded-full
                                bg-green-700 text-white font-bold text-lg
                                flex items-center justify-center shadow-md
                                group-hover:bg-white group-hover:text-green-700">
                        {{ $step[0] }}
                    </div>

                    <h4 class="font-semibold mb-2 text-green-800 group-hover:text-white">
                        {{ $step[1] }}
                    </h4>

                    <p class="text-gray-600 leading-relaxed group-hover:text-green-100">
                        {{ $step[2] }}
                    </p>
                </div>

                @endforeach
            </div>

            <div class="mt-12 text-center text-xs text-gray-500">
                SIMAKSI hanya berlaku sesuai tanggal, lokasi, dan jenis kegiatan pada surat izin.
            </div>
        </div>
    </section>

    <!-- SCRIPT NAVBAR SCROLL EFFECT -->
    <script>
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', function () {
            if (window.scrollY > 80) {
                navbar.classList.add(
                    'fixed','top-0','left-0','right-0','z-50',
                    'bg-white/80','backdrop-blur-md','shadow-lg','text-gray-800'
                );
                navbar.classList.remove('text-white');
            } else {
                navbar.classList.remove(
                    'fixed','top-0','left-0','right-0','z-50',
                    'bg-white/80','backdrop-blur-md','shadow-lg','text-gray-800'
                );
                navbar.classList.add('text-white');
            }
        });

        /* animasi muncul saat scroll */
        function revealOnScroll() {
            const reveals = document.querySelectorAll('.reveal');
            for (let i = 0; i < reveals.length; i++) {
                const windowHeight = window.innerHeight;
                const elementTop = reveals[i].getBoundingClientRect().top;
                const revealPoint = 120;

                if (elementTop < windowHeight - revealPoint) {
                    reveals[i].classList.add('active');
                }
            }
        }

        window.addEventListener('scroll', revealOnScroll);
        window.addEventListener('load', revealOnScroll);
    </script>
<script>
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId.length > 1) {
                e.preventDefault();

                // kalau klik Beranda / #hero -> scroll paling atas
                if (targetId === '#hero') {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    return;
                }

                const target = document.querySelector(targetId);
                const elementPosition = target.getBoundingClientRect().top + window.pageYOffset;

                // offset untuk section biasa supaya tidak ketutup navbar
                const offsetPosition = elementPosition - 64;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
</script>
</x-app-layout>
