<x-admin-layout>
    <div class="fixed inset-0 z-50 flex flex-col bg-gray-900 overflow-hidden">
        <!-- Notification Text -->
        <div class="bg-white py-1 text-center">
            <p class="text-[9px] font-medium text-gray-500 tracking-widest uppercase">
                HALAMAN INI SUDAH DIATUR OTOMATIS UNTUK UKURAN KERTAS A4.
            </p>
        </div>

        <!-- Header / Control Bar -->
        <div
            class="min-h-16 h-auto py-2 flex flex-col md:flex-row items-center justify-between px-4 bg-white border-b border-gray-200 gap-3">
            <div class="flex items-center gap-2 w-full md:w-auto justify-between md:justify-start">
                <div class="flex items-center gap-2">
                    <h2 class="text-sm md:text-lg font-bold text-gray-800 flex items-center gap-2">
                        Preview
                    </h2>
                    <span
                        class="text-[10px] md:text-xs py-0.5 px-2 bg-gray-700 text-gray-300 rounded border border-gray-600 truncate max-w-[150px]">
                        {{ $approval->nomor_surat }}
                    </span>
                </div>
            </div>

            <div class="flex items-center gap-2 w-full md:w-auto justify-end">
                <p class="text-[10px] text-gray-400 mr-2 italic hidden lg:block">Hal ini diatur otomatis untuk ukuran
                    kertas A4.</p>

                <a href="/storage/{{ $approval->file_pdf }}" target="_blank"
                    class="bg-[#00a65a] hover:bg-[#008d4c] text-white px-3 md:px-6 py-2 rounded font-bold text-xs md:text-sm tracking-wide transition-all shadow-sm whitespace-nowrap">
                    Cetak Laporan
                </a>

                <a href="{{ route('admin.pengajuan.show', $pengajuan->id) }}"
                    class="bg-[#605ca8] hover:bg-[#535093] text-white px-3 md:px-6 py-2 rounded font-bold text-xs md:text-sm tracking-wide transition-all shadow-sm whitespace-nowrap">
                    Kembali
                </a>
            </div>
        </div>

        <!-- PDF Container -->
        <div class="flex-grow bg-gray-900 p-4 sm:p-8 overflow-auto flex justify-center">
            <div class="w-full max-w-5xl h-full bg-white shadow-2xl rounded-sm overflow-hidden border border-gray-800">
                <iframe src="/storage/{{ $approval->file_pdf }}#view=FitH" class="w-full h-full border-none"
                    style="height: calc(100vh - 120px)">
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