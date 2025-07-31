@extends('layouts.admin')
@section('title', 'Detail Laporan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Detail Laporan</h3>
        <div>
            {{-- TOMBOL CETAK PDF BARU --}}
            <a href="{{ route('admin.pengaduan.cetak', $pengaduan->id) }}" class="btn btn-danger" target="_blank">
                <i class="bi bi-printer me-2"></i> Cetak PDF
            </a>

            <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        {{-- KOLOM KIRI: DETAIL LAPORAN --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <span>Laporan #{{ $pengaduan->kode_pengaduan }}</span>
                    <span class="badge bg-primary">{{ Str::ucfirst($pengaduan->status) }}</span>
                </div>
                <div class="card-body">
                    <small class="text-muted">Dilaporkan pada {{ $pengaduan->created_at->format('d F Y H:i') }}</small>
                    <hr>

                    <h5>Informasi Pelapor</h5>
                    <table class="table table-sm table-borderless">
                        <tr><td style="width: 150px;"><strong>Nama Pelapor</strong></td><td>: {{ $pengaduan->nama_lengkap }}</td></tr>
                        <tr><td><strong>Email</strong></td><td>: {{ $pengaduan->email }}</td></tr>
                        <tr><td><strong>Telepon</strong></td><td>: {{ $pengaduan->no_hp }}</td></tr>
                        <tr><td><strong>No KTP</strong></td><td>: {{ $pengaduan->no_ktp }}</td></tr>
                    </table>

                    <h5 class="mt-4">Detail Kejadian</h5>
                    <table class="table table-sm table-borderless">
                        <tr><td style="width: 150px;"><strong>Alamat</strong></td><td>: {{ $pengaduan->alamat }}</td></tr>
                        <tr><td><strong>Ringkasan</strong></td><td>: {{ $pengaduan->ringkasan_pengaduan }}</td></tr>
                        <tr>
                            <td><strong>File Pendukung</strong></td>
                            <td>:
                                @if($pengaduan->file_pendukung)

                                    <a href="{{ Illuminate\Support\Facades\Storage::url($pengaduan->file_pendukung) }}" target="_blank">Lihat File</a>
                                @else
                                    Tidak ada
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: STATUS & AKSI --}}
        <div class="col-md-4">

           <div id="status-display">
                <div class="card">
                    <div class="card-header">Status Penanganan</div>
                    <div class="card-body">
                        <p><strong>Status Terakhir:</strong> <span class="badge bg-primary">{{ Str::ucfirst($pengaduan->status) }}</span></p>
                        <p><strong>Keterangan Terakhir:</strong></p>
                        <p class="text-muted fst-italic">
                            @if($pengaduan->keterangan)
                                {{ $pengaduan->keterangan }}
                            @else
                                Belum ada keterangan yang ditambahkan.
                            @endif
                        </p>
                        <div class="d-grid">
                            <button id="btn-edit-status" class="btn btn-warning">Edit Laporan / Update Status</button>
                        </div>
                    </div>
                     @include('admin.pengaduan.partials.progress_section')
                </div>
            </div>

            <div id="status-edit-form" style="display: none;">
                <div class="card">
                    <div class="card-header">Update Status Laporan</div>
                    <div class="card-body">
                        <form action="{{ route('admin.pengaduan.update', $pengaduan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="status" class="form-label">Status Laporan</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="verifikasi" {{ $pengaduan->status == 'verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                    <option value="diproses" {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                    <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan Baru</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <button type="button" id="btn-cancel-edit" class="btn btn-secondary">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Ambil elemen-elemen yang dibutuhkan
    const statusDisplay = document.getElementById('status-display');
    const statusEditForm = document.getElementById('status-edit-form');
    const btnEditStatus = document.getElementById('btn-edit-status');
    const btnCancelEdit = document.getElementById('btn-cancel-edit');

    // Saat tombol 'Edit Laporan' diklik
    btnEditStatus.addEventListener('click', () => {
        statusDisplay.style.display = 'none'; // Sembunyikan tampilan status
        statusEditForm.style.display = 'block'; // Tampilkan form edit
    });

    // Saat tombol 'Batal' diklik
    btnCancelEdit.addEventListener('click', () => {
        statusDisplay.style.display = 'block'; // Tampilkan lagi tampilan status
        statusEditForm.style.display = 'none'; // Sembunyikan form edit
    });
</script>
@endpush
