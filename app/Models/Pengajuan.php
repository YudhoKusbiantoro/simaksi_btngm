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
}