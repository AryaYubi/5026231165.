<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressLaporan extends Model
{
    use HasFactory;

    protected $table = 'progress_laporan';

    protected $fillable = [
        'pengaduan_id',
        'judul',
        'keterangan',
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }
}
