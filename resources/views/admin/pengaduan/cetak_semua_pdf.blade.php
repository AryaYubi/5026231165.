<!DOCTYPE html>
<html>
<head>
    <title>Rekapitulasi Semua Laporan</title>
    <style>
      @page {
            margin-top: 130px;    /* Top margin */
            margin-right: 30px;  /* Right margin */
            margin-bottom: 50px; /* Bottom margin */
            margin-left: 30px;   /* Left margin */
        }

        body { font-family: 'Helvetica', sans-serif; font-size: 12px; }

        header {
            position: fixed;
            top: -120px;
            left: 0;
            right: 0;
            height: 80px;
        }
        .header-image {
            width: 300px;
            height: auto;

        }
        .title-section {
            text-align: center;
            margin-top: 10px;
        }

        .title-section h1, .title-section p { margin: 0; }

        footer {
            position: fixed;
            bottom: -30px;
            left: 0;
            right: 0;
            height: 20px;
            text-align: center;
            font-size: 9px;
        }
        .pagenum:before {
            content: counter(page);
        }

        table { width: 100%; border-collapse: collapse;}
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; word-wrap: break-word; }
        th { background-color: #f2f2f2; }

        thead { display: table-header-group; }
        tbody { display: table-row-group; }
        tr { page-break-inside: avoid; }

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
    <!-- Header Tetap -->
    <header>
        <img src="{{ public_path('images/logoarthabaru.png') }}" alt="Header Laporan" class="header-image">
        <div class="title-section">
            <h3>REKAPITULASI LAPORAN PENGADUAN NASABAH</h3>
            <p>BANK GALUNGGUNG - Dicetak pada {{ $tanggal_cetak }}</p>
        </div>
    </header>

    <!-- Footer Tetap -->
    <footer>
        Halaman <span class="pagenum"></span>
    </footer>

    <!-- Konten Utama (Tabel) -->
    <main>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 20%;">Pelapor</th>
                    <th style="width: 15%;">Jenis Pengaduan</th>
                    <th style="width: 20%;">Tanggal Laporan</th>
                    <th style="width: 15%;">File Pendukung</th>
                    <th style="width: 10%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($semua_laporan as $index => $laporan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ Illuminate\Support\Str::title($laporan->nama_lengkap) }}</td>
                    <td>{{ ucfirst($laporan->jenis_pengaduan) }}</td>
                    <td>{{ \Carbon\Carbon::parse($laporan->created_at)->timezone('Asia/Jakarta')->locale('id_ID')->isoFormat('DD MMMM YYYY HH:mm') }}</td>
                    <td>
                        @if($laporan->file_pendukung)
                            Ada
                        @else
                            Tidak Ada
                        @endif
                    </td>
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
                    <td colspan="6" class="text-center">Tidak ada data laporan yang ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </main>
</body>
</html>
