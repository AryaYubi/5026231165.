<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLaporan = Pengaduan::count();
        $menungguVerifikasi = Pengaduan::where('status', 'verifikasi')->count();
        $sedangDiproses = Pengaduan::where('status', 'diproses')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();
        $laporanTerbaru = Pengaduan::orderBy('created_at', 'desc')->take(5)->get();


        // chart

        //Jenis Pengaduan
        $jenisData = Pengaduan::select('jenis_pengaduan', DB::raw('count(*) as total'))
                                ->groupBy('jenis_pengaduan')
                                ->get();

        $jenisLabels = $jenisData->pluck('jenis_pengaduan')->map(function ($jenis) {
            return ucfirst($jenis); // Membuat huruf pertama kapital
        });
        $jenisTotal = $jenisData->pluck('total');

        //  Status Laporan
        $statusData = Pengaduan::whereIn('status', ['verifikasi', 'diproses', 'selesai'])
                                ->select('status', DB::raw('count(*) as total'))
                                ->groupBy('status')
                                ->get();

        $statusLabels = $statusData->pluck('status')->map(function ($status) {
            return ucfirst($status);
        });
        $statusTotal = $statusData->pluck('total');
        return view('admin.dashboard', compact(
            'totalLaporan',
            'menungguVerifikasi',
            'sedangDiproses',
            'selesai',
            'laporanTerbaru',
            'jenisLabels',
            'jenisTotal',
            'statusLabels',
            'statusTotal'
        ));
    }
}
