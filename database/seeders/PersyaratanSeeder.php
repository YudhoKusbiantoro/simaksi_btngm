<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Persyaratan;
use App\Models\JenisKegiatan;

class PersyaratanSeeder extends Seeder
{
    public function run()
    {
        // Ambil ID jenis kegiatan
        $penelitian = JenisKegiatan::where('nama', 'Penelitian & Pengembangan')->first();
        $ilmu = JenisKegiatan::where('nama', 'Ilmu Pengetahuan & Pendidikan')->first();
        $filmKomersial = JenisKegiatan::where('nama', 'Pembuatan Film Komersial')->first();
        $filmNonKomersial = JenisKegiatan::where('nama', 'Pembuatan Film Non-Komersial')->first();
        $filmDokumenter = JenisKegiatan::where('nama', 'Pembuatan Film Dokumenter')->first();
        $ekspedisi = JenisKegiatan::where('nama', 'Ekspedisi')->first();
        $jurnalistik = JenisKegiatan::where('nama', 'Jurnalistik')->first();

        // === WNI ===
        $this->tambahPersyaratan($penelitian->id, 'WNI', [
            'Proposal Kegiatan',
            'Fotokopi Tanda Pengenal (KTP/SIM)',
            'Surat Pernyataan Kesanggupan (Lampiran 1)',
            'Izin Penelitian dari Kemristekdikti',
            'Rekomendasi Mitra Kerja'
        ]);

        $this->tambahPersyaratan($ilmu->id, 'WNI', [
            'Proposal Kegiatan',
            'Fotokopi Tanda Pengenal (KTP/SIM)',
            'Surat Pernyataan Kesanggupan (Lampiran 1)',
            'Rekomendasi Mitra Kerja'
        ]);

        $this->tambahPersyaratan($filmKomersial->id, 'WNI', [
            'Proposal Kegiatan',
            'Fotokopi Tanda Pengenal (KTP/SIM)',
            'Surat Pernyataan Kesanggupan (Lampiran 1)',
            'Izin Produksi Film dari Kemenparekraf',
            'Sinopsis',
            'Daftar Peralatan',
            'Daftar Anggota Tim'
        ]);

        $this->tambahPersyaratan($filmNonKomersial->id, 'WNI', [
            'Proposal Kegiatan',
            'Fotokopi Tanda Pengenal (KTP/SIM)',
            'Surat Pernyataan Kesanggupan (Lampiran 1)',
            'Izin Produksi Film dari Kemenparekraf',
            'Sinopsis',
            'Daftar Peralatan',
            'Daftar Anggota Tim'
        ]);

        $this->tambahPersyaratan($filmDokumenter->id, 'WNI', [
            'Proposal Kegiatan',
            'Fotokopi Tanda Pengenal (KTP/SIM)',
            'Surat Pernyataan Kesanggupan (Lampiran 1)',
            'Izin Produksi Film dari Kemenparekraf',
            'Sinopsis',
            'Daftar Peralatan',
            'Daftar Anggota Tim'
        ]);

        $this->tambahPersyaratan($ekspedisi->id, 'WNI', [
            'Proposal Kegiatan',
            'Fotokopi Tanda Pengenal (KTP/SIM)',
            'Surat Pernyataan Kesanggupan (Lampiran 1)'
        ]);

        $this->tambahPersyaratan($jurnalistik->id, 'WNI', [
            'Proposal Kegiatan',
            'Fotokopi Tanda Pengenal (KTP/SIM)',
            'Surat Pernyataan Kesanggupan (Lampiran 1)',
            'Kartu Pers dari Lembaga Berwenang'
        ]);

        // === WNA ===
        $this->tambahPersyaratan($penelitian->id, 'WNA', [
            'Proposal Kegiatan',
            'Fotokopi Paspor',
            'Surat Pernyataan Kesanggupan (Lampiran 1)',
            'Izin Penelitian dari Kemristekdikti',
            'Surat Pemberitahuan dari Kemenlu',
            'Rekomendasi Mitra Kerja',
            'Surat Keterangan Jalan (Polisi)'
        ]);

        $this->tambahPersyaratan($ilmu->id, 'WNA', [
            'Proposal Kegiatan',
            'Fotokopi Paspor',
            'Surat Pernyataan Kesanggupan (Lampiran 1)',
            'Rekomendasi Mitra Kerja',
            'Surat Keterangan Jalan (Polisi)'
        ]);

        $this->tambahPersyaratan($filmKomersial->id, 'WNA', [
            'Proposal Kegiatan',
            'Fotokopi Paspor',
            'Surat Pernyataan Kesanggupan (Lampiran 1)',
            'Izin Produksi Film dari Kemenparekraf',
            'Sinopsis',
            'Daftar Peralatan',
            'Daftar Anggota Tim',
            'Surat Keterangan Jalan (Polisi)'
        ]);

        $this->tambahPersyaratan($filmNonKomersial->id, 'WNA', [
            'Proposal Kegiatan',
            'Fotokopi Paspor',
            'Surat Pernyataan Kesanggupan (Lampiran 1)',
            'Izin Produksi Film dari Kemenparekraf',
            'Sinopsis',
            'Daftar Peralatan',
            'Daftar Anggota Tim',
            'Surat Keterangan Jalan (Polisi)'
        ]);

        $this->tambahPersyaratan($filmDokumenter->id, 'WNA', [
            'Proposal Kegiatan',
            'Fotokopi Paspor',
            'Surat Pernyataan Kesanggupan (Lampiran 1)',
            'Izin Produksi Film dari Kemenparekraf',
            'Sinopsis',
            'Daftar Peralatan',
            'Daftar Anggota Tim',
            'Surat Keterangan Jalan (Polisi)'
        ]);

        $this->tambahPersyaratan($ekspedisi->id, 'WNA', [
            'Proposal Kegiatan',
            'Fotokopi Paspor',
            'Surat Pernyataan Kesanggupan (Lampiran 1)',
            'Surat Keterangan Jalan (Polisi)'
        ]);

        $this->tambahPersyaratan($jurnalistik->id, 'WNA', [
            'Proposal Kegiatan',
            'Fotokopi Paspor',
            'Surat Pernyataan Kesanggupan (Lampiran 1)',
            'Kartu Pers dari Lembaga Berwenang',
            'Surat Keterangan Jalan (Polisi)'
        ]);
    }

    private function tambahPersyaratan($jenisKegiatanId, $kewarganegaraan, $daftarDokumen)
    {
        foreach ($daftarDokumen as $dokumen) {
            Persyaratan::create([
                'jenis_kegiatan_id' => $jenisKegiatanId,
                'kewarganegaraan' => $kewarganegaraan,
                'nama_dokumen' => $dokumen
            ]);
        }
    }
}