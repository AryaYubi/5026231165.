<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengaduan - BPR Artha Galunggung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="text-center text-primary mb-4">Edit Pengaduan Nasabah</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Perhatian!</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('pengaduan.update', $pengaduan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Email Nasabah</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email', $pengaduan->email) }}">
                </div>

                <div class="mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" required value="{{ old('nama_lengkap', $pengaduan->nama_lengkap) }}">
                </div>

                <div class="mb-3">
                    <label>Alamat Lengkap</label>
                    <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat', $pengaduan->alamat) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nomor KTP</label>
                        <input type="text" name="no_ktp" class="form-control" required value="{{ old('no_ktp', $pengaduan->no_ktp) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Nomor HP</label>
                        <input type="text" name="no_hp" class="form-control" required value="{{ old('no_hp', $pengaduan->no_hp) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Jenis Pengaduan</label>
                    <select name="jenis_pengaduan" class="form-select" required>
                        <option value="tabungan" {{ $pengaduan->jenis_pengaduan == 'tabungan' ? 'selected' : '' }}>Tabungan</option>
                        <option value="kredit" {{ $pengaduan->jenis_pengaduan == 'kredit' ? 'selected' : '' }}>Kredit</option>
                        <option value="deposito" {{ $pengaduan->jenis_pengaduan == 'deposito' ? 'selected' : '' }}>Deposito</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Ringkasan Pengaduan</label>
                    <textarea name="ringkasan_pengaduan" class="form-control" rows="4" required>{{ old('ringkasan_pengaduan', $pengaduan->ringkasan_pengaduan) }}</textarea>
                </div>

                <div class="mb-3">
                    <label>File Pendukung (jika ingin mengganti)</label>
                    <input type="file" name="file_pendukung" class="form-control">
                    @if($pengaduan->file_pendukung)
                        <small class="text-muted d-block mt-1">
                            File saat ini: <a href="{{ asset('storage/' . $pengaduan->file_pendukung) }}" target="_blank">Lihat File</a>
                        </small>
                    @endif
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">← Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
