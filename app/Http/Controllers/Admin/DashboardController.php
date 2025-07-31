<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan; // Import model Pengaduan

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung statistik
        $totalLaporan = Pengaduan::count();
        $menungguVerifikasi = Pengaduan::where('status', 'verifikasi')->count();
        $sedangDiproses = Pengaduan::where('status', 'diproses')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();

        // Ambil 5 laporan terbaru
        $laporanTerbaru = Pengaduan::orderBy('created_at', 'desc')->take(5)->get();

        // Kirim semua data ke view
        return view('admin.dashboard', compact(
            'totalLaporan',
            'menungguVerifikasi',
            'sedangDiproses',
            'selesai',
            'laporanTerbaru'
        ));
    }
}
