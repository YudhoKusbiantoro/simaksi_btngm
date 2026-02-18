<x-app-layout>
    <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.500ms class="max-w-7xl mx-auto px-4 py-10">

        <div class="mb-4">
            <a href="{{ route('home') }}"
                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                &larr; Kembali ke Beranda
            </a>
        </div>

        <h1 class="text-3xl font-bold mb-4">Riwayat Pengajuan SIMAKSI</h1>

        <!-- Info Instansi -->
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6 text-sm text-green-800">
            <strong>Informasi:</strong>
            Halaman ini menampilkan seluruh riwayat pengajuan izin kegiatan yang telah Anda ajukan melalui Sistem
            SIMAKSI.
        </div>

        @if($pengajuans->isEmpty())
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-600">
                <p class="text-gray-700 mb-4">Belum ada pengajuan izin kegiatan.</p>
                <a href="{{ route('ajukan') }}"
                    class="inline-block bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700">
                    Ajukan SIMAKSI Sekarang
                </a>
            </div>
        @else
            <div class="bg-white rounded-lg shadow overflow-x-auto">

                <div class="px-6 py-4 border-b">
                    <h2 class="text-lg font-semibold">Daftar Pengajuan</h2>
                    <p class="text-sm text-gray-600">
                        Data permohonan izin kegiatan di kawasan konservasi.
                    </p>
                </div>

                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Jenis Kegiatan</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Kewarganegaraan</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Waktu Kegiatan</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Tanggal Pengajuan</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach($pengajuans as $pengajuan)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    {{ $pengajuan->jenisKegiatan?->nama ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $pengajuan->kewarganegaraan }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($pengajuan->tanggal_mulai)->format('d M Y') }}
                                    –
                                    {{ \Carbon\Carbon::parse($pengajuan->tanggal_selesai)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($pengajuan->status === 'menunggu')
                                        <span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold">
                                            Menunggu
                                        </span>
                                    @elseif($pengajuan->status === 'disetujui')
                                        <span class="px-2 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold">
                                            Disetujui
                                        </span>
                                    @elseif($pengajuan->status === 'dijadwalkan presentasi')
                                        <span class="px-2 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold">
                                            Dijadwalkan Presentasi
                                        </span>
                                    @elseif($pengajuan->status === 'revisi')
                                        <span class="px-2 py-1 rounded-full bg-purple-100 text-purple-800 text-xs font-semibold">
                                            Revisi
                                        </span>
                                    @else
                                        <span class="px-2 py-1 rounded-full bg-gray-100 text-gray-800 text-xs font-semibold">
                                            {{ ucfirst($pengajuan->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-500">
                                    {{ $pengajuan->created_at->format('d M Y') }}
                                    @if($pengajuan->catatan && in_array($pengajuan->status, ['revisi', 'dijadwalkan presentasi']))
                                        <div class="mt-1 text-[10px] text-red-500 italic max-w-xs truncate"
                                            title="{{ $pengajuan->catatan }}">
                                            Obs: {{ $pengajuan->catatan }}
                                        </div>
                                    @endif
                                    @if($pengajuan->status === 'dijadwalkan presentasi' && $pengajuan->zoom_link)
                                        <div class="mt-2 p-2 bg-blue-50 border border-blue-100 rounded text-[10px]">
                                            <p class="font-bold text-blue-700">Jadwal Presentasi:</p>
                                            <p>{{ \Carbon\Carbon::parse($pengajuan->jadwal_presentasi)->format('d M Y, H:i') }} WIB</p>
                                            <a href="{{ $p->zoom_link ?? $pengajuan->zoom_link }}" target="_blank" class="text-blue-600 underline font-bold mt-1 inline-block">Buka Link Zoom &rarr;</a>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($pengajuan->status === 'revisi')
                                        <a href="{{ route('ajukan.edit', $pengajuan->id) }}"
                                            class="text-green-600 hover:text-green-800 font-semibold underline">
                                            Lengkapi Revisi
                                        </a>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        @endif
    </div>
</x-app-layout>