@extends('template')
@section('content')

    <div class="container-fluid px-5 py-4">
        <h4 class="fw-semibold mb-4">Latihan 1 - Page Counter</h4>

        <div class="alert alert-success px-4 py-3 mb-4 w-100" style="max-width: 100%;">
            Anda Pengunjung ke: {{ $jumlah }}
        </div>
    </div>

@endsection
