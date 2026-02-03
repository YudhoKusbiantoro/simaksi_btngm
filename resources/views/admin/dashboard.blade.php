<x-admin-layout>
    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-green-800">
            Ringkasan Pengajuan SIMAKSI
        </h2>
        <p class="text-sm text-gray-500">
            Monitoring seluruh permohonan izin kegiatan kawasan konservasi
        </p>
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
            <div class="bg-green-700 px-6 py-3">
                <h3 class="text-white font-semibold text-sm">
                    Data Pengajuan Masuk
                </h3>
            </div>

            <table class="min-w-full text-sm">
                <thead class="bg-green-50 text-green-900">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Pemohon</th>
                        <th class="px-4 py-3 text-left font-semibold">Jenis Kegiatan</th>
                        <th class="px-4 py-3 text-left font-semibold">Kewarganegaraan</th>
                        <th class="px-4 py-3 text-left font-semibold">Waktu Kegiatan</th>
                        <th class="px-4 py-3 text-left font-semibold">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                @foreach($pengajuans as $p)
                    <tr class="hover:bg-green-50 transition">
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-800">
                                {{ $p->user->email }}
                            </div>
                        </td>

                        <td class="px-4 py-3">
                            {{ $p->jenisKegiatan->nama }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $p->kewarganegaraan }}
                        </td>

                        <td class="px-4 py-3 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d M Y') }}
                            –
                            {{ \Carbon\Carbon::parse($p->tanggal_selesai)->format('d M Y') }}
                        </td>

                        <td class="px-4 py-3">
                            @if($p->status === 'menunggu')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Menunggu
                                </span>
                            @elseif($p->status === 'disetujui')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Disetujui
                                </span>
                            @elseif($p->status === 'ditolak')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Ditolak
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-admin-layout>
