<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimaksiApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_id',
        'nomor_surat',
        'kode_surat',
        'tanggal_terbit',
        'keterangan_surat_pengantar',
        'tarif_pnbp',
        'catatan_admin',
        'tembusan',
        'file_pdf',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
