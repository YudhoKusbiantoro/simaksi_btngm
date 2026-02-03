<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\JenisKegiatan;

class SuratController extends Controller
{
    public function download($jenisKegiatanId)
{
    $jenis = \App\Models\JenisKegiatan::find($jenisKegiatanId);

    if (!$jenis) {
        abort(404);
    }

    $fileMap = [
        'penelitian' => 'surat_pernyataan_penelitian.docx',
        'film_jurnalistik' => 'surat_pernyataan_film_jurnalistik.docx',
        'ekspedisi' => 'surat_pernyataan_ekspedisi.docx',
    ];

    $filename = $fileMap[$jenis->template_surat] ?? 'surat_pernyataan_penelitian.docx';
    $path = public_path("templates/{$filename}");

    if (!file_exists($path)) {
        abort(404);
    }

    // Baca file secara manual & kirim sebagai binary
    $content = file_get_contents($path);
    $headers = [
        'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        'Content-Length' => strlen($content),
    ];

    return response($content, 200, $headers);
}
}