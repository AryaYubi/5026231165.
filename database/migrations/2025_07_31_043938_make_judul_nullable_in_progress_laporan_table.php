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
            // Mengubah kolom 'judul' agar boleh kosong (nullable)
            $table->string('judul')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('progress_laporan', function (Blueprint $table) {
            // Mengembalikan kolom 'judul' menjadi tidak boleh kosong
            $table->string('judul')->nullable(false)->change();
        });
    }
};
