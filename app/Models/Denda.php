<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    protected $table = 'denda';

    protected $fillable = [
        'pengembalian_id',
        'jumlah',
        'status_lunas',
    ];

    protected $casts = [
        'status_lunas' => 'boolean',
    ];

    public function pengembalian()
    {
        return $this->belongsTo(Pengembalian::class, 'pengembalian_id');
    }
}
