<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengaduan>
 */
class PengaduanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'kode_pengaduan' => 'PENGADUAN_' . now()->format('Y-m-d') . '_' . fake()->unique()->randomNumber(3),
        'nama_lengkap' => fake()->name(),
        'email' => fake()->unique()->safeEmail(),
        'alamat' => fake()->address(),
        'no_ktp' => fake()->unique()->numerify('################'),
        'no_hp' => fake()->phoneNumber(),
        'jenis_pengaduan' => fake()->randomElement(['tabungan', 'deposito', 'kredit']),
        'ringkasan_pengaduan' => fake()->paragraph(),
        'status' => fake()->randomElement(['verifikasi', 'diproses', 'selesai']),
        'created_at' => now(),
        'updated_at' => now(),
    ];
}
}
