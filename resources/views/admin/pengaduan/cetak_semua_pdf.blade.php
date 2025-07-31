<!DOCTYPE html>
<html>
<head>
    <title>Rekapitulasi Semua Laporan</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 10px; margin: 0; padding: 0; }
        .header-image {
            width: 300px;
            height: auto;
            margin-bottom: 20px;
        }
        .title-section {
            text-align: center;
            margin-bottom: 20px;
        }
        .title-section h3, .title-section p { margin: 0; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; word-wrap: break-word; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
        .badge {
            display: inline-block; padding: .35em .65em; font-size: .75em;
            font-weight: 700; line-height: 1; color: #fff; text-align: center;
            white-space: nowrap; vertical-align: baseline; border-radius: .25rem;
        }
        .bg-success { background-color: #198754 !important; }
        .bg-primary { background-color: #0d6efd !important; }
        .bg-warning { background-color: #ffc107 !important; color: #000 !important; }
    </style>
</head>
<body>
    <img src="{{ public_path('images/logoGalunggung.png') }}" alt="Header Laporan" class="header-image">

    <div class="title-section">
        <h3>REKAPITULASI LAPORAN PENGADUAN NASABAH</h3>
        <p>BANK GALUNGGUNG - Dicetak pada {{ $tanggal_cetak }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Pelapor</th>
                <th style="width: 20%;">Jenis Pengaduan</th>
                <th style="width: 20%;">Tanggal Laporan</th>
                <th style="width: 15%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($semua_laporan as $index => $laporan)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $laporan->nama_lengkap }}</td>
                <td>{{ ucfirst($laporan->jenis_pengaduan) }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($laporan->created_at)->timezone('Asia/Jakarta')->format('d-m-Y H:i') }}</td>
                <td class="text-center">
                    @php $status = strtolower(trim($laporan->status)); @endphp
                    @if($status == 'selesai')
                        <span class="badge bg-success">Selesai</span>
                    @elseif($status == 'diproses')
                        <span class="badge bg-primary">Diproses</span>
                    @else
                        <span class="badge bg-warning">Verifikasi</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data laporan yang ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
