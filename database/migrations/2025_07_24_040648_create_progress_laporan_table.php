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
    Schema::create('progress_laporan', function (Blueprint $table) {
        $table->id();
        // Kolom ini untuk menghubungkan ke tabel pengaduan
        $table->foreignId('pengaduan_id')->constrained('pengaduan')->onDelete('cascade');
        $table->string('judul');
        $table->text('keterangan');
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('progress_laporan');
    }
};
