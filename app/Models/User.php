<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Pengajuan[] $pengajuans
 * @method \Illuminate\Database\Eloquent\Relations\HasMany pengajuans()
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'is_admin',   // ← DITAMBAH
    ];

    protected $casts = [
        'is_admin' => 'boolean', // ← DITAMBAH
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function pengajuans()
    {
        return $this->hasMany(\App\Models\Pengajuan::class);
    }
}
