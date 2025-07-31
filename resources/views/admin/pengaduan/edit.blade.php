@extends('layouts.admin')
@section('title', 'Edit Laporan')

@section('content')
    <h3>Edit Laporan #{{ $pengaduan->kode_pengaduan }}</h3>
    <p class="text-muted">Perbarui status atau detail laporan di bawah ini.</p>

    <form action="{{ route('admin.pengaduan.update', $pengaduan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-8">
                {{-- Detail Laporan (Read-only) --}}
                <div class="card">
                    <div class="card-body">
                        <h5>Informasi Laporan</h5>
                        <p><strong>Pelapor:</strong> {{ $pengaduan->nama_lengkap }}</p>
                        <p><strong>Email:</strong> {{ $pengaduan->email }}</p>
                        <p><strong>Tanggal Laporan:</strong> {{ $pengaduan->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Update Status Laporan</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Laporan</label>
                            <select name="status" id="status" class="form-select">
                                <option value="verifikasi" {{ $pengaduan->status == 'verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                <option value="diproses" {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="ditolak" {{ $pengaduan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="4">{{ $pengaduan->keterangan }}</textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            {{-- INI BAGIAN YANG DIPERBAIKI --}}
                            <a href="{{ route('admin.pengaduan.show', $pengaduan->id) }}" class="btn btn-outline-secondary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
