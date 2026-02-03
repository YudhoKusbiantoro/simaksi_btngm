<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanStatusLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_id',
        'status',
        'catatan',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
