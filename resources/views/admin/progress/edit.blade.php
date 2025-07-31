@extends('layouts.admin')
@section('title', 'Edit Progress Laporan')

@section('content')
    <h3>Edit Progress Laporan</h3>
    <p class="text-muted">Untuk Laporan #{{ $progress->pengaduan->kode_pengaduan }}</p>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.progress.update', $progress->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Progress</label>
                    <input type="text" name="judul" id="judul" class="form-control" required value="{{ old('judul', $progress->judul) }}">
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan Progress</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" rows="4" required>{{ old('keterangan', $progress->keterangan) }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">+ Update Progress</button>
                <a href="{{ route('admin.pengaduan.show', $progress->pengaduan_id) }}" class="btn btn-secondary">Batal Edit</a>
            </form>
        </div>
    </div>
@endsection
