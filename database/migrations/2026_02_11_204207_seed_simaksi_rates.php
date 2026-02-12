<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $settings = [
            // Harga Penelitian WNI
            [
                'key' => 'harga_penelitian_wni_1bln',
                'value' => '100000',
                'label' => 'Tarif Penelitian WNI (< 1 Bulan)',
                'description' => 'Tarif per orang untuk penelitian WNI dengan durasi kurang dari 1 bulan.',
            ],
            [
                'key' => 'harga_penelitian_wni_1_6bln',
                'value' => '150000',
                'label' => 'Tarif Penelitian WNI (1-6 Bulan)',
                'description' => 'Tarif per orang untuk penelitian WNI dengan durasi 1 sampai 6 bulan.',
            ],
            [
                'key' => 'harga_penelitian_wni_7_12bln',
                'value' => '250000',
                'label' => 'Tarif Penelitian WNI (7-12 Bulan)',
                'description' => 'Tarif per orang untuk penelitian WNI dengan durasi 7 sampai 12 bulan.',
            ],
            [
                'key' => 'harga_sampel_wni',
                'value' => '50000',
                'label' => 'Tarif Pengambilan Sampel WNI',
                'description' => 'Tarif per orang untuk izin pengambilan sampel WNI.',
            ],
            // Harga Penelitian WNA
            [
                'key' => 'harga_penelitian_wna_1bln',
                'value' => '5000000',
                'label' => 'Tarif Penelitian WNA (< 1 Bulan)',
                'description' => 'Tarif per orang untuk penelitian WNA dengan durasi kurang dari 1 bulan.',
            ],
            [
                'key' => 'harga_penelitian_wna_1_6bln',
                'value' => '10000000',
                'label' => 'Tarif Penelitian WNA (1-6 Bulan)',
                'description' => 'Tarif per orang untuk penelitian WNA dengan durasi 1 sampai 6 bulan.',
            ],
            [
                'key' => 'harga_penelitian_wna_7_12bln',
                'value' => '15000000',
                'label' => 'Tarif Penelitian WNA (7-12 Bulan)',
                'description' => 'Tarif per orang untuk penelitian WNA dengan durasi 7 sampai 12 bulan.',
            ],
            [
                'key' => 'harga_sampel_wna',
                'value' => '500000',
                'label' => 'Tarif Pengambilan Sampel WNA',
                'description' => 'Tarif per orang untuk izin pengambilan sampel WNA.',
            ],
            // Harga Wisata Alam
            [
                'key' => 'harga_berkemah',
                'value' => '5000',
                'label' => 'Tarif Berkemah',
                'description' => 'Tarif per orang per hari untuk kegiatan berkemah (Rombongan Pelajar/Mahasiswa >= 10 orang).',
            ],
            [
                'key' => 'harga_mendaki',
                'value' => '20000',
                'label' => 'Tarif Mendaki Gunung',
                'description' => 'Tarif per orang per hari untuk kegiatan mendaki gunung (Hiking-Climbing) (Rombongan Pelajar/Mahasiswa >= 10 orang).',
            ],
            [
                'key' => 'harga_caving',
                'value' => '10000',
                'label' => 'Tarif Penelusuran Gua',
                'description' => 'Tarif per orang per hari untuk kegiatan penelusuran gua (Caving) (Rombongan Pelajar/Mahasiswa >= 10 orang).',
            ],
            // Komersial - Videografi
            [
                'key' => 'harga_komersial_video_iklan_wna',
                'value' => '20000000',
                'label' => 'Tarif Videografi Komersial (WNA)',
                'description' => 'Tarif per paket per lokasi untuk videografi iklan, film, dll (WNA).',
            ],
            [
                'key' => 'harga_komersial_video_iklan_wni',
                'value' => '10000000',
                'label' => 'Tarif Videografi Komersial (WNI)',
                'description' => 'Tarif per paket per lokasi untuk videografi iklan, film, dll (WNI).',
            ],
            // Komersial - Fotografi
            [
                'key' => 'harga_komersial_foto_wisata_wna',
                'value' => '5000000',
                'label' => 'Tarif Fotografi Komersial (WNA)',
                'description' => 'Tarif per paket per lokasi untuk fotografi paket wisata, majalah, dll (WNA).',
            ],
            [
                'key' => 'harga_komersial_foto_wisata_wni',
                'value' => '2000000',
                'label' => 'Tarif Fotografi Komersial (WNI)',
                'description' => 'Tarif per paket per lokasi untuk fotografi paket wisata, majalah, dll (WNI).',
            ],
            // Komersial - Prewedding
            [
                'key' => 'harga_komersial_prewedding_wna',
                'value' => '3000000',
                'label' => 'Tarif Prewedding (WNA)',
                'description' => 'Tarif per paket per lokasi untuk video dan foto prewedding (WNA).',
            ],
            [
                'key' => 'harga_komersial_prewedding_wni',
                'value' => '1000000',
                'label' => 'Tarif Prewedding (WNI)',
                'description' => 'Tarif per paket per lokasi untuk video dan foto prewedding (WNI).',
            ],
            // Komersial - Drone
            [
                'key' => 'harga_komersial_drone_wna',
                'value' => '2000000',
                'label' => 'Tarif Drone (WNA)',
                'description' => 'Tarif per paket per lokasi untuk penggunaan drone (WNA).',
            ],
            [
                'key' => 'harga_komersial_drone_wni',
                'value' => '2000000',
                'label' => 'Tarif Drone (WNI)',
                'description' => 'Tarif per paket per lokasi untuk penggunaan drone (WNI).',
            ],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $keys = [
            'harga_penelitian_wni_1bln',
            'harga_penelitian_wni_1_6bln',
            'harga_penelitian_wni_7_12bln',
            'harga_sampel_wni',
            'harga_penelitian_wna_1bln',
            'harga_penelitian_wna_1_6bln',
            'harga_penelitian_wna_7_12bln',
            'harga_sampel_wna',
            'harga_berkemah',
            'harga_mendaki',
            'harga_caving',
            'harga_komersial_video_iklan_wna',
            'harga_komersial_video_iklan_wni',
            'harga_komersial_foto_wisata_wna',
            'harga_komersial_foto_wisata_wni',
            'harga_komersial_prewedding_wna',
            'harga_komersial_prewedding_wni',
            'harga_komersial_drone_wna',
            'harga_komersial_drone_wni',
        ];

        \App\Models\Setting::whereIn('key', $keys)->delete();
    }
};
