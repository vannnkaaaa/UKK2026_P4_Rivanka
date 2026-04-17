<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'tingkat',
        'jurusan',
        'wali_kelas',
        'jumlah_siswa',
    ];

    public function anggota()
    {
        return $this->hasMany(\App\Models\User::class, 'kelas_id')->where('role', 'anggota');
    }
}
