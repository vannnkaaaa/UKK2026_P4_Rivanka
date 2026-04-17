<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'judul',
        'isbn',
        'pengarang_id',
        'penerbit_id',
        'rak_id',
        'kategori',
        'stok',
        'tahun_terbit',
        'foto',
    ];

    public function pengarang()
    {
        return $this->belongsTo(Pengarang::class);
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class);
    }

    public function rak()
    {
        return $this->belongsTo(Rak::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
