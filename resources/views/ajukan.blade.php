<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 py-10">

        <h1 class="text-3xl font-bold mb-4">Pengajuan SIMAKSI</h1>

        <!-- Peringatan -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6 text-sm text-yellow-800">
            <strong>Perhatian:</strong>
            Pastikan seluruh data dan dokumen yang diunggah benar dan sesuai ketentuan.
            Permohonan akan diverifikasi oleh petugas Balai Taman Nasional Gunung Merapi.
        </div>
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6 text-sm text-yellow-800">
            Persyaratan dokumen akan ditampilkan setelah pemohon memilih jenis kegiatan dan kewarganegaraan.
        </div>

        <form action="{{ route('ajukan.store') }}" method="POST" enctype="multipart/form-data" id="ajukanForm">
            @csrf

            <!-- DATA KEGIATAN -->
            <div class="bg-white rounded-lg shadow p-6 mb-6 border-l-4 border-green-600">
                <h2 class="text-lg font-semibold mb-4">Data Kegiatan</h2>

                <!-- Card: Data Penanggung Jawab -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4">Data Penanggung Jawab</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_pemohon" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Identitas (NIM/KTP/NIK)</label>
                            <input type="text" name="identitas"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Jabatan / Peran</label>
                            <input type="text" name="jabatan" required placeholder="Koordinator, Ketua Kelompok, Dosen Pembimbing"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Instansi / Asal</label>
                            <input type="text" name="instansi" required placeholder="Universitas, Sekolah, Perusahaan"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        </div>
                    </div>
                </div>

                <!-- Jenis Kegiatan -->
                <div class="mb-4">
                    <label class="block font-medium mb-2">Jenis Kegiatan</label>
                    <select name="jenis_kegiatan_id" id="jenis_kegiatan"
                            class="w-full border rounded-lg px-4 py-2" required>
                        <option value="" disabled selected hidden>Pilih Jenis Kegiatan</option>
                        @foreach($jenisKegiatans as $jk)
                            <option value="{{ $jk->id }}">{{ $jk->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Kewarganegaraan -->
                <div class="mb-4">
                    <label class="block font-medium mb-2">Kewarganegaraan</label>
                    <div class="flex space-x-6">
                        <label class="flex items-center space-x-2">
                            <input type="radio" id="wni" name="kewarganegaraan" value="WNI" required>
                            <span>WNI</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="radio" id="wna" name="kewarganegaraan" value="WNA" required>
                            <span>WNA</span>
                        </label>
                    </div>
                </div>

                <!-- Tanggal -->
                <div class="mb-4">
                    <label class="block font-medium mb-2">Waktu Pelaksanaan</label>
                    <div class="grid grid-cols-2 gap-4">
                        <input type="date" name="tanggal_mulai"
                                min="{{ now()->toDateString() }}"
                                required class="border rounded-lg px-4 py-2">
                        <input type="date" name="tanggal_selesai"
                                min="{{ now()->toDateString() }}"
                                required class="border rounded-lg px-4 py-2">
                    </div>
                </div>
            </div>

            <!-- UPLOAD DOKUMEN -->
            <div class="bg-white rounded-lg shadow p-6 mb-6 border-l-4 border-green-600">
                <h2 class="text-lg font-semibold mb-3">Upload Dokumen Persyaratan</h2>
                <div id="dokumen-container" class="space-y-6">
                    Pilih jenis kegiatan dan kewarganegaraan terlebih dahulu.
                </div>
            </div>

            <!-- Data Anggota -->
            <div class="bg-white rounded-lg shadow p-6 mt-6 mb-6 border-l-4 border-green-600">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Data Anggota</h2>
                    <button type="button" id="tambah-anggota"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Tambah Anggota
                    </button>
                </div>

                <p class="text-sm text-gray-600 mb-4">
                    Tambahkan anggota selain penanggung jawab (misalnya mahasiswa atau anggota kelompok).
                </p>

                <div id="anggota-container">
                    <!-- Baris pertama (default) -->
                    <div class="anggota-row flex flex-col md:flex-row gap-4 mb-4" data-index="0">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                            <input type="text" name="anggota[0][nama]" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2">
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Identitas (NIM/KTP)</label>
                            <input type="text" name="anggota[0][identitas]"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2">
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Peran</label>
                            <input type="text" name="anggota[0][peran]" placeholder="Anggota, Dosen, Koordinator"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2">
                        </div>
                        <div class="flex items-end">
                            <button type="button"
                                class="hapus-anggota text-red-500 hover:text-red-700 text-lg font-bold">
                                ×
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ACTION -->
            <div class="flex items-center space-x-4">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">
                    Ajukan SIMAKSI
                </button>
                <a href="{{ route('dashboard') }}" class="text-green-600 hover:underline">
                    ← Kembali
                </a>
            </div>
        </form>
    </div>

    <!-- SCRIPT DINAMIS DOKUMEN -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jenisKegiatan = document.getElementById('jenis_kegiatan');
            const wni = document.getElementById('wni');
            const wna = document.getElementById('wna');
            const container = document.getElementById('dokumen-container');

            function loadPersyaratan() {
                const jenisId = jenisKegiatan.value;
                const kewarganegaraan = wni.checked ? 'WNI' : (wna.checked ? 'WNA' : '');

                container.innerHTML = '';

                if (!jenisId || !kewarganegaraan) {
                    container.innerHTML =
                        '<p class="text-gray-500">Pilih jenis kegiatan dan kewarganegaraan terlebih dahulu.</p>';
                    return;
                }

                fetch(`/api/persyaratan?jenis_kegiatan_id=${jenisId}&kewarganegaraan=${kewarganegaraan}`)
                    .then(res => res.json())
                    .then(data => {
                        if (!data.length) {
                            container.innerHTML =
                                '<p class="text-gray-500">Tidak ada dokumen wajib.</p>';
                            return;
                        }

                        let html = '';
                        data.forEach(dok => {
                            const field = 'file_' + dok
                                .toLowerCase()
                                .replace(/\s+/g, '_')
                                .replace(/[^a-z0-9_]/g, '');

                            const isSuratPernyataan = dok.toLowerCase().includes('surat pernyataan kesanggupan');
                            let templateSection = '';

                            if (isSuratPernyataan) {
                                templateSection = `
                                    <div class="mt-3 bg-green-50 border border-green-200 rounded-lg p-4 text-sm text-green-900">
                                        <div class="flex items-center gap-2 mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span class="font-semibold">Template Surat Pernyataan Kesanggupan</span>
                                        </div>
                                        <p class="mb-3">
                                            Silakan unduh template resmi, isi sesuai data kegiatan,
                                            kemudian tanda tangani dan unggah kembali dalam format PDF.
                                        </p>
                                        <div class="flex items-center gap-3">
                                            <a href="/surat/download/${jenisId}"
                                               class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2v-4a2 2 0 012-2h2m10 0h2a2 2 0 012 2v4a2 2 0 01-2 2z" />
                                                </svg>
                                                Download Template Surat
                                            </a>
                                            <span class="text-xs text-gray-700">Format: PDF / DOC</span>
                                        </div>
                                    </div>
                                `;
                            }

                            html += `
                                <div class="border-2 border-dashed border-green-400 rounded-lg p-4 bg-green-50">
                                    <div class="mb-2">
                                        <label class="block font-medium text-gray-700">${dok}</label>
                                    </div>
                                    ${templateSection}
                                    <div class="mt-3">
                                        <input type="file"
                                            name="${field}"
                                            accept=".pdf,.jpg,.jpeg,.png"
                                            required
                                            onchange="checkFileSize(this)"
                                            class="block w-full text-sm text-gray-700 cursor-pointer
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-green-600 file:text-white
                                            hover:file:bg-green-700">
                                        <p class="mt-2 text-xs text-green-800">
                                            Klik Choose File untuk memilih dokumen
                                        </p>
                                        <p class="text-red-600 text-xs mt-1 hidden file-error">
                                            Ukuran file melebihi 1MB! Silakan upload file yang lebih kecil.
                                        </p>
                                        <p class="mt-1 text-xs text-gray-500">
                                            *Ukuran file maksimal 1 MB (PDF, JPG, JPEG, PNG).
                                        </p>
                                    </div>
                                </div>
                            `;
                        });

                        container.innerHTML = html;
                    })
                    .catch(() => {
                        container.innerHTML =
                            '<p class="text-red-500">Gagal memuat dokumen persyaratan.</p>';
                    });
            }

            jenisKegiatan.addEventListener('change', loadPersyaratan);
            wni.addEventListener('change', loadPersyaratan);
            wna.addEventListener('change', loadPersyaratan);

            // Validasi sebelum submit form
            document.getElementById('ajukanForm').addEventListener('submit', function(e) {
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
                    alert('⚠️ Ada file yang melebihi 1 MB. Silakan periksa dan upload ulang.');
                }
            });
        });

        function checkFileSize(input) {
            const file = input.files[0];
            const errorEl = input.closest('.border-dashed')?.querySelector('.file-error');

            if (file) {
                if (file.size > 1024 * 1024) { // >1MB
                    if (errorEl) errorEl.classList.remove('hidden');
                    input.value = "";
                } else {
                    if (errorEl) errorEl.classList.add('hidden');
                }
            }
        }
    </script>

    <script>
        let nextIndex = 1;

        document.getElementById('tambah-anggota').addEventListener('click', function () {
            const container = document.getElementById('anggota-container');
            const newRow = document.createElement('div');
            newRow.className = 'anggota-row flex flex-col md:flex-row gap-4 mb-4';
            newRow.dataset.index = nextIndex;
            newRow.innerHTML = `
                <div class="flex-1">
                    <label class="block text-sm text-gray-700 mb-1">Nama</label>
                    <input type="text" name="anggota[${nextIndex}][nama]" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2">
                </div>
                <div class="flex-1">
                    <label class="block text-sm text-gray-700 mb-1">Identitas (NIM/KTP)</label>
                    <input type="text" name="anggota[${nextIndex}][identitas]"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2">
                </div>
                <div class="flex-1">
                    <label class="block text-sm text-gray-700 mb-1">Peran</label>
                    <input type="text" name="anggota[${nextIndex}][peran]" placeholder="Anggota, Dosen, Koordinator"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2">
                </div>
                <div class="flex items-end">
                    <button type="button" class="hapus-anggota text-red-500 hover:text-red-700 text-lg">
                        ×
                    </button>
                </div>
            `;
            container.appendChild(newRow);

            newRow.querySelector('.hapus-anggota').addEventListener('click', function () {
                newRow.remove();
            });

            nextIndex++;
        });

        document.querySelectorAll('.hapus-anggota').forEach(btn => {
            btn.addEventListener('click', function () {
                this.closest('.anggota-row').remove();
            });
        });
    </script>
</x-app-layout>