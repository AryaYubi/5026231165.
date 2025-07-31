<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pengaduan - BPR Artha Galunggung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="text-center text-primary mb-4">Formulir Pengaduan Nasabah</h2>

    {{-- Tampilkan pesan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Perhatian!</strong> Terdapat kesalahan pada input:
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Tampilkan pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    {{-- Form Pengaduan --}}
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email Nasabah</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="contoh: nasabah@gmail.com" required value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" required value="{{ old('nama_lengkap') }}">
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat" id="alamat" class="form-control" rows="2" required>{{ old('alamat') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="no_ktp" class="form-label">Nomor KTP</label>
                        <input type="text" name="no_ktp" id="no_ktp" class="form-control" required value="{{ old('no_ktp') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="no_hp" class="form-label">Nomor HP</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control" required value="{{ old('no_hp') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="jenis_pengaduan" class="form-label">Jenis Pengaduan</label>
                    <select name="jenis_pengaduan" id="jenis_pengaduan" class="form-select" required>
                        <option value="">-- Pilih Jenis Pengaduan --</option>
                        <option value="tabungan" {{ old('jenis_pengaduan') == 'tabungan' ? 'selected' : '' }}>Tabungan</option>
                        <option value="kredit" {{ old('jenis_pengaduan') == 'kredit' ? 'selected' : '' }}>Kredit</option>
                        <option value="deposito" {{ old('jenis_pengaduan') == 'deposito' ? 'selected' : '' }}>Deposito</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="ringkasan_pengaduan" class="form-label">Ringkasan Pengaduan</label>
                    <textarea name="ringkasan_pengaduan" id="ringkasan_pengaduan" class="form-control" rows="4" required>{{ old('ringkasan_pengaduan') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="file_pendukung" class="form-label">Upload File Pendukung (opsional)</label>
                    <input type="file" name="file_pendukung" id="file_pendukung" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Kirim Pengaduan</button>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>
