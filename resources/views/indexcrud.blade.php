@extends('template')
@section('content')

<div class="container mt-4">
    <h3 class="mb-4">Data Monitor</h3>

    <a href="/monitor/tambah" class="btn btn-success mb-3">+ Tambah Monitor Baru</a>

    <form action="/monitor/cari" method="GET" class="row g-2 mb-3">
        <div class="col-auto">
            <label for="cari" class="col-form-label">Cari Monitor:</label>
        </div>
        <div class="col-auto">
            <input type="text" name="cari" id="cari" placeholder="Masukkan merk monitor..." class="form-control">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">CARI</button>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Merk Monitor</th>
                <th>Harga</th>
                <th>Tersedia</th>
                <th>Berat (kg)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($monitor as $m)
                <tr>
                    <td>{{ $m->merkmonitor }}</td>
                    <td>Rp {{ number_format($m->hargamonitor, 0, ',', '.') }}</td>
                    <td>{{ $m->tersedia ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $m->berat }}</td>
                   <td>
    <a href="/monitor/edit/{{ $m->ID }}" class="btn btn-success btn-sm me-1">Edit</a> |
    <a href="/monitor/hapus/{{ $m->ID }}" class="btn btn-success btn-sm ms-1" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $monitor->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection
