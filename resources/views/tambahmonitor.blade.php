@extends('template')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Tambah Data Monitor</h3>

    <a href="/monitor" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="/monitor/store" method="post">
                {{ csrf_field() }}

                <div class="mb-3">
                    <label for="merkmonitor" class="form-label">Merk Monitor</label>
                    <input type="text" class="form-control" id="merkmonitor" name="merkmonitor" required>
                </div>

                <div class="mb-3">
                    <label for="hargamonitor" class="form-label">Harga Monitor (Rp)</label>
                    <input type="number" class="form-control" id="hargamonitor" name="hargamonitor" required>
                </div>

                <div class="mb-3">
                    <label for="tersedia" class="form-label">Tersedia</label>
                    <select class="form-select" id="tersedia" name="tersedia" required>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="berat" class="form-label">Berat (kg)</label>
                    <input type="number" step="0.1" class="form-control" id="berat" name="berat" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </form>
        </div>
    </div>
</div>
@endsection
