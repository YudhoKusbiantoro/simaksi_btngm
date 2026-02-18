<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'kasubag_tu_nama',
                'value' => 'Endarmiyati, S. Si, M. Sc.',
                'label' => 'Nama Penandatangan A',
                'description' => 'Nama pejabat A yang akan muncul sebagai penandatangan di SIMAKSI.',
            ],
            [
                'key' => 'kasubag_tu_nip',
                'value' => '197510112002122002',
                'label' => 'NIP Penandatangan A',
                'description' => 'NIP pejabat A yang akan muncul sebagai penandatangan di SIMAKSI.',
            ],
            [
                'key' => 'kasubag_tu_jabatan',
                'value' => 'Kepala Sub Bagian TU',
                'label' => 'Jabatan Penandatangan A',
                'description' => 'Jabatan pejabat A yang akan muncul sebagai penandatangan di SIMAKSI.',
            ],
            [
                'key' => 'ttd_2_nama',
                'value' => '-',
                'label' => 'Nama Penandatangan B',
                'description' => 'Nama pejabat B yang akan muncul sebagai penandatangan di SIMAKSI.',
            ],
            [
                'key' => 'ttd_2_nip',
                'value' => '-',
                'label' => 'NIP Penandatangan B',
                'description' => 'NIP pejabat B yang akan muncul sebagai penandatangan di SIMAKSI.',
            ],
            [
                'key' => 'ttd_2_jabatan',
                'value' => '-',
                'label' => 'Jabatan Penandatangan B',
                'description' => 'Jabatan pejabat B yang akan muncul sebagai penandatangan di SIMAKSI.',
            ],
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
            [
                'key' => 'simaksi_ketentuan',
                'value' => "Sebelum memasuki lokasi Kawasan Taman Nasional Gunung Merapi wajib melapor kepada Petugas Resor Pengelolaan TN wilayah setempat;\nSelama memasuki kawasan TN Gunung Merapi, dapat didampingi petugas dari Balai TNGM;\nJika Kegiatan dilaksanakan di Radius 5 (lima) Kilometer dari Merapi, berkoordinasi dengan BPPTKG;\nSegala resiko yang terjadi and timbul menjadi tanggung jawab pemegang ijin;\nIjin ini tidak disalahgunakan untuk tujuan yang dapat mengganggu kestabilan Pemerintah;\nBersedia Mematuhi semua peraturan perundangan yang berlaku;\nWajib memberikan laporan hasil kegiatan, paling lambat 14 hari setelah kegiatan selesai;\nWajib menyerahkan laporan hasil penelitian / kegiatan ke tngm_jogja@yahoo.com;\nDokumentasi yang dipublikasikan wajib mencantumkan logo Kementerian Kehutanan / Balai TNGM;\nSimaksi ini berlaku setelah pemegang ijin membubuhkan tanda tangan di atas materai Rp. 10.000,-.",
                'label' => 'Ketentuan SIMAKSI',
                'description' => 'Daftar ketentuan yang akan muncul di dokumen SIMAKSI. Pisahkan setiap poin dengan baris baru (Enter).',
            ],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
