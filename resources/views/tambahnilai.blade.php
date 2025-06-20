@extends('template')
@section('content')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Data Nilai</h5>
        </div>
        <div class="card-body">
            <form action="/nilai" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="ID" class="form-label">ID</label>
                    <input type="text" name="ID" class="form-control" maxlength="5" required>
                </div>

                <div class="mb-3">
                    <label for="NomorIndukSiswa" class="form-label">Nomor Induk Siswa</label>
                    <input type="text" name="NomorIndukSiswa" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="NilaiAngka" class="form-label">Nilai Angka</label>
                    <input type="text" name="NilaiAngka" class="form-control" maxlength="5" required>
                </div>

                <div class="mb-3">
                    <label for="SKS" class="form-label">SKS</label>
                    <input type="text" name="SKS" class="form-control" maxlength="10" required>
                </div>


                <div class="d-flex justify-content-between">
                    <a href="/nilai" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
