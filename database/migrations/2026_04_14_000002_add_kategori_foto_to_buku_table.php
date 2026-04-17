<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('kelas_id');
            $table->string('foto')->nullable()->after('kategori');
        });
    }

    public function down(): void
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'foto']);
        });
    }
};
