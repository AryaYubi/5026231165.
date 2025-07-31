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
                <div class="col-md-auto">
                    <h5 class="mb-0">Daftar Laporan</h5>
                </div>
                <div class="col-md-auto">
                    <div class="d-flex align-items-center gap-2">
                        <!-- Tombol Tambah Laporan -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahLaporanModal">
                            <i class="bi bi-plus-circle"></i> Tambah
                        </button>

                        <!-- Tombol Cetak PDF -->
                        <a href="{{ route('admin.laporan.cetakSemua', array_merge(request()->query(), ['status' => $status ?? 'semua'])) }}" class="btn btn-danger" target="_blank">
                        <i class="bi bi-printer"></i> Cetak PDF
                            </a>



                        <!-- Form Filter tgl dan jenis -->
                        <form action="{{ url()->current() }}" method="GET" class="d-flex gap-2">

                                <label for="tanggal_mulai" class="form-label visually-hidden">Tanggal Mulai</label>
                                <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" value="{{ request('tanggal_mulai') }}" title="Tanggal Mulai">

                            <span>-</span>

                                <label for="tanggal_akhir" class="form-label visually-hidden">Tanggal Akhir</label>
                                <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir" value="{{ request('tanggal_akhir') }}" title="Tanggal Akhir">


                            <select name="jenis" id="jenis" class="form-select" style="width: 150px;">
                                <option value="">Semua Jenis</option>
                                <option value="tabungan" {{ request('jenis') == 'tabungan' ? 'selected' : '' }}>Tabungan</option>
                                <option value="deposito" {{ request('jenis') == 'deposito' ? 'selected' : '' }}>Deposito</option>
                                <option value="kredit" {{ request('jenis') == 'kredit' ? 'selected' : '' }}>Kredit</option>
                            </select>

                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="table-responsive">
                 <table class="table table-bordered table-striped align-middle">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Pelapor</th>
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
                            <td class="text-center">{{ \Carbon\Carbon::parse($p->created_at)->translatedFormat('d F Y H:i') }}</td>
                            <td class="text-center">
                                @php $status = strtolower(trim($p->status)); @endphp
                                @if($status == 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif($status == 'diproses')
                                    <span class="badge bg-primary">Diproses</span>
                                @else
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

@push('scripts')

{{-- MODAL UNTUK TAMBAH LAPORAN --}}
<div class="modal fade" id="tambahLaporanModal" tabindex="-1" aria-labelledby="tambahLaporanModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahLaporanModalLabel">Form Tambah Pengaduan Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        {{-- Form di dalam modal, dari pengaduan/create --}}
        <form action="{{ route('admin.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- hidden input --}}
                <input type="hidden" name="source" value="admin">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="2" required>{{ old('alamat') }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="no_ktp" class="form-label">No. KTP <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="no_hp" class="form-label">No. Handphone</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="jenis_pengaduan" class="form-label">Jenis Pengaduan <span class="text-danger">*</span></label>
                    <select class="form-select" id="jenis_pengaduan" name="jenis_pengaduan" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="tabungan" {{ old('jenis_pengaduan') == 'tabungan' ? 'selected' : '' }}>Tabungan</option>
                        <option value="deposito" {{ old('jenis_pengaduan') == 'deposito' ? 'selected' : '' }}>Deposito</option>
                        <option value="kredit" {{ old('jenis_pengaduan') == 'kredit' ? 'selected' : '' }}>Kredit</option>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="ringkasan_pengaduan" class="form-label">Ringkasan Pengaduan <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="ringkasan_pengaduan" name="ringkasan_pengaduan" rows="3" required>{{ old('ringkasan_pengaduan') }}</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="file_pendukung" class="form-label">File Pendukung (Opsional)</label>
                    <input class="form-control" type="file" id="file_pendukung" name="file_pendukung">
                    <small class="text-muted">Tipe file: JPG, PNG, PDF. Maksimal 2MB.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Kirim Pengaduan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>


@endpush
