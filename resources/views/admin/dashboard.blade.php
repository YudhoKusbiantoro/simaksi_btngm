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

        <!-- Dijadwalkan Presentasi -->
        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition">
            <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider text-[10px]">Dijadwalkan Presentasi
                </p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $scheduled }}</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">


        <!-- Recent Activity -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col">
            <h3 class="font-bold text-gray-700 mb-6 uppercase tracking-wider text-xs">Aktivitas Terbaru</h3>
            <div class="space-y-6 flex-1">
                @forelse($recentActivity as $activity)

                    @php
                        $iconColor = match ($activity->status) {
                            'menunggu' => 'bg-yellow-100 text-yellow-600',
                            'disetujui' => 'bg-green-100 text-green-600',
                            'dijadwalkan presentasi' => 'bg-blue-100 text-blue-600',
                            'revisi' => 'bg-purple-100 text-purple-600',
                            default => 'bg-gray-100 text-gray-600',
                        };

                        $badgeColor = match ($activity->status) {
                            'menunggu' => 'bg-yellow-100 text-yellow-700',
                            'disetujui' => 'bg-green-100 text-green-700',
                            'dijadwalkan presentasi' => 'bg-blue-100 text-blue-700',
                            'revisi' => 'bg-purple-100 text-purple-700',
                            default => 'bg-gray-100 text-gray-700',
                        };
                    @endphp

                    <div class="flex items-start gap-4 pb-4 border-b border-gray-50 last:border-0 last:pb-0">

                        <div class="p-2 rounded-lg {{ $iconColor }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>

                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-gray-800 truncate">
                                {{ $activity->nama_pemohon }}
                            </p>

                            <p class="text-[11px] text-gray-500 truncate">
                                {{ $activity->jenisKegiatan?->nama ?? 'Pengajuan' }}
                            </p>

                            <div class="flex items-center justify-between mt-1">
                                <span class="text-[9px] text-gray-400 font-medium">
                                    {{ $activity->created_at->diffForHumans() }}
                                </span>

                                <span
                                    class="px-2 py-0.5 rounded text-[8px] font-bold uppercase tracking-tighter {{ $badgeColor }}">
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