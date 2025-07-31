<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('progress_laporan', function (Blueprint $table) {
            // Menambahkan kolom 'status' setelah kolom 'pengaduan_id'
            $table->string('status')->nullable()->after('pengaduan_id');
        });
    }


    public function down(): void
    {
        Schema::table('progress_laporan', function (Blueprint $table) {
            // Menghapus kolom 'status' jika migrasi di-rollback
            $table->dropColumn('status');
        });
    }
};
