<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'buku_id',
        'jumlah',
        'tgl_pinjam',           
        'tgl_kembali_rencana',  
        'tanggal_kembali',      
        'status',
    ];

    protected $casts = [
        'tgl_pinjam'          => 'date',
        'tgl_kembali_rencana' => 'date',
        'tanggal_kembali'     => 'date',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'peminjaman_id');
    }
}
