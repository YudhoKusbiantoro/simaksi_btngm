<x-admin-layout>
    <div class="fixed inset-0 z-50 flex flex-col bg-gray-900 overflow-hidden">
        <!-- Notification Text -->
        <div class="bg-white py-1 text-center">
            <p class="text-[9px] font-medium text-gray-500 tracking-widest uppercase">
                HALAMAN INI SUDAH DIATUR OTOMATIS UNTUK UKURAN KERTAS A4.
            </p>
        </div>

        <!-- Header / Control Bar -->
        <div class="h-16 flex items-center justify-between px-8 bg-white border-b border-gray-200">
            <div class="flex items-center gap-4">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    Preview SIMAKSI
                </h2>
                <span class="text-xs py-0.5 px-2 bg-gray-700 text-gray-300 rounded border border-gray-600">
                    {{ $approval->nomor_surat }}
                </span>
            </div>

            <div class="flex items-center gap-3">
                <p class="text-[10px] text-gray-400 mr-4 italic hidden sm:block">Hal ini diatur otomatis untuk ukuran
                    kertas A4.</p>

                <a href="{{ route('admin.pengajuan.download-pdf', $pengajuan->id) }}"
                   class="bg-[#00a65a] hover:bg-[#008d4c] text-white px-6 py-2 rounded font-bold text-sm tracking-wide transition-all shadow-sm">
                    Cetak Laporan
                </a>

                <a href="{{ route('admin.pengajuan.show', $pengajuan->id) }}"
                   class="bg-[#605ca8] hover:bg-[#535093] text-white px-6 py-2 rounded font-bold text-sm tracking-wide transition-all shadow-sm">
                    Kembali
                </a>
            </div>
        </div>

        <!-- PDF Container -->
        <div class="flex-grow bg-gray-900 p-4 sm:p-8 overflow-auto flex justify-center">
            <div class="w-full max-w-5xl h-full bg-white shadow-2xl rounded-sm overflow-hidden border border-gray-800">
                <iframe src="/storage/{{ $approval->file_pdf }}#toolbar=0&navpanes=0&scrollbar=1"
                    class="w-full h-full border-none" style="height: calc(100vh - 120px)">
                </iframe>
            </div>
        </div>
    </div>

    <!-- Override x-admin-layout style to remove its padding/margins on this specific page -->
    <style>
        main {
            padding: 0 !important;
            margin: 0 !important;
        }

        aside {
            display: none !important;
        }

        nav {
            display: none !important;
        }
    </style>
</x-admin-layout>