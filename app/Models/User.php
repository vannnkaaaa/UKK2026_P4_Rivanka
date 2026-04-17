<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'nis',
        'email',
        'password',
        'role',
        'no_kartu',
        'alamat',
        'status_aktif',
        'kelas_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'status_aktif'      => 'boolean',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'user_id');
    }

    public function anggota()
    {
        return $this->hasOne(Anggota::class, 'user_id');
    }

    public function kelas()
    {
        return $this->belongsTo(\App\Models\Kelas::class, 'kelas_id');
    }
}
