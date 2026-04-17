<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Denda;

class Pengembalian extends Model
{
    protected $table = 'pengembalian';

    protected $fillable = ['peminjaman_id', 'tanggal_kembali', 'status'];

    protected $casts = [
        'tgl_kembali_aktual' => 'date',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function denda()
    {
        return $this->hasOne(Denda::class, 'pengembalian_id');
    }
}
