<x-admin-layout>
    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-green-800">
            Data Pengajuan SIMAKSI
        </h2>
        <p class="text-sm text-gray-500">
            Daftar seluruh permohonan izin kegiatan kawasan konservasi
        </p>
    </div>

    <!-- Search Box -->
    <div class="mb-6">
        <form action="{{ route('admin.pengajuan.index') }}" method="GET" class="flex flex-wrap gap-2">
            <div class="relative flex-1 min-w-[300px]">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pemohon..."
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500 sm:text-sm transition duration-150 ease-in-out">
            </div>
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-green-700 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-800 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.pengajuan.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 transition ease-in-out duration-150">
                    Sembunyikan Pencarian
                </a>
            @endif
        </form>
    </div>

    @if($pengajuans->isEmpty())
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow border-l-4 border-green-600 p-6">
            <p class="text-gray-600">
                Belum ada pengajuan SIMAKSI.
            </p>
        </div>
    @else
        <!-- Card Tabel -->
        <div class="bg-white rounded-xl shadow overflow-hidden border border-gray-200">

            <!-- Top bar card -->
            <div class="bg-green-700 px-6 py-3 shrink-0">
                <h3 class="text-white font-semibold text-sm">
                    Seluruh Data Masuk
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-green-50 text-green-900 border-b border-green-100">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">Pemohon (Email)</th>
                            <th class="px-4 py-3 text-left font-semibold">Nama Pemohon</th>
                            <th class="px-4 py-3 text-left font-semibold">Jenis Kegiatan</th>
                            <th class="px-4 py-3 text-left font-semibold">Waktu Kegiatan</th>
                            <th class="px-4 py-3 text-left font-semibold">Status</th>
                            <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 italic">
                        @foreach($pengajuans as $p)
                            <tr class="hover:bg-green-50 transition NOT-italic bg-white">
                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-800">
                                        {{ $p->user->email }}
                                    </div>
                                </td>

                                <td class="px-4 py-3">
                                    {{ $p->nama_pemohon }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $p->jenisKegiatan->nama }}
                                </td>

                                <td class="px-4 py-3 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d M Y') }}
                                    –
                                    {{ \Carbon\Carbon::parse($p->tanggal_selesai)->format('d M Y') }}
                                </td>

                                <td class="px-4 py-3">
                                    @php
                                        $statusColors = [
                                            'menunggu' => 'bg-yellow-100 text-yellow-800',
                                            'disetujui' => 'bg-green-100 text-green-800',
                                            'ditolak' => 'bg-red-100 text-red-800',
                                            'revisi' => 'bg-blue-100 text-blue-800',
                                        ];
                                    @endphp
                                    <span
                                        class="px-3 py-1 text-[10px] font-bold rounded-full {{ $statusColors[$p->status] ?? 'bg-gray-100' }} uppercase">
                                        {{ $p->status }}
                                    </span>
                                    @if($p->is_revisi_submitted && $p->status === 'menunggu')
                                        <div class="mt-1">
                                            <span
                                                class="px-2 py-0.5 text-[8px] font-bold bg-purple-600 text-white rounded uppercase tracking-wider">
                                                Hasil Revisi
                                            </span>
                                        </div>
                                    @endif
                                </td>

                                <td class="px-4 py-3">
                                    <a href="{{ route('admin.pengajuan.show', $p->id) }}"
                                        class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-white bg-green-600 hover:bg-green-700 transition">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</x-admin-layout>