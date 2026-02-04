<x-admin-layout>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-green-800">Detail Pengajuan SIMAKSI</h2>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="text-green-600 hover:underline flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Dashboard
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Data Pemohon & Kegiatan -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
                <h3 class="text-lg font-semibold text-green-700 mb-4 border-b pb-2">Data Pemohon & Kegiatan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Nama Pemohon</p>
                        <p class="font-medium text-gray-800">{{ $pengajuan->nama_pemohon }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Email (Akun)</p>
                        <p class="font-medium text-gray-800">{{ $pengajuan->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Identitas</p>
                        <p class="font-medium text-gray-800">{{ $pengajuan->identitas }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Jabatan / Peran</p>
                        <p class="font-medium text-gray-800">{{ $pengajuan->jabatan }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Instansi</p>
                        <p class="font-medium text-gray-800">{{ $pengajuan->instansi }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Jenis Kegiatan</p>
                        <p class="font-medium text-gray-800">{{ $pengajuan->jenisKegiatan->nama }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Kewarganegaraan</p>
                        <p class="font-medium text-gray-800">{{ $pengajuan->kewarganegaraan }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Waktu Pelaksanaan</p>
                        <p class="font-medium text-gray-800">
                            {{ \Carbon\Carbon::parse($pengajuan->tanggal_mulai)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($pengajuan->tanggal_selesai)->format('d M Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-500">Lokasi Kegiatan</p>
                        <p class="font-medium text-gray-800">{{ $pengajuan->lokasi }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-gray-500">Tujuan Kegiatan</p>
                        <p class="font-medium text-gray-800">{{ $pengajuan->tujuan }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
                <h3 class="text-lg font-semibold text-green-700 mb-4 border-b pb-2">Dokumen Terupload</h3>
                <div class="space-y-3">
                    @forelse($pengajuan->dokumens as $dok)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-100">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">{{ $dok->nama_dokumen }}</p>
                                    <p class="text-xs text-gray-500">{{ basename($dok->file_path) }}</p>
                                </div>
                            </div>
                            <a href="/storage/{{ $dok->file_path }}" target="_blank"
                                class="text-green-600 hover:text-green-700 text-sm font-semibold">
                                Lihat File
                            </a>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 italic">Belum ada dokumen terupload.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
                <h3 class="text-lg font-semibold text-green-700 mb-4 border-b pb-2">Data Anggota</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left font-semibold">Nama</th>
                                <th class="px-4 py-2 text-left font-semibold">Identitas</th>
                                <th class="px-4 py-2 text-left font-semibold">Peran</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($pengajuan->anggotas as $agt)
                                <tr>
                                    <td class="px-4 py-2 text-gray-800">{{ $agt->nama }}</td>
                                    <td class="px-4 py-2 text-gray-600">{{ $agt->identitas }}</td>
                                    <td class="px-4 py-2 text-gray-600">{{ $agt->peran }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-2 text-center text-gray-500 italic">Tidak ada anggota
                                        tambahan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Update Status -->
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
                <h3 class="text-lg font-semibold text-green-700 mb-4 border-b pb-2">Update Status</h3>
                <p class="text-sm text-gray-600 mb-4">
                    Pilih status untuk memperbarui progres pengajuan ini.
                </p>

                <form action="{{ route('admin.pengajuan.status', $pengajuan->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Saat Ini</label>
                            @php
                                $colors = [
                                    'menunggu' => 'bg-yellow-100 text-yellow-800',
                                    'disetujui' => 'bg-green-100 text-green-800',
                                    'ditolak' => 'bg-red-100 text-red-800',
                                    'revisi' => 'bg-blue-100 text-blue-800',
                                ];
                            @endphp
                            <span
                                class="px-3 py-1 text-xs font-semibold rounded-full {{ $colors[$pengajuan->status] }}">
                                {{ ucfirst($pengajuan->status) }}
                            </span>
                            @if($pengajuan->is_revisi_submitted && $pengajuan->status === 'menunggu')
                                <span
                                    class="ml-2 px-2 py-0.5 text-[10px] font-bold bg-purple-100 text-purple-700 rounded border border-purple-200 uppercase">
                                    Sudah Direvisi (Kiriman Ulang)
                                </span>
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ubah Ke</label>
                            <select name="status"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm mb-4">
                                <option value="menunggu" {{ $pengajuan->status == 'menunggu' ? 'selected' : '' }}>Menunggu
                                </option>
                                <option value="disetujui" {{ $pengajuan->status == 'disetujui' ? 'selected' : '' }}>
                                    Disetujui</option>
                                <option value="ditolak" {{ $pengajuan->status == 'ditolak' ? 'selected' : '' }}>Ditolak
                                </option>
                                <option value="revisi" {{ $pengajuan->status == 'revisi' ? 'selected' : '' }}>Revisi
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan dari Admin</label>
                            <textarea name="catatan" rows="3"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                                placeholder="Tulis alasan jika status diubah menjadi Ditolak atau Revisi...">{{ $pengajuan->catatan }}</textarea>
                            <p class="text-[10px] text-gray-400 mt-1">*Catatan ini akan dapat dilihat oleh pemohon.</p>
                        </div>

                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg text-sm">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
            <!-- Riwayat Status (Timeline) -->
            <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
                <h3 class="text-lg font-semibold text-green-700 mb-4 border-b pb-2">Riwayat Alur Pengajuan</h3>
                <div class="relative pl-6 border-l-2 border-green-100 space-y-6">
                    @forelse($pengajuan->statusLogs as $log)
                        <div class="relative">
                            <!-- Bullet -->
                            <div class="absolute -left-[31px] top-1.5 w-4 h-4 rounded-full border-2 border-white 
                                        @if($log->status == 'menunggu') bg-yellow-400 
                                        @elseif($log->status == 'revisi') bg-blue-500 
                                        @elseif($log->status == 'sudah di revisi') bg-purple-500 
                                        @elseif($log->status == 'disetujui') bg-green-500 
                                        @else bg-red-500 @endif shadow-sm">
                            </div>

                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold uppercase tracking-wider 
                                            @if($log->status == 'menunggu') text-yellow-700 
                                            @elseif($log->status == 'revisi') text-blue-700 
                                            @elseif($log->status == 'sudah di revisi') text-purple-700 
                                            @elseif($log->status == 'disetujui') text-green-700 
                                            @else text-red-700 @endif">
                                        {{ $log->status == 'sudah di revisi' ? 'SUDAH DIREVISI' : ucfirst($log->status) }}
                                    </span>
                                    <span class="text-[10px] text-gray-400">
                                        {{ $log->created_at->format('d M Y, H:i') }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $log->catatan ?: '-' }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="text-sm text-gray-500 italic">Belum ada riwayat status tercatat.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>