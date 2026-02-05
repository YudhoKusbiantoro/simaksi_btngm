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
                'label' => 'Nama Kepala Sub Bagian TU',
                'description' => 'Nama pejabat yang akan muncul sebagai penandatangan di SIMAKSI.',
            ],
            [
                'key' => 'kasubag_tu_nip',
                'value' => '197510112002122002',
                'label' => 'NIP Kepala Sub Bagian TU',
                'description' => 'NIP pejabat yang akan muncul sebagai penandatangan di SIMAKSI.',
            ],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
