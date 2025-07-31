<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengaduan;
use App\Models\ProgressLaporan; // <-- Tambahkan ini
use Illuminate\Support\Facades\Schema; // <-- Tambahkan ini

class PengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Matikan pengecekan foreign key
        Schema::disableForeignKeyConstraints();

        // 2. Kosongkan tabel anak terlebih dahulu, lalu tabel induk
        ProgressLaporan::truncate();
        Pengaduan::truncate();

        // 3. Nyalakan kembali pengecekan foreign key
        Schema::enableForeignKeyConstraints();

        // 4. Loop untuk membuat 10 data dummy baru
        for ($i = 1; $i <= 10; $i++) {
            $tanggal = now()->subDays(10 - $i)->format('Y-m-d');
            $nomorUrut = str_pad($i, 3, '0', STR_PAD_LEFT);

            Pengaduan::create([
                'kode_pengaduan'      => 'PENGADUAN_' . $tanggal . '_' . $nomorUrut,
                'nama_lengkap'        => 'Nasabah Tes ' . $i,
                'email'               => 'nasabah' . $i . '@example.com',
                'alamat'              => 'Jl. Uji Coba No. ' . $i,
                'no_ktp'              => '327801010101' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'no_hp'               => '08123456789' . $i,
                'jenis_pengaduan'     => ['tabungan', 'kredit', 'deposito'][array_rand(['tabungan', 'kredit', 'deposito'])],
                'ringkasan_pengaduan' => 'Ini adalah ringkasan untuk pengaduan dummy nomor ' . $i . '.',
                'status'              => ['verifikasi', 'diproses', 'selesai'][array_rand(['verifikasi', 'diproses', 'selesai'])],
            ]);
        }
    }
}
