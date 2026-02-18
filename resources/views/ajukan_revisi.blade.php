<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 py-10">

        <h1 class="text-3xl font-bold mb-4 text-gray-800">Revisi Pengajuan SIMAKSI</h1>

        <!-- Peringatan -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6 text-sm text-blue-800">
            <div class="flex items-center gap-2 mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd" />
                </svg>
                <strong class="font-bold">Instruksi Revisi:</strong>
            </div>
            Silakan unggah ulang dokumen yang perlu diperbaiki. Dokumen yang tidak diunggah ulang akan tetap menggunakan
            file yang sudah ada sebelumnya.

            @if($pengajuan->catatan)
                <div class="mt-3 p-3 bg-white border border-blue-200 rounded-lg">
                    <p class="font-semibold text-blue-900 mb-1">Catatan dari Admin:</p>
                    <p class="italic">"{{ $pengajuan->catatan }}"</p>
                </div>
            @endif
        </div>

        <form action="{{ route('ajukan.update', $pengajuan->id) }}" method="POST" enctype="multipart/form-data"
            id="ajukanForm">
            @csrf

            <!-- DATA KEGIATAN (READ ONLY) -->
            <div class="bg-gray-100 rounded-lg shadow p-6 mb-6 border-l-4 border-green-600 opacity-75">
                <h2 class="text-lg font-semibold mb-4 text-gray-700">Data Kegiatan (Hanya Baca)</h2>

                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4 text-gray-700">Data Penanggung Jawab</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-500 font-medium mb-1 text-sm">Nama Lengkap</label>
                            <p class="font-medium text-gray-800">{{ $pengajuan->nama_pemohon }}</p>
                        </div>
                        <div>
                            <label class="block text-gray-500 font-medium mb-1 text-sm">Identitas</label>
                            <p class="font-medium text-gray-800">{{ $pengajuan->identitas }}</p>
                        </div>
                        <div>
                            <label class="block text-gray-500 font-medium mb-1 text-sm">Jabatan / Peran</label>
                            <p class="font-medium text-gray-800">{{ $pengajuan->jabatan }}</p>
                        </div>
                        <div>
                            <label class="block text-gray-500 font-medium mb-1 text-sm">Instansi / Asal</label>
                            <p class="font-medium text-gray-800">{{ $pengajuan->instansi }}</p>
                        </div>
                        <div>
                            <label class="block text-gray-500 font-medium mb-1 text-sm">Nomor WhatsApp / HP</label>
                            <p class="font-medium text-gray-800">{{ $pengajuan->nomor_hp ?: '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-500 font-medium mb-1 text-sm">Jenis Kegiatan</label>
                        <p class="font-medium text-gray-800">{{ $pengajuan->jenisKegiatan->nama }}</p>
                        <input type="hidden" id="jenis_kegiatan" value="{{ $pengajuan->jenis_kegiatan_id }}">
                    </div>
                    <div>
                        <label class="block text-gray-500 font-medium mb-1 text-sm">Kewarganegaraan</label>
                        <p class="font-medium text-gray-800">{{ $pengajuan->kewarganegaraan }}</p>
                        <input type="hidden" id="kewarganegaraan_val" value="{{ $pengajuan->kewarganegaraan }}">
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-gray-500 font-medium mb-1 text-sm">Waktu Pelaksanaan</label>
                    <p class="font-medium text-gray-800">
                        {{ \Carbon\Carbon::parse($pengajuan->tanggal_mulai)->format('d M Y') }} -
                        {{ \Carbon\Carbon::parse($pengajuan->tanggal_selesai)->format('d M Y') }}
                    </p>
                </div>
            </div>

            <!-- DOKUMEN SAAT INI -->
            <div class="bg-white rounded-lg shadow p-6 mb-6 border-l-4 border-green-600">
                <h2 class="text-lg font-semibold mb-4 text-green-800">Dokumen yang Sudah Diunggah</h2>
                <div class="space-y-3">
                    @foreach($pengajuan->dokumens as $dok)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-100">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-sm font-medium text-gray-700">{{ $dok->nama_dokumen }}</span>
                            </div>
                            <a href="/storage/{{ $dok->file_path }}" target="_blank"
                                class="text-green-600 hover:underline text-xs font-semibold">
                                Lihat File
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- UPLOAD DOKUMEN REVISI -->
            <div class="bg-white rounded-lg shadow p-6 mb-6 border-l-4 border-yellow-500">
                <h2 class="text-lg font-semibold mb-3 text-yellow-800">Upload Dokumen Revisi (Pilih File untuk Mengubah)
                </h2>
                <p class="text-xs text-gray-500 mb-4">*Kosongkan jika tidak ada perubahan pada dokumen tersebut.</p>
                <div id="dokumen-container" class="space-y-4">
                    Memuat dokumen...
                </div>
            </div>

            <!-- ACTION -->
            <div class="flex items-center space-x-4">
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-bold shadow-lg transition duration-200">
                    Kirim Revisi
                </button>
                <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700 font-medium">
                    ← Batal
                </a>
            </div>
        </form>
    </div>

    <!-- SCRIPT DINAMIS DOKUMEN -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('dokumen-container');
            const jenisId = document.getElementById('jenis_kegiatan').value;
            const kewarganegaraan = document.getElementById('kewarganegaraan_val').value;

            function loadPersyaratan() {
                container.innerHTML = '<p class="text-gray-500">Memuat persyaratan...</p>';

                fetch(`/api/persyaratan?jenis_kegiatan_id=${jenisId}&kewarganegaraan=${kewarganegaraan}`)
                    .then(res => res.json())
                    .then(data => {
                        if (!data.length) {
                            container.innerHTML = '<p class="text-gray-500">Tidak ada dokumen wajib.</p>';
                            return;
                        }

                        let html = '';
                        data.forEach(dok => {
                            const field = 'file_' + dok
                                .toLowerCase()
                                .replace(/\s+/g, '_')
                                .replace(/[^a-z0-9_]/g, '');

                            html += `
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 bg-gray-50">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                        <div class="flex-1">
                                            <label class="block font-medium text-gray-700 mb-1">${dok}</label>
                                            <input type="file"
                                                name="${field}"
                                                accept=".pdf,.jpg,.jpeg,.png"
                                                onchange="checkFileSize(this)"
                                                class="block w-full text-sm text-gray-700 cursor-pointer
                                                file:mr-4 file:py-2 file:px-4
                                                file:rounded file:border-0
                                                file:text-sm file:font-semibold
                                                file:bg-green-600 file:text-white
                                                hover:file:bg-green-700">
                                        </div>
                                        <div class="text-right">
                                            <p class="text-[10px] text-gray-400">Max: 1MB (PDF, JPG, PNG)</p>
                                        </div>
                                    </div>
                                    <p class="text-red-600 text-[11px] mt-1 hidden file-error">
                                        Ukuran file melebihi 1MB!
                                    </p>
                                </div>
                            `;
                        });

                        container.innerHTML = html;
                    })
                    .catch(() => {
                        container.innerHTML = '<p class="text-red-500">Gagal memuat dokumen persyaratan.</p>';
                    });
            }

            loadPersyaratan();

            document.getElementById('ajukanForm').addEventListener('submit', function (e) {
                const inputs = document.querySelectorAll('input[type="file"]');
                let hasError = false;

                inputs.forEach(input => {
                    const file = input.files[0];
                    const errorEl = input.closest('.border-dashed')?.querySelector('.file-error');
                    if (file && file.size > 1024 * 1024) {
                        if (errorEl) errorEl.classList.remove('hidden');
                        hasError = true;
                    }
                });

                if (hasError) {
                    e.preventDefault();
                    alert('⚠️ Ada file yang melebihi 1 MB. Silakan periksa kembali.');
                }
            });
        });

        function checkFileSize(input) {
            const file = input.files[0];
            const errorEl = input.closest('.border-dashed')?.querySelector('.file-error');

            if (file) {
                if (file.size > 1024 * 1024) {
                    if (errorEl) errorEl.classList.remove('hidden');
                    input.value = "";
                } else {
                    if (errorEl) errorEl.classList.add('hidden');
                }
            }
        }
    </script>
</x-app-layout>