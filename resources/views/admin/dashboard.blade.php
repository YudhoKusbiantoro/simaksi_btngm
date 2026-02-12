<x-admin-layout>
    <!-- Header / Greeting -->
    <div class="mb-10">
        <h2 class="text-4xl font-black text-green-900 tracking-tight">Selamat Datang!</h2>
        <p class="text-gray-500 font-medium">Monitoring SIMAKSI Balai TNGM • {{ now()->translatedFormat('d F Y') }}</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Total -->
        <div
            class="group bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            <div
                class="absolute -right-4 -bottom-4 w-24 h-24 bg-blue-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500">
            </div>
            <div class="relative z-10">
                <div
                    class="p-3 bg-blue-50 text-blue-600 rounded-2xl w-fit mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Pengajuan</p>
                <h3 class="text-4xl font-black text-gray-800 mt-1">{{ number_format($total) }}</h3>
            </div>
        </div>

        <!-- Menunggu -->
        <div
            class="group bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            <div
                class="absolute -right-4 -bottom-4 w-24 h-24 bg-yellow-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500">
            </div>
            <div class="relative z-10">
                <div
                    class="p-3 bg-yellow-50 text-yellow-600 rounded-2xl w-fit mb-4 group-hover:bg-yellow-500 group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex items-end justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Menunggu</p>
                        <h3 class="text-4xl font-black text-gray-800 mt-1">{{ number_format($pending) }}</h3>
                    </div>
                    @if($pending > 0)
                        <a href="{{ route('admin.pengajuan.index') }}"
                            class="mb-1 p-2 bg-yellow-100 text-yellow-700 rounded-xl hover:bg-yellow-600 hover:text-white transition shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Disetujui -->
        <div
            class="group bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            <div
                class="absolute -right-4 -bottom-4 w-24 h-24 bg-green-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500">
            </div>
            <div class="relative z-10">
                <div
                    class="p-3 bg-green-50 text-green-600 rounded-2xl w-fit mb-4 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Disetujui</p>
                <h3 class="text-4xl font-black text-gray-800 mt-1">{{ number_format($approved) }}</h3>
            </div>
        </div>

        <!-- Dijadwalkan -->
        <div
            class="group bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            <div
                class="absolute -right-4 -bottom-4 w-24 h-24 bg-indigo-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500">
            </div>
            <div class="relative z-10">
                <div
                    class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl w-fit mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Jadwal Presentasi</p>
                <h3 class="text-4xl font-black text-gray-800 mt-1">{{ number_format($scheduled) }}</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8">
        <!-- Main Content Dashboard: Recent Activity -->
        <div class="max-w-5xl">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 h-full flex flex-col">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="font-black text-gray-800 text-xl tracking-tight">Aktivitas Terbaru</h3>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Timeline Pengajuan</p>
                    </div>
                </div>

                <div class="space-y-6 flex-1">
                    @forelse($recentActivity as $activity)
                        @php
                            $initials = collect(explode(' ', $activity->nama_pemohon))->take(2)->map(fn($n) => substr($n, 0, 1))->join('');
                            $statusInfo = match ($activity->status) {
                                'menunggu' => ['bg-yellow-50 text-yellow-600', 'bg-yellow-500', 'Tunggu Verifikasi'],
                                'disetujui' => ['bg-green-50 text-green-600', 'bg-green-600', 'Disetujui'],
                                'dijadwalkan presentasi' => ['bg-indigo-50 text-indigo-600', 'bg-indigo-600', 'Jadwal Presentasi'],
                                'revisi' => ['bg-purple-50 text-purple-600', 'bg-purple-600', 'Perlu Revisi'],
                                default => ['bg-gray-50 text-gray-600', 'bg-gray-600', $activity->status],
                            };
                        @endphp

                        <div
                            class="flex items-center gap-6 group cursor-pointer hover:bg-gray-50 p-3 -m-3 rounded-2xl transition-all duration-300">
                            <!-- Avatar with Initials -->
                            <div
                                class="w-14 h-14 shrink-0 rounded-2xl {{ $statusInfo[0] }} flex items-center justify-center font-black text-lg border-2 border-white shadow-sm transition-transform group-hover:scale-110">
                                {{ $initials }}
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-4">
                                    <p class="text-base font-black text-gray-800 truncate">{{ $activity->nama_pemohon }}</p>
                                    <span
                                        class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $activity->created_at->diffForHumans() }}</span>
                                </div>

                                <div class="flex items-center gap-4 mt-1">
                                    <p class="text-xs text-gray-500 font-medium flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        {{ $activity->jenisKegiatan?->nama ?? 'Umum' }}
                                    </p>
                                    <div class="flex items-center gap-1.5 px-2 py-0.5 rounded-full {{ $statusInfo[0] }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $statusInfo[1] }}"></span>
                                        <span
                                            class="text-[10px] font-black uppercase tracking-widest">{{ $statusInfo[2] }}</span>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('admin.pengajuan.show', $activity->id) }}"
                                class="p-3 text-gray-300 hover:text-green-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-20 text-gray-400">
                            <svg class="w-20 h-20 opacity-10 mb-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z" />
                            </svg>
                            <p class="font-bold italic">Belum ada aktivitas hari ini.</p>
                        </div>
                    @endforelse
                </div>

                <a href="{{ route('admin.pengajuan.index') }}"
                    class="mt-8 flex items-center justify-center gap-2 p-4 bg-gray-50 text-gray-500 text-xs font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-green-700 hover:text-white transition-all duration-300 shadow-sm border border-gray-100">
                    Eksplorasi Semua Data
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</x-admin-layout>