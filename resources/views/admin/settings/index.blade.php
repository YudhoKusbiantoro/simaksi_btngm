<x-admin-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-green-900">Pengaturan Administrasi</h2>
        <p class="text-gray-500">Sesuaikan informasi pejabat dan data pendukung SIMAKSI</p>
    </div>

    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <div class="p-6 space-y-8">
                    @foreach($settings as $setting)
                        <div
                            class="flex flex-col md:flex-row gap-4 md:gap-10 border-b border-gray-50 pb-8 last:border-0 last:pb-0">
                            <div class="md:w-1/3">
                                <label class="block font-bold text-gray-700 mb-1">
                                    {{ $setting->label }}
                                </label>
                                <p class="text-xs text-gray-500 leading-relaxed">
                                    {{ $setting->description }}
                                </p>
                            </div>
                            <div class="md:w-2/3">
                                <input type="text" name="settings[{{ $setting->key }}]"
                                    value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                    class="w-full px-4 py-2 rounded-xl border-gray-200 focus:border-green-500 focus:ring-green-500 transition shadow-sm">

                                <p class="mt-1 text-[10px] text-gray-400 font-mono">Key: {{ $setting->key }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2.5 px-8 rounded-xl shadow-lg border-b-4 border-green-800 active:border-b-0 active:translate-y-1 transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>