<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis_kegiatan_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'kewarganegaraan',
        'status',
        'nama_pemohon',
        'identitas',
        'jabatan',
        'instansi',
        'nomor_hp',
        'tujuan',
        'lokasi',
        'catatan',
        'is_revisi_submitted',
        'zoom_link',
        'jadwal_presentasi',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function jenisKegiatan()
    {
        return $this->belongsTo(\App\Models\JenisKegiatan::class);
    }
    public function anggotas()
    {
        return $this->hasMany(PengajuanAnggota::class);
    }

    public function dokumens()
    {
        return $this->hasMany(PengajuanDokumen::class);
    }

    public function statusLogs()
    {
        return $this->hasMany(PengajuanStatusLog::class)->orderBy('created_at', 'asc');
    }

    public function approval()
    {
        return $this->hasOne(SimaksiApproval::class);
    }
}