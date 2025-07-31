@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<div class="row g-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h3>{{ $totalLaporan }}</h3>
                <p>Total Laporan</p>
                <i class="bi bi-folder h1 position-absolute bottom-0 end-0 p-3" style="opacity: 0.3;"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h3>{{ $menungguVerifikasi }}</h3>
                <p>Menunggu Verifikasi</p>
                 <i class="bi bi-hourglass-split h1 position-absolute bottom-0 end-0 p-3" style="opacity: 0.3;"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h3>{{ $sedangDiproses }}</h3>
                <p>Sedang Diproses</p>
                 <i class="bi bi-arrow-repeat h1 position-absolute bottom-0 end-0 p-3" style="opacity: 0.3;"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h3>{{ $selesai }}</h3>
                <p>Selesai</p>
                 <i class="bi bi-check2-circle h1 position-absolute bottom-0 end-0 p-3" style="opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Laporan Terbaru</h5>
        <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-primary btn-sm">
            Lihat Semua
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pelapor</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporanTerbaru as $index => $laporan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $laporan->nama_lengkap }}</td>
                        <td>{{ \Carbon\Carbon::parse($laporan->created_at)->translatedFormat('d M Y') }}</td>
                        <td>
                            @php $status = strtolower(trim($laporan->status)); @endphp
                            @if($status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @elseif($status == 'diproses')
                                <span class="badge bg-primary">Diproses</span>
                            @elseif($status == 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @else {{-- Default untuk 'verifikasi' --}}
                                <span class="badge bg-warning">Verifikasi</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.pengaduan.show', $laporan->id) }}" class="btn btn-outline-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada laporan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="row mt-4">
    {{-- Jenis Pengaduan --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Jenis Pengaduan
            </div>
            <div class="card-body">

                <div style="position: relative; height:350px">
                    <canvas id="jenisPengaduanChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Status Laporan --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Status Laporan
            </div>
            <div class="card-body">

                <div style="position: relative; height:350px">
                    <canvas id="statusLaporanChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Controller convert ke format js
    const jenisLabels = @json($jenisLabels);
    const jenisData = @json($jenisTotal);
    const statusLabels = @json($statusLabels);
    const statusData = @json($statusTotal);

    //  Jenis Pengaduan
    const ctxJenis = document.getElementById('jenisPengaduanChart');
    new Chart(ctxJenis, {
        type: 'pie',
        data: {
            labels: jenisLabels,
            datasets: [{
                label: 'Jumlah Laporan',
                data: jenisData,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        }
    });

    // Status Laporan
    const ctxStatus = document.getElementById('statusLaporanChart');
    new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: statusLabels,
            datasets: [{
                label: 'Jumlah Laporan',
                data: statusData,
                backgroundColor: [
                    'rgb(255, 205, 86)', // Kuning (Verifikasi)
                    'rgb(54, 162, 235)',  // Biru (Diproses)
                    'rgb(75, 192, 192)'   // Hijau (Selesai)
                ],
                hoverOffset: 4
            }]
        }
    });
</script>
@endpush

@endsection
