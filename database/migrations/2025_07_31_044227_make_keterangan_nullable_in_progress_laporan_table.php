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
        Schema::table('progress_laporan', function (Blueprint $table) {
            // Mengubah kolom 'keterangan' agar boleh kosong (nullable)
            $table->string('keterangan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('progress_laporan', function (Blueprint $table) {
            // Mengembalikan kolom 'keterangan' menjadi tidak boleh kosong
            $table->string('keterangan')->nullable(false)->change();
        });
    }
};
