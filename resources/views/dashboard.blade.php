<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-10">

        <h1 class="text-3xl font-bold mb-4">Riwayat Pengajuan SIMAKSI</h1>

        <!-- Info Instansi -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6 text-sm text-blue-800">
            <strong>Informasi:</strong>
            Halaman ini menampilkan seluruh riwayat pengajuan izin kegiatan yang telah Anda ajukan melalui Sistem SIMAKSI.
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
            <div class="bg-white rounded-lg shadow overflow-hidden">

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
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach($pengajuans as $pengajuan)
                            <tr>
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
                                    @else
                                        <span class="px-2 py-1 rounded-full bg-red-100 text-red-800 text-xs font-semibold">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-500">
                                    {{ $pengajuan->created_at->format('d M Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        @endif
    </div>
</x-app-layout>
