<x-admin-layout>
    <div class="max-w-5xl" x-data="{
        formatCurrency(val) {
            if (!val) return '';
            let valStr = val.toString().replace(/\D/g, '');
            return valStr.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
    }">
        <div class="space-y-12 pb-20">

            <!-- HEADER AREA -->
            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-green-900">Pengaturan Administrasi</h2>
                <p class="text-gray-500">Sesuaikan informasi pejabat dan data pendukung SIMAKSI</p>
            </div>

            <!-- SECTION: PENGATURAN PEJABAT -->
            <section>
                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <div class="h-10 w-2 bg-green-600 rounded-full"></div>
                            <h2 class="text-2xl font-bold text-gray-800">Pengaturan Pejabat Administrasi</h2>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-5 py-3 bg-gray-100 border-b border-gray-100">
                            <h3 class="font-bold text-gray-700 text-sm">Informasi Penandatangan</h3>
                        </div>
                        <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($pejabat['settings'] as $setting)
                                <div>
                                    <label class="block font-bold text-gray-700 mb-1 text-sm">
                                        {{ $setting->label }}
                                    </label>
                                    <input type="text" name="settings[{{ $setting->key }}]"
                                        value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                        class="w-full px-4 py-2 rounded-lg border-gray-200 focus:border-green-500 focus:ring-green-500 transition shadow-sm text-sm">
                                    <p class="mt-1 text-[10px] text-gray-400">{{ $setting->description }}</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="px-5 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-sm transition flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V4a1 1 0 10-2 0v7.586l-1.293-1.293z" />
                                    <path d="M5 15a1 1 0 000 2h10a1 1 0 100-2H5z" />
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </section>

            <!-- SECTION: PENGATURAN TARIF SIMAKSI -->
            <section class="border-t border-gray-200 pt-10">
                <div class="flex items-center gap-4 mb-6">
                    <div class="h-10 w-2 bg-green-600 rounded-full"></div>
                    <h2 class="text-2xl font-bold text-gray-800">Pengaturan Tarif SIMAKSI</h2>
                </div>

                <div class="space-y-8">
                    <!-- Kegiatan Wisata Alam -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf
                            <div class="px-5 py-3 bg-green-800 text-white flex items-center justify-between">
                                <h3 class="font-bold text-base">{{ $tarifGroups['wisata']['label'] }}</h3>
                                <button type="submit"
                                    class="bg-white/20 hover:bg-white/30 text-white border border-white/30 px-3 py-1 rounded-lg text-xs font-bold transition flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V4a1 1 0 10-2 0v7.586l-1.293-1.293z" />
                                        <path d="M5 15a1 1 0 000 2h10a1 1 0 100-2H5z" />
                                    </svg>
                                    Simpan Tarif
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse text-sm">
                                    <thead>
                                        <tr class="bg-green-700 text-white">
                                            <th class="px-5 py-3 font-bold border-r border-green-600">Jenis Kegiatan
                                            </th>
                                            <th class="px-5 py-3 font-bold border-r border-green-600">Satuan</th>
                                            <th class="px-5 py-3 font-bold">Tarif (Rp)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($tarifGroups['wisata']['settings'] as $setting)
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="px-5 py-3 font-medium text-gray-700 border-r border-gray-50">
                                                    {{ str_replace('Tarif ', '', $setting->label) }}
                                                </td>
                                                <td class="px-5 py-3 text-gray-500 border-r border-gray-50 italic">per orang
                                                    per
                                                    hari</td>
                                                <td class="px-5 py-3">
                                                    <div class="flex items-center gap-2 max-w-[200px]"
                                                        x-data="{ value: '{{ number_format($setting->value, 0, ',', '.') }}' }">
                                                        <span class="text-gray-400 font-semibold cursor-default">Rp</span>
                                                        <input type="text" name="settings[{{ $setting->key }}]"
                                                            x-model="value"
                                                            @input="value = formatCurrency($event.target.value)"
                                                            class="w-full px-3 py-1.5 rounded-lg border-gray-200 focus:border-green-500 focus:ring-green-500 transition shadow-sm text-sm text-right">
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>

                    <!-- Penelitian di Kawasan -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf
                            <div class="px-5 py-3 bg-green-800 text-white flex items-center justify-between">
                                <h3 class="font-bold text-base">{{ $tarifGroups['penelitian']['label'] }}</h3>
                                <button type="submit"
                                    class="bg-white/20 hover:bg-white/30 text-white border border-white/30 px-3 py-1 rounded-lg text-xs font-bold transition flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V4a1 1 0 10-2 0v7.586l-1.293-1.293z" />
                                        <path d="M5 15a1 1 0 000 2h10a1 1 0 100-2H5z" />
                                    </svg>
                                    Simpan Tarif
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse text-sm">
                                    <thead>
                                        <tr class="bg-green-700 text-white">
                                            <th rowspan="2"
                                                class="px-5 py-3 font-bold border-r border-green-600 align-middle">
                                                Jenis Kegiatan</th>
                                            <th colspan="2"
                                                class="px-5 py-1.5 font-bold border-b border-green-600 text-center uppercase tracking-wider text-xs">
                                                Tarif (Dalam Rupiah)</th>
                                        </tr>
                                        <tr class="bg-green-700 text-white text-center">
                                            <th class="px-5 py-2 font-bold border-r border-green-600 w-1/4">WNA</th>
                                            <th class="px-5 py-2 font-bold w-1/4">WNI</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($tarifGroups['penelitian']['rows'] as $row)
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="px-5 py-3 font-medium text-gray-700 border-r border-gray-50">
                                                    {{ $row['label'] }}
                                                </td>
                                                <td class="px-5 py-3 border-r border-gray-50">
                                                    <div class="flex items-center gap-2"
                                                        x-data="{ value: '{{ number_format($row['wna']->value, 0, ',', '.') }}' }">
                                                        <span
                                                            class="text-gray-400 text-xs font-semibold cursor-default">Rp</span>
                                                        <input type="text" name="settings[{{ $row['wna']->key }}]"
                                                            x-model="value"
                                                            @input="value = formatCurrency($event.target.value)"
                                                            class="w-full px-3 py-1.5 rounded-lg border-gray-200 focus:border-green-500 focus:ring-green-500 transition shadow-sm text-right text-sm">
                                                    </div>
                                                </td>
                                                <td class="px-5 py-3">
                                                    <div class="flex items-center gap-2"
                                                        x-data="{ value: '{{ number_format($row['wni']->value, 0, ',', '.') }}' }">
                                                        <span
                                                            class="text-gray-400 text-xs font-semibold cursor-default">Rp</span>
                                                        <input type="text" name="settings[{{ $row['wni']->key }}]"
                                                            x-model="value"
                                                            @input="value = formatCurrency($event.target.value)"
                                                            class="w-full px-3 py-1.5 rounded-lg border-gray-200 focus:border-green-500 focus:ring-green-500 transition shadow-sm text-right text-sm">
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>

                    <!-- Pengambilan Gambar Komersial -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf
                            <div class="px-5 py-3 bg-green-800 text-white flex items-center justify-between">
                                <h3 class="font-bold text-base">{{ $tarifGroups['komersial']['label'] }}</h3>
                                <button type="submit"
                                    class="bg-white/20 hover:bg-white/30 text-white border border-white/30 px-3 py-1 rounded-lg text-xs font-bold transition flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V4a1 1 0 10-2 0v7.586l-1.293-1.293z" />
                                        <path d="M5 15a1 1 0 000 2h10a1 1 0 100-2H5z" />
                                    </svg>
                                    Simpan Tarif
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse text-sm">
                                    <thead>
                                        <tr class="bg-green-700 text-white">
                                            <th rowspan="2"
                                                class="px-5 py-3 font-bold border-r border-green-600 align-middle">
                                                Jenis Pengambilan</th>
                                            <th colspan="2"
                                                class="px-5 py-1.5 font-bold border-b border-green-600 text-center uppercase tracking-wider text-xs">
                                                Tarif (Dalam Rupiah)</th>
                                        </tr>
                                        <tr class="bg-green-700 text-white text-center">
                                            <th class="px-5 py-2 font-bold border-r border-green-600 w-1/4">WNA</th>
                                            <th class="px-5 py-2 font-bold w-1/4">WNI</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($tarifGroups['komersial']['rows'] as $row)
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="px-5 py-3 font-medium text-gray-700 border-r border-gray-50">
                                                    {{ $row['label'] }}
                                                </td>
                                                <td class="px-5 py-3 border-r border-gray-50">
                                                    <div class="flex items-center gap-2"
                                                        x-data="{ value: '{{ number_format($row['wna']->value, 0, ',', '.') }}' }">
                                                        <span
                                                            class="text-gray-400 text-xs font-semibold cursor-default">Rp</span>
                                                        <input type="text" name="settings[{{ $row['wna']->key }}]"
                                                            x-model="value"
                                                            @input="value = formatCurrency($event.target.value)"
                                                            class="w-full px-3 py-1.5 rounded-lg border-gray-200 focus:border-green-500 focus:ring-green-500 transition shadow-sm text-right text-sm">
                                                    </div>
                                                </td>
                                                <td class="px-5 py-3">
                                                    <div class="flex items-center gap-2"
                                                        x-data="{ value: '{{ number_format($row['wni']->value, 0, ',', '.') }}' }">
                                                        <span
                                                            class="text-gray-400 text-xs font-semibold cursor-default">Rp</span>
                                                        <input type="text" name="settings[{{ $row['wni']->key }}]"
                                                            x-model="value"
                                                            @input="value = formatCurrency($event.target.value)"
                                                            class="w-full px-3 py-1.5 rounded-lg border-gray-200 focus:border-green-500 focus:ring-green-500 transition shadow-sm text-right text-sm">
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

        </div>
    </div>
</x-admin-layout>