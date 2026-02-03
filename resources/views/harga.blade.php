<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Harga Tiket & Layanan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">

            <!-- Tombol Kembali -->
            <div>
                <a href="{{ route('home') }}"
                    class="inline-flex items-center px-4 py-2 bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-800 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                    &larr; Kembali
                </a>
            </div>

            <!-- Kegiatan Wisata Alam -->
            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Kegiatan Wisata Alam</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300 text-sm text-center">
                        <thead>
                            <tr class="bg-green-800 text-white">
                                <th class="py-4 px-4 border border-gray-400 w-1/3">Jenis Kegiatan</th>
                                <th class="py-4 px-4 border border-gray-400 w-1/3">Satuan</th>
                                <th class="py-4 px-4 border border-gray-400 w-1/3">
                                    Rombongan<br>Pelajar/Mahasiswa<br>(≥10 orang)</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 font-medium">
                            <!-- Berkemah -->
                            <tr class="bg-gray-200">
                                <td class="py-3 px-4 border border-gray-300 font-bold">Berkemah</td>
                                <td class="py-3 px-4 border border-gray-300">per orang per hari</td>
                                <td class="py-3 px-4 border border-gray-300">Rp5.000</td>
                            </tr>
                            <!-- Mendaki Gunung -->
                            <tr class="bg-green-100"> <!-- Light Green -->
                                <td class="py-3 px-4 border border-gray-300 font-bold">
                                    Mendaki Gunung<br>
                                    <span class="font-normal text-xs">(Hiking-Climbing)</span>
                                </td>
                                <td class="py-3 px-4 border border-gray-300">per orang per hari</td>
                                <td class="py-3 px-4 border border-gray-300">Rp20.000</td>
                            </tr>
                            <!-- Penelusuran Gua -->
                            <tr class="bg-green-100">
                                <td class="py-3 px-4 border border-gray-300 font-bold">
                                    Penelusuran Gua (Caving)
                                </td>
                                <td class="py-3 px-4 border border-gray-300">per orang per hari</td>
                                <td class="py-3 px-4 border border-gray-300">Rp10.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Penelitian di Kawasan -->
            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Penelitian di Kawasan</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300 text-sm text-center">
                        <thead>
                            <tr class="bg-green-800 text-white">
                                <th rowspan="2" class="py-4 px-4 border border-gray-400 w-1/3 align-middle">Jenis
                                    Kegiatan</th>
                                <th colspan="2" class="py-2 px-4 border border-gray-400">Tarif (Per Orang)</th>
                            </tr>
                            <tr class="bg-green-700 text-white"> <!-- Lighter green for subheader -->
                                <th class="py-2 px-4 border border-gray-400 w-1/3">WNA</th>
                                <th class="py-2 px-4 border border-gray-400 w-1/3">WNI</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 font-medium bg-white">
                            <tr class="bg-gray-100">
                                <td class="py-4 px-4 border border-gray-300 font-bold text-left pl-8">Penelitian <1
                                        Bulan</td>
                                <td class="py-4 px-4 border border-gray-300">Rp5.000.000</td>
                                <td class="py-4 px-4 border border-gray-300">Rp100.000</td>
                            </tr>
                            <tr>
                                <td class="py-4 px-4 border border-gray-300 font-bold text-left pl-8">Penelitian 1-6
                                    Bulan</td>
                                <td class="py-4 px-4 border border-gray-300">Rp10.000.000</td>
                                <td class="py-4 px-4 border border-gray-300">Rp150.000</td>
                            </tr>
                            <tr class="bg-gray-100">
                                <td class="py-4 px-4 border border-gray-300 font-bold text-left pl-8">Penelitian 7-12
                                    Bulan</td>
                                <td class="py-4 px-4 border border-gray-300">Rp15.000.000</td>
                                <td class="py-4 px-4 border border-gray-300">Rp250.000</td>
                            </tr>
                            <tr>
                                <td class="py-4 px-4 border border-gray-300 font-bold text-left pl-8">Izin Pengambilan
                                    Sampel</td>
                                <td class="py-4 px-4 border border-gray-300">Rp500.000</td>
                                <td class="py-4 px-4 border border-gray-300">Rp50.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pengambilan gambar Komersial -->
            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Pengambilan gambar Komersial</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300 text-sm text-center">
                        <thead>
                            <tr class="bg-green-800 text-white">
                                <th rowspan="2" class="py-4 px-4 border border-gray-400 w-1/3 align-middle">Jenis
                                    Pengambilan</th>
                                <th colspan="2" class="py-2 px-4 border border-gray-400">Tarif (Per Paket per Lokasi)
                                </th>
                            </tr>
                            <tr class="bg-green-700 text-white">
                                <th class="py-2 px-4 border border-gray-400 w-1/3">WNA</th>
                                <th class="py-2 px-4 border border-gray-400 w-1/3">WNI</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 font-medium bg-white">
                            <!-- Video Iklan etc -->
                            <tr class="bg-white">
                                <td class="py-4 px-6 border border-gray-300 text-left align-top">
                                    <ul class="list-disc pl-4 space-y-1 font-bold">
                                        <li>Videografi yang Dipergunakan untuk Iklan Produk</li>
                                        <li>Iklan Jasa</li>
                                        <li>Video Clip</li>
                                        <li>Film</li>
                                        <li>Drama</li>
                                        <li>Sinetron</li>
                                        <li>FTV</li>
                                        <li>Web Drama</li>
                                        <li>Reality Show dan Sejenisnya</li>
                                    </ul>
                                </td>
                                <td class="py-4 px-4 border border-gray-300 align-middle">Rp20.000.000</td>
                                <td class="py-4 px-4 border border-gray-300 align-middle">Rp10.000.000</td>
                            </tr>
                            <!-- Foto Paket Wisata etc -->
                            <tr class="bg-gray-100">
                                <td class="py-4 px-6 border border-gray-300 text-left align-top">
                                    <ul class="list-disc pl-4 space-y-1 font-bold">
                                        <li>Fotografi yang Dipergunakan untuk Paket Wisata</li>
                                        <li>Majalah</li>
                                        <li>Iklan Produk</li>
                                        <li>Iklan Jasa dan Sejenisnya</li>
                                    </ul>
                                </td>
                                <td class="py-4 px-4 border border-gray-300 align-middle">Rp5.000.000</td>
                                <td class="py-4 px-4 border border-gray-300 align-middle">Rp2.000.000</td>
                            </tr>
                            <!-- Prewedding -->
                            <tr class="bg-white">
                                <td
                                    class="py-4 px-6 border border-gray-300 text-left font-bold pl-10 flex items-center gap-2">
                                    <span class="text-black">•</span> Video dan Foto Prewedding
                                </td>
                                <td class="py-4 px-4 border border-gray-300 align-middle">Rp3.000.000</td>
                                <td class="py-4 px-4 border border-gray-300 align-middle">Rp1.000.000</td>
                            </tr>
                            <!-- Drone -->
                            <tr class="bg-gray-100">
                                <td
                                    class="py-4 px-6 border border-gray-300 text-left font-bold pl-10 flex items-center gap-2">
                                    <span class="text-black">•</span> Drone
                                </td>
                                <td class="py-4 px-4 border border-gray-300 align-middle">Rp2.000.000</td>
                                <td class="py-4 px-4 border border-gray-300 align-middle">Rp2.000.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>