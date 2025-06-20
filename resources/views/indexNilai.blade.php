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
        <h2 class="fw-bold text-primary"><i class="bi bi-people-fill me-2"></i>Nilai Kuliah</h2>
        <a href="/nilai/create" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle me-1"></i>Tambah Data
        </a>
    </div>

    {{-- Tabel --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nomor Induk Siswa</th>
                    <th>Nilai Angka</th>
                    <th>SKS</th>
                    <th>Nilai Huruf</th>
                    <th>Bobot</th>

                </tr>
            </thead>
            <tbody class="align-middle text-center">
                @foreach ($nilai as $k)
                <tr>
                    <td>{{ $k->ID }}</td>
                    <td>{{ $k->NomorIndukSiswa }}</td>
                    <td>{{ $k->NilaiAngka }}</td>
                    <td>{{ $k->SKS }}</td>
                    <td>{{ $k->NilaiHuruf }}</td>
                    <td>{{ $k->Bobot }}</td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $nilai->links() }}
    </div>

</div>

@endsection
