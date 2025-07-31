@extends('layouts.admin')

@section('title', 'Semua Laporan')

@section('content')

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Semua Laporan</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Semua Laporan</h3>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0">Daftar Laporan</h5>
                </div>
                <div class="col-md-4">
                    <form action="{{ url()->current() }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="cari" class="form-control" placeholder="Cari nama pelapor..." value="{{ request('cari') }}">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Pelapor</th>
                            {{-- PERUBAHAN HEADER TABEL --}}
                            <th>Jenis Pengaduan</th>
                            <th>File Pendukung</th>
                            <th>Tanggal Laporan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $p)
                        <tr>
                            <td class="text-center">{{ $data->firstItem() + $index }}</td>
                            <td>{{ $p->nama_lengkap }}</td>

                            {{-- PERUBAHAN ISI KOLOM --}}
                            <td class="text-center">{{ ucfirst($p->jenis_pengaduan) }}</td>
                            <td class="text-center">
                                @if($p->file_pendukung)
                                    <a href="{{ Storage::url($p->file_pendukung) }}" target="_blank" class="btn btn-sm btn-secondary">
                                        <i class="bi bi-paperclip"></i> Lihat File
                                    </a>
                                @else
                                    -
                                @endif
                            </td>

                            <td class="text-center">{{ \Carbon\Carbon::parse($p->created_at)->translatedFormat('d M Y') }}</td>
                            <td class="text-center">
                                @php $status = strtolower(trim($p->status)); @endphp

                                @if($status == 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif($status == 'diproses')
                                    <span class="badge bg-primary">Diproses</span>
                                @else {{-- Default untuk 'verifikasi' --}}
                                    <span class="badge bg-warning">Verifikasi</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.pengaduan.show', $p->id) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data yang ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end">
                {{ $data->withQueryString()->links() }}
            </div>
        </div>
    </div>

@endsection
