<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pengaduan - {{ $pengaduan->kode_pengaduan }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; margin: 0; padding: 0; color: #333; }
        .header { margin-bottom: 25px; }
        .logo { width: 250px; height: auto; }
        .content { margin: 0 30px; }
        .content table { width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 12px; }
        .content th, .content td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .content th { background-color: #f2f2f2; font-weight: bold; }
        h3 { text-align: center; margin: 0; padding-bottom: 10px; border-bottom: 2px solid #000; }
        h4 { border-bottom: 1px solid #ccc; padding-bottom: 5px; margin-top: 25px; margin-bottom: 15px; font-size: 14px; }
        .table-no-border td, .table-no-border th { border: none !important; padding: 4px 8px 4px 0; background-color: transparent; vertical-align: top; }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logoGalunggung.png') }}" alt="Logo Bank" class="logo">
    </div>

    <h3>LAPORAN PENGADUAN NASABAH</h3>

    <div class="content">
        <h4>1. Detail Pengaduan</h4>
        <table class="table-no-border">
            <tr>
                <th width="30%">Kode Pengaduan</th>
                <td>: {{ $pengaduan->kode_pengaduan }}</td>
            </tr>
            <tr>
                <th>Nama Pelapor</th>
                <td>: {{ $pengaduan->nama_lengkap }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>: {{ $pengaduan->email }}</td>
            </tr>
             <tr>
                <th>No. KTP</th>
                <td>: {{ $pengaduan->no_ktp }}</td>
            </tr>
            <tr>
                <th>No. Handphone</th>
                <td>: {{ $pengaduan->no_hp ?? '-' }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>: {{ $pengaduan->alamat }}</td>
            </tr>
            <tr>
                <th>Jenis Pengaduan</th>
                <td>: {{ ucfirst($pengaduan->jenis_pengaduan) }}</td>
            </tr>
             <tr>
                <th>Tanggal Laporan</th>
                <td>: {{ \Carbon\Carbon::parse($pengaduan->created_at)->timezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }} WIB</td>
            </tr>
            <tr>
                <th>Ringkasan Masalah</th>
                <td>: {{ $pengaduan->ringkasan_pengaduan }}</td>
            </tr>
            <tr>
                <th>File Pendukung</th>
                <td>: @if($pengaduan->file_pendukung) Ada @else Tidak Ada @endif</td>
            </tr>
        </table>

        <h4>2. Status Penanganan</h4>
        <table class="table-no-border">
            <tr>
                <th width="30%">Status Terakhir</th>
                <td>: <strong>{{ strtoupper($pengaduan->status) }}</strong></td>
            </tr>
            <tr>
                <th>Keterangan Terakhir</th>
                <td>: {{ $pengaduan->keterangan ?? 'Belum ada keterangan.' }}</td>
            </tr>
        </table>

        <h4>3. Progress Laporan</h4>
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Judul Progress</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengaduan->progress as $progress)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($progress->created_at)->timezone('Asia/Jakarta')->translatedFormat('d M Y, H:i') }} WIB</td>
                    <td>{{ $progress->judul }}</td>
                    <td>{{ $progress->keterangan }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align:center;">Belum ada progress penanganan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
