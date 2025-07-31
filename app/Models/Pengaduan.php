<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // 1. TAMBAHKAN INI

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

    /**
     * Scope untuk pencarian di beberapa kolom.
     */
    public function scopeSearch($query, $term)
    {
        // $term adalah kata kunci yang diketik di kotak pencarian
        $searchTerm = "%$term%";

        $query->where(function ($query) use ($searchTerm) {
            $query->where('nama_lengkap', 'like', $searchTerm)
                  ->orWhere('kode_pengaduan', 'like', $searchTerm)
                  ->orWhere('jenis_pengaduan', 'like', $searchTerm)
                  ->orWhere('status', 'like', $searchTerm)
                  // 2. UBAH LOGIKA PENCARIAN TANGGAL MENJADI SEPERTI INI
                  ->orWhere(DB::raw("DATE_FORMAT(created_at, '%d %b %Y')"), 'like', $searchTerm);
        });
    }
}
