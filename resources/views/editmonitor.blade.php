@extends('template')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Data Monitor</h3>

    <a href="/monitor" class="btn btn-secondary mb-3">← Kembali</a>

    @foreach ($monitor as $m)
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="/monitor/update" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $m->ID }}">

                <div class="mb-3">
                    <label for="merkmonitor" class="form-label">Merk Monitor</label>
                    <input type="text" class="form-control" id="merkmonitor" name="merkmonitor" value="{{ $m->merkmonitor }}" required>
                </div>

                <div class="mb-3">
                    <label for="hargamonitor" class="form-label">Harga Monitor (Rp)</label>
                    <input type="number" class="form-control" id="hargamonitor" name="hargamonitor" value="{{ $m->hargamonitor }}" required>
                </div>

                <div class="mb-3">
                    <label for="tersedia" class="form-label">Tersedia</label>
                    <select class="form-select" id="tersedia" name="tersedia" required>
                        <option value="1" {{ $m->tersedia ? 'selected' : '' }}>Ya</option>
                        <option value="0" {{ !$m->tersedia ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="berat" class="form-label">Berat (kg)</label>
                    <input type="number" step="0.1" class="form-control" id="berat" name="berat" value="{{ $m->berat }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Data</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection
