<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Ubah enum role dari 'admin/user' menjadi 'admin/anggota/petugas'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'anggota', 'petugas') DEFAULT 'anggota'");

        // Update data lama: 'user' → 'anggota'
        DB::table('users')->where('role', 'user')->update(['role' => 'anggota']);
    }

    public function down()
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'anggota', 'petugas') DEFAULT 'anggota'");
    }
};
