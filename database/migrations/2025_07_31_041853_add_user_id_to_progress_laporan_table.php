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
            // Membuat kolom foreign key ke tabel users
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null')->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('progress_laporan', function (Blueprint $table) {
            // Menghapus foreign key dan kolomnya
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
