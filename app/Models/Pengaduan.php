<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'email', 'nama_lengkap', 'alamat', 'no_ktp', 'no_hp',
        'jenis_pengaduan', 'ringkasan_pengaduan', 'file_pendukung',
        'kode_pengaduan', 'status', 'keterangan',
    ];

    public function progress()
    {
        return $this->hasMany(ProgressLaporan::class)->orderBy('created_at', 'desc');
    }


    public function scopeFilter($query, array $filters)
    {
        // Filter berdasarkan jenis pengaduan
        $query->when($filters['jenis'] ?? false, function ($query, $jenis) {
            return $query->where('jenis_pengaduan', $jenis);
        });

        // Filter berdasarkan tanggal mulai
        $query->when($filters['tanggal_mulai'] ?? false, function ($query, $tanggalMulai) {
            return $query->whereDate('created_at', '>=', $tanggalMulai);
        });

        // Filter berdasarkan tanggal akhir
        $query->when($filters['tanggal_akhir'] ?? false, function ($query, $tanggalAkhir) {
            return $query->whereDate('created_at', '<=', $tanggalAkhir);
        });
    }
}
