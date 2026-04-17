<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $fillable = [
        'user_id',
        'nama',
        'nim',
        'email',
        'no_kartu',
        'alamat',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
