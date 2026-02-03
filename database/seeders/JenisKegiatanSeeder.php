<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisKegiatan;

class JenisKegiatanSeeder extends Seeder
{
    public function run()
    {
        $kegiatans = [
            'Penelitian & Pengembangan',
            'Ilmu Pengetahuan & Pendidikan',
            'Pembuatan Film Komersial',
            'Pembuatan Film Non-Komersial',
            'Pembuatan Film Dokumenter',
            'Ekspedisi',
            'Jurnalistik'
        ];

        foreach ($kegiatans as $nama) {
            JenisKegiatan::create(['nama' => $nama]);
        }
    }
}