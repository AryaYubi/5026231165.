@extends('template')
@section('content')

<div class="container mt-4">

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold text-primary"><i class="bi bi-people-fill me-2"></i>Data Karyawan</h2>
        <a href="/karyawan/create" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Karyawan
        </a>
    </div>

    {{-- Tabel --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-dark text-center">
                <tr>
                    <th>Kode Pegawai</th>
                    <th>Nama Lengkap</th>
                    <th>Divisi</th>
                    <th>Departemen</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody class="align-middle text-center">
                @foreach ($data as $k)
                <tr>
                    <td>{{ $k->kodepegawai }}</td>
                    <td class="text-start">{{ strtoupper($k->namalengkap) }}</td>
                    <td><span class="badge bg-info text-dark">{{ $k->divisi }}</span></td>
                    <td class="text-lowercase">{{ $k->departemen }}</td>
                    <td>
                        <a href="/karyawan/hapus/{{ $k->kodepegawai }}"
                           class="btn btn-sm btn-outline-danger"
                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                            <i class="bi bi-trash-fill"></i> Hapus
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $data->links() }}
    </div>

</div>

@endsection
