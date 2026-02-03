<x-admin-layout>
    <!-- Header -->
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-green-900">Dashboard Admin</h2>
        <p class="text-gray-500">Monitoring dan verifikasi permohonan SIMAKSI Balai TNGM</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total -->
        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition">
            <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Total Pengajuan</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $total }}</h3>
            </div>
        </div>

        <!-- Menunggu -->
        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition">
            <div class="p-3 bg-yellow-50 rounded-xl text-yellow-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Menunggu</p>
                <div class="flex items-center gap-2">
                    <h3 class="text-3xl font-bold text-gray-800">{{ $pending }}</h3>
                    <a href="{{ route('admin.pengajuan.index') }}"
                        class="text-[10px] text-yellow-600 hover:underline flex items-center">
                        Lihat &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- Disetujui -->
        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition">
            <div class="p-3 bg-green-50 rounded-xl text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Disetujui</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $approved }}</h3>
            </div>
        </div>

        <!-- Ditolak -->
        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition">
            <div class="p-3 bg-red-50 rounded-xl text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Ditolak</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $rejected }}</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Visual (Mock/Placeholder for Chart) -->
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-gray-700 mb-6">Distribusi Pengajuan</h3>
            <div
                class="h-64 flex items-center justify-center bg-gray-50 rounded-xl border border-dashed border-gray-300 relative overflow-hidden">
                <!-- Simple CSS representation of a pie chart -->
                <div
                    class="w-48 h-48 rounded-full border-[1.5rem] border-green-700 relative flex items-center justify-center">
                    <div
                        class="absolute w-full h-full rounded-full border-[1.5rem] border-green-500 rotate-[45deg] clip-slice">
                    </div>
                    <div
                        class="absolute w-full h-full rounded-full border-[1.5rem] border-green-200 rotate-[180deg] clip-slice">
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-green-800">100%</p>
                        <p class="text-[10px] text-gray-500 uppercase">Aktif</p>
                    </div>
                </div>

                <div class="absolute bottom-4 left-6 flex gap-4 text-xs font-medium text-gray-600">
                    <div class="flex items-center gap-1">
                        <div class="w-2 h-2 bg-green-700 rounded-full"></div> Penelitian
                    </div>
                    <div class="flex items-center gap-1">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div> Pendidikan
                    </div>
                    <div class="flex items-center gap-1">
                        <div class="w-2 h-2 bg-green-200 rounded-full"></div> Komersial
                    </div>
                </div>
            </div>
            <style>
                .clip-slice {
                    clip-path: polygon(50% 50%, 100% 0, 100% 100%);
                }
            </style>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col">
            <h3 class="font-bold text-gray-700 mb-6 uppercase tracking-wider text-xs">Aktivitas Terbaru</h3>
            <div class="space-y-6 flex-1">
                @forelse($recentActivity as $activity)
                    <div class="flex items-start gap-4 pb-4 border-b border-gray-50 last:border-0 last:pb-0">
                        <div class="p-2 rounded-lg 
                                @if($activity->status == 'menunggu') bg-yellow-100 text-yellow-600
                                @elseif($activity->status == 'disetujui') bg-green-100 text-green-600
                                @elseif($activity->status == 'ditolak') bg-red-100 text-red-600
                                @else bg-blue-100 text-blue-600 @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-gray-800 truncate">{{ $activity->nama_pemohon }}</p>
                            <p class="text-[11px] text-gray-500 truncate">{{ $activity->jenisKegiatan?->nama ?? 'Pengajuan' }}</p>
                            <div class="flex items-center justify-between mt-1">
                                <span
                                    class="text-[9px] text-gray-400 font-medium">{{ $activity->created_at->diffForHumans() }}</span>
                                <span class="px-2 py-0.5 rounded text-[8px] font-bold uppercase tracking-tighter
                                        @if($activity->status == 'menunggu') bg-yellow-100 text-yellow-700
                                        @elseif($activity->status == 'disetujui') bg-green-100 text-green-700
                                        @elseif($activity->status == 'ditolak') bg-red-100 text-red-700
                                        @else bg-blue-100 text-blue-700 @endif">
                                    {{ $activity->status }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 italic text-center py-10">Belum ada aktivitas.</p>
                @endforelse
            </div>

            <a href="{{ route('admin.pengajuan.index') }}"
                class="mt-6 w-full text-center py-2 bg-gray-50 text-gray-600 text-xs font-bold rounded-xl hover:bg-gray-100 transition">
                LIHAT SEMUA DATA
            </a>
        </div>
    </div>
</x-admin-layout>