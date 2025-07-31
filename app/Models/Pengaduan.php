<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    /**
     * Menentukan nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'pengaduan';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'nama_lengkap',
        'alamat',
        'no_ktp',
        'no_hp',
        'jenis_pengaduan',
        'ringkasan_pengaduan',
        'file_pendukung',
        'kode_pengaduan',
        'status',
        'keterangan',
    ];

    public function progress()
{
    return $this->hasMany(ProgressLaporan::class)->orderBy('created_at', 'desc');
}
}
