@extends('template')
@section('content')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Data Karyawan</h5>
        </div>
        <div class="card-body">
            <form action="/karyawan" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="kodepegawai" class="form-label">Kode Pegawai</label>
                    <input type="text" name="kodepegawai" class="form-control" maxlength="5" required>
                </div>

                <div class="mb-3">
                    <label for="namalengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" name="namalengkap" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="divisi" class="form-label">Divisi</label>
                    <input type="text" name="divisi" class="form-control" maxlength="5" required>
                </div>

                <div class="mb-3">
                    <label for="departemen" class="form-label">Departemen</label>
                    <input type="text" name="departemen" class="form-control" maxlength="10" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/karyawan" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
