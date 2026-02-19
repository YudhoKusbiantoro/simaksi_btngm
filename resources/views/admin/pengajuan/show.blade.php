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
            <div class="bg-white rounded-xl shadow p-4 md:p-6 border border-gray-200">
                <div
                    class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 border-b pb-2 gap-2">
                    <h3 class="text-lg font-semibold text-green-700">Data Pemohon & Kegiatan</h3>
                    <button type="button" onclick="document.getElementById('modalEditData').classList.remove('hidden')"
                        class="text-xs bg-green-50 text-green-600 hover:bg-green-100 px-3 py-1 rounded-lg font-semibold flex items-center gap-1 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Data
                    </button>
                </div>
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
                        <p class="text-gray-500">Nomor Identitas (NIM/NIK)</p>
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
                        <p class="text-gray-500">Nomor WhatsApp / HP</p>
                        <p class="font-medium text-gray-800">{{ $pengajuan->nomor_hp ?: '-' }}</p>
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

            <!-- Modal Edit Data -->
            <div id="modalEditData" class="fixed inset-0 z-50 hidden overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <form action="{{ route('admin.pengajuan.data', $pengajuan->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">
                                    Edit Data Pemohon & Kegiatan
                                </h3>
                                <div class="space-y-4 text-sm">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-1">Nama Pemohon</label>
                                        <input type="text" name="nama_pemohon" value="{{ $pengajuan->nama_pemohon }}"
                                            required
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-1">Nomor Identitas</label>
                                        <input type="text" name="identitas" value="{{ $pengajuan->identitas }}" required
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500">
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-gray-700 font-medium mb-1">Jabatan</label>
                                            <input type="text" name="jabatan" value="{{ $pengajuan->jabatan }}" required
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500">
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 font-medium mb-1">Instansi</label>
                                            <input type="text" name="instansi" value="{{ $pengajuan->instansi }}"
                                                required
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-1">Nomor WhatsApp / HP</label>
                                        <input type="text" name="nomor_hp" value="{{ $pengajuan->nomor_hp }}"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500"
                                            placeholder="Contoh: 08123456789">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-1">Lokasi Kegiatan</label>
                                        <input type="text" name="lokasi" value="{{ $pengajuan->lokasi }}" required
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-1">Tujuan Kegiatan</label>
                                        <textarea name="tujuan" required rows="3"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500">{{ $pengajuan->tujuan }}</textarea>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-gray-700 font-medium mb-1">Tanggal Mulai</label>
                                            <input type="date" name="tanggal_mulai"
                                                value="{{ \Carbon\Carbon::parse($pengajuan->tanggal_mulai)->format('Y-m-d') }}"
                                                required
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500">
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 font-medium mb-1">Tanggal Selesai</label>
                                            <input type="date" name="tanggal_selesai"
                                                value="{{ \Carbon\Carbon::parse($pengajuan->tanggal_selesai)->format('Y-m-d') }}"
                                                required
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                                <button type="submit"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none sm:w-auto sm:text-sm">
                                    Simpan Perubahan
                                </button>
                                <button type="button"
                                    onclick="document.getElementById('modalEditData').classList.add('hidden')"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
                <h3 class="text-lg font-semibold text-green-700 mb-4 border-b pb-2">Dokumen Terupload</h3>
                <div class="space-y-3">
                    @forelse($pengajuan->dokumens as $dok)
                        <div
                            class="flex flex-col sm:flex-row sm:items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-100 gap-3">
                            <div class="flex items-center gap-3 overflow-hidden">
                                <div class="shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-gray-800 truncate" title="{{ $dok->nama_dokumen }}">
                                        {{ $dok->nama_dokumen }}</p>
                                    <p class="text-xs text-gray-500 truncate" title="{{ basename($dok->file_path) }}">
                                        {{ basename($dok->file_path) }}</p>
                                </div>
                            </div>
                            <a href="/storage/{{ $dok->file_path }}" target="_blank"
                                class="text-green-600 hover:text-green-700 text-sm font-semibold whitespace-nowrap self-end sm:self-auto bg-green-50 px-3 py-1.5 rounded-lg hover:bg-green-100 transition-colors">
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

            <!-- Generate PDF SIMAKSI (Hanya tampil jika status disetujui) -->
            @if($pengajuan->status === 'disetujui')
                <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-green-700 mb-4 border-b pb-2">Persiapan PDF SIMAKSI</h3>

                    @if($pengajuan->approval && $pengajuan->approval->file_pdf)
                        <div
                            class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-sm text-green-800 flex items-center justify-between">
                            <div>
                                <p class="font-bold">PDF SIMAKSI Sudah Dibuat</p>
                                <p class="text-xs">Nomor: {{ $pengajuan->approval->nomor_surat }}</p>
                            </div>
                            <a href="{{ route('admin.pengajuan.preview-pdf', $pengajuan->id) }}"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-bold flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Lihat / Preview PDF
                            </a>
                        </div>
                        <hr class="my-4">
                        <p class="text-xs text-gray-500 mb-4">Anda dapat memperbarui data di bawah ini untuk men-generate ulang
                            PDF (Nomor surat akan mengikuti urutan terbaru).</p>
                    @endif

                    <form action="{{ route('admin.pengajuan.generate-pdf', $pengajuan->id) }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kode / Referensi Surat (Bagian
                                    Tengah)</label>

                                <div class="flex flex-wrap gap-4 mb-3">
                                    @php
                                        $currentKode = $pengajuan->approval->kode_surat ?? 'LIT.0.0';
                                        $isPreset = in_array($currentKode, ['LIT.0.0', 'HMS.2.0']);
                                    @endphp

                                    <label
                                        class="flex items-center gap-2 p-3 border rounded-xl cursor-pointer hover:bg-gray-50 transition {{ $currentKode == 'LIT.0.0' ? 'border-green-500 bg-green-50' : 'border-gray-200' }}"
                                        onclick="selectKode('LIT.0.0', this)">
                                        <input type="radio" name="kode_choice" value="LIT.0.0" {{ $currentKode == 'LIT.0.0' ? 'checked' : '' }} class="text-green-600 focus:ring-green-500">
                                        <span class="text-sm font-medium">LIT.0.0</span>
                                    </label>

                                    <label
                                        class="flex items-center gap-2 p-3 border rounded-xl cursor-pointer hover:bg-gray-50 transition {{ $currentKode == 'HMS.2.0' ? 'border-green-500 bg-green-50' : 'border-gray-200' }}"
                                        onclick="selectKode('HMS.2.0', this)">
                                        <input type="radio" name="kode_choice" value="HMS.2.0" {{ $currentKode == 'HMS.2.0' ? 'checked' : '' }} class="text-green-600 focus:ring-green-500">
                                        <span class="text-sm font-medium">HMS.2.0</span>
                                    </label>

                                    <label
                                        class="flex items-center gap-2 p-3 border rounded-xl cursor-pointer hover:bg-gray-50 transition {{ !$isPreset ? 'border-green-500 bg-green-50' : 'border-gray-200' }}"
                                        onclick="selectKode('opsional', this)">
                                        <input type="radio" name="kode_choice" value="opsional" {{ !$isPreset ? 'checked' : '' }} class="text-green-600 focus:ring-green-500">
                                        <span class="text-sm font-medium">Opsional (Manual)</span>
                                    </label>
                                </div>

                                <div id="manual_kode_container" class="{{ $isPreset ? 'hidden' : '' }} mt-2">
                                    <input type="text" id="manual_kode_input"
                                        name="{{ !$isPreset ? 'kode_surat' : 'kode_surat_unused' }}"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-green-500 focus:ring-green-500"
                                        placeholder="Ketik kode manual di sini (misal: Hkm.1.0)" value="{{ $currentKode }}">
                                </div>

                                <input type="hidden" id="final_kode_input"
                                    name="{{ $isPreset ? 'kode_surat' : 'kode_surat_unused' }}" value="{{ $currentKode }}">

                                <script>
                                    function selectKode(value, el) {
                                        const container = document.getElementById('manual_kode_container');
                                        const manualInput = document.getElementById('manual_kode_input');
                                        const finalInput = document.getElementById('final_kode_input');

                                        // Reset classes for all labels
                                        el.parentNode.querySelectorAll('label').forEach(label => {
                                            label.classList.remove('border-green-500', 'bg-green-50');
                                            label.classList.add('border-gray-200');
                                        });

                                        // Highlight selected
                                        el.classList.add('border-green-500', 'bg-green-50');
                                        el.classList.remove('border-gray-200');

                                        if (value === 'opsional') {
                                            container.classList.remove('hidden');
                                            finalInput.name = 'kode_surat_unused'; // Disable final input
                                            manualInput.name = 'kode_surat'; // Enable manual input
                                        } else {
                                            container.classList.add('hidden');
                                            manualInput.name = 'kode_surat_unused'; // Disable manual input
                                            finalInput.name = 'kode_surat'; // Enable final input
                                            finalInput.value = value;
                                        }
                                    }
                                </script>

                                <p class="text-[10px] text-gray-400 mt-2">*Kode ini akan disisipkan di tengah nomor surat.
                                </p>
                            </div>

                            <hr class="my-2 border-gray-100">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Penandatangan SIMAKSI</label>

                                <div class="flex flex-wrap gap-4 mb-3">
                                    <label
                                        class="flex items-center gap-2 p-3 border rounded-xl cursor-pointer hover:bg-gray-50 transition border-green-500 bg-green-50"
                                        onclick="selectTtd('ttd_a', this)">
                                        <input type="radio" name="ttd_choice" value="ttd_a" checked class="text-green-600 focus:ring-green-500">
                                        <div class="text-xs">
                                            <p class="font-bold">Penandatangan A</p>
                                            <p class="text-gray-500 leading-tight">{{ $ttd_a['nama'] ?: 'Data belum diatur' }}</p>
                                        </div>
                                    </label>

                                    <label
                                        class="flex items-center gap-2 p-3 border rounded-xl cursor-pointer hover:bg-gray-50 transition border-gray-200"
                                        onclick="selectTtd('ttd_b', this)">
                                        <input type="radio" name="ttd_choice" value="ttd_b" class="text-green-600 focus:ring-green-500">
                                        <div class="text-xs">
                                            <p class="font-bold">Penandatangan B</p>
                                            <p class="text-gray-500 leading-tight">{{ $ttd_b['nama'] ?: 'Data belum diatur' }}</p>
                                        </div>
                                    </label>

                                    <label
                                        class="flex items-center gap-2 p-3 border rounded-xl cursor-pointer hover:bg-gray-50 transition border-gray-200"
                                        onclick="selectTtd('manual', this)">
                                        <input type="radio" name="ttd_choice" value="manual" class="text-green-600 focus:ring-green-500">
                                        <div class="text-xs">
                                            <p class="font-bold">Manual / Opsional</p>
                                            <p class="text-gray-500 leading-tight">Isi manual sendiri</p>
                                        </div>
                                    </label>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-4">
                                    <div class="md:col-span-2">
                                        <label class="block text-[10px] uppercase font-bold text-gray-400 mb-1">Nama Lengkap & Gelar</label>
                                        <input type="text" id="ttd_nama" name="penandatangan_nama" required
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-green-500 focus:ring-green-500 bg-gray-50"
                                            value="{{ $ttd_a['nama'] }}" readonly>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] uppercase font-bold text-gray-400 mb-1">NIP</label>
                                        <input type="text" id="ttd_nip" name="penandatangan_nip" required
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-green-500 focus:ring-green-500 bg-gray-50"
                                            value="{{ $ttd_a['nip'] }}" readonly>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] uppercase font-bold text-gray-400 mb-1">Jabatan</label>
                                        <input type="text" id="ttd_jabatan" name="penandatangan_jabatan" required
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-green-500 focus:ring-green-500 bg-gray-50"
                                            value="{{ $ttd_a['jabatan'] }}" readonly>
                                    </div>
                                </div>

                                <script>
                                    const ttd_data = {
                                        'ttd_a': {
                                            'nama': @json($ttd_a['nama']),
                                            'nip': @json($ttd_a['nip']),
                                            'jabatan': @json($ttd_a['jabatan'])
                                        },
                                        'ttd_b': {
                                            'nama': @json($ttd_b['nama']),
                                            'nip': @json($ttd_b['nip']),
                                            'jabatan': @json($ttd_b['jabatan'])
                                        },
                                        'manual': {
                                            'nama': '',
                                            'nip': '',
                                            'jabatan': ''
                                        }
                                    };

                                    function selectTtd(type, el) {
                                        // Highlight UI
                                        el.parentNode.querySelectorAll('label').forEach(label => {
                                            label.classList.remove('border-green-500', 'bg-green-50');
                                            label.classList.add('border-gray-200');
                                        });
                                        el.classList.add('border-green-500', 'bg-green-50');
                                        el.classList.remove('border-gray-200');
                                        el.querySelector('input').checked = true;

                                        // Set values
                                        const namaInput = document.getElementById('ttd_nama');
                                        const nipInput = document.getElementById('ttd_nip');
                                        const jabatanInput = document.getElementById('ttd_jabatan');

                                        namaInput.value = ttd_data[type].nama;
                                        nipInput.value = ttd_data[type].nip;
                                        jabatanInput.value = ttd_data[type].jabatan;

                                        if (type === 'manual') {
                                            namaInput.readOnly = false;
                                            nipInput.readOnly = false;
                                            jabatanInput.readOnly = false;
                                            namaInput.classList.remove('bg-gray-50');
                                            nipInput.classList.remove('bg-gray-50');
                                            jabatanInput.classList.remove('bg-gray-50');
                                            namaInput.focus();
                                        } else {
                                            namaInput.readOnly = true;
                                            nipInput.readOnly = true;
                                            jabatanInput.readOnly = true;
                                            namaInput.classList.add('bg-gray-50');
                                            nipInput.classList.add('bg-gray-50');
                                            jabatanInput.classList.add('bg-gray-50');
                                        }
                                    }
                                </script>
                            </div>

                            <hr class="my-2 border-gray-100">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan Surat
                                    Pengantar</label>
                                <textarea name="keterangan_surat_pengantar" rows="2" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                                    placeholder="Contoh: Surat Pengantar dari Universitas Gadjah Mada Nomor 123/UN1/DT/2026 Tanggal 01 Jan 2026">{{ old('keterangan_surat_pengantar', $pengajuan->approval->keterangan_surat_pengantar ?? '') }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tarif PNBP (Rp)</label>
                                <input type="number" name="tarif_pnbp" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                                    placeholder="Contoh: 50000"
                                    value="{{ old('tarif_pnbp', $pengajuan->approval->tarif_pnbp ?? '') }}">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan (Opsi)</label>
                                <textarea name="catatan_admin" rows="2"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                                    placeholder="Keterangan tambahan di bawah syarat & ketentuan...">{{ old('catatan_admin', $pengajuan->approval->catatan_admin ?? '') }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tembusan (Opsi)</label>
                                <textarea name="tembusan" rows="3"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                                    placeholder="1. Kepala Balai TN Merapi&#10;2. {{ $pengajuan->instansi }}">{{ old('tembusan', $pengajuan->approval->tembusan ?? "1. Kepala Balai Taman Nasional Gunung Merapi\n2. {$pengajuan->instansi}") }}</textarea>
                            </div>

                            <button type="submit"
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg text-sm flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                                Simpan & Cetak PDF SIMAKSI
                            </button>
                        </div>
                    </form>
                </div>
            @endif
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
                                    'dijadwalkan presentasi' => 'bg-emerald-100 text-emerald-800',
                                    'revisi' => 'bg-purple-100 text-purple-800',
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
                            <select name="status" id="statusSelect"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm mb-4"
                                onchange="toggleSchedulingFields()">
                                <option value="menunggu" {{ $pengajuan->status == 'menunggu' ? 'selected' : '' }}>Menunggu
                                </option>
                                <option value="disetujui" {{ $pengajuan->status == 'disetujui' ? 'selected' : '' }}>
                                    Disetujui</option>
                                <option value="dijadwalkan presentasi" {{ $pengajuan->status == 'dijadwalkan presentasi' ? 'selected' : '' }}>
                                    Dijadwalkan Presentasi
                                </option>
                                <option value="revisi" {{ $pengajuan->status == 'revisi' ? 'selected' : '' }}>Revisi
                                </option>
                            </select>
                        </div>

                        <div id="schedulingFields"
                            class="{{ $pengajuan->status !== 'dijadwalkan presentasi' ? 'hidden' : '' }} space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Link Zoom / Meeting</label>
                                <input type="url" name="zoom_link" value="{{ $pengajuan->zoom_link }}"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                                    placeholder="https://zoom.us/j/...">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jadwal Presentasi</label>
                                <input type="datetime-local" name="jadwal_presentasi"
                                    value="{{ $pengajuan->jadwal_presentasi ? \Carbon\Carbon::parse($pengajuan->jadwal_presentasi)->format('Y-m-d\TH:i') : '' }}"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                            </div>
                        </div>

                        <script>
                            function toggleSchedulingFields() {
                                const status = document.getElementById('statusSelect').value;
                                const fields = document.getElementById('schedulingFields');
                                if (status === 'dijadwalkan presentasi') {
                                    fields.classList.remove('hidden');
                                } else {
                                    fields.classList.add('hidden');
                                }
                            }
                        </script>

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
                                                                                @elseif($log->status == 'revisi') bg-purple-500 
                                                                                @elseif($log->status == 'sudah di revisi') bg-blue-500 
                                                                                @elseif($log->status == 'disetujui') bg-green-500 
                                                                                @elseif($log->status == 'dijadwalkan presentasi') bg-blue-400 
                                                                                @else bg-gray-500 @endif shadow-sm">
                            </div>

                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold uppercase tracking-wider 
                                                                                    @if($log->status == 'menunggu') text-yellow-700 
                                                                                    @elseif($log->status == 'revisi') text-purple-700 
                                                                                    @elseif($log->status == 'sudah di revisi') text-blue-700 
                                                                                    @elseif($log->status == 'disetujui') text-green-700 
                                                                                    @elseif($log->status == 'dijadwalkan presentasi') text-blue-800 
                                                                                    @else text-gray-700 @endif">
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