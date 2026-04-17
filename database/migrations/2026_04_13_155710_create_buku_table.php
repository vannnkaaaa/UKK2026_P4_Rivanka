<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('isbn')->nullable();
            $table->integer('stok')->default(0);

            $table->foreignId('penerbit_id')->constrained('penerbit')->cascadeOnDelete();
            $table->foreignId('pengarang_id')->constrained('pengarang')->cascadeOnDelete();
            $table->foreignId('rak_id')->nullable()->constrained('rak')->nullOnDelete();
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->nullOnDelete();

            $table->year('tahun_terbit')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
