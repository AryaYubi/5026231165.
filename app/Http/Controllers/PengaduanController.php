<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\ProgressLaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PDF;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::query();
        $query->filter($request->only(['tanggal_mulai', 'tanggal_akhir', 'jenis']));
        $data = $query->latest()->paginate(10);
        $status = 'semua';
        return view('pengaduan.indexp', compact('data', 'status'));
    }

    public function create()
    {
        return view('pengaduan.createp');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap'        => 'required|string|max:255',
            'email'               => 'required|email',
            'alamat'              => 'required|string',
            'no_ktp'              => 'required|string|size:16|unique:pengaduan,no_ktp',
            'no_hp'               => 'nullable|string|max:15',
            'jenis_pengaduan'     => 'required|in:tabungan,deposito,kredit',
            'ringkasan_pengaduan' => 'required|string',
            'file_pendukung'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('file_pendukung')) {
            $path = $request->file('file_pendukung')->store('files', 'public');
        }
        $tanggal = now()->format('Y-m-d');
        $nomorUrutTerakhir = Pengaduan::whereDate('created_at', today())->count();
        $nomorUrutBaru = $nomorUrutTerakhir + 1;
        $kodePengaduan = 'PENGADUAN_' . $tanggal . '_' . str_pad($nomorUrutBaru, 3, '0', STR_PAD_LEFT);
        Pengaduan::create([
            'kode_pengaduan'      => $kodePengaduan,
            'nama_lengkap'        => $request->nama_lengkap,
            'email'               => $request->email,
            'alamat'              => $request->alamat,
            'no_ktp'              => $request->no_ktp,
            'no_hp'               => $request->no_hp,
            'jenis_pengaduan'     => $request->jenis_pengaduan,
            'ringkasan_pengaduan' => $request->ringkasan_pengaduan,
            'file_pendukung'      => $path
        ]);
         if ($request->input('source') === 'admin') {
            return redirect()->route('admin.pengaduan.index')->with('success', 'Pengaduan baru telah berhasil ditambahkan!');
        } else {
            return redirect()->route('pengaduan.create')->with('success', 'Pengaduan Anda telah berhasil dikirim!');
        }
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function edit(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.edit', compact('pengaduan'));
    }


    /**
     * Mengupdate data pengaduan dan membuat catatan progress.
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status' => 'required|in:verifikasi,diproses,selesai',
            'keterangan' => 'nullable|string',
        ]);


        $pengaduan->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        \App\Models\ProgressLaporan::create([
            'pengaduan_id' => $pengaduan->id,
            'judul'        => 'Status: ' . ucfirst($request->status), // <-- PERUBAHAN DI SINI
            'keterangan'   => $request->keterangan,
            'user_id'      => auth()->id(),
        ]);

        return redirect()->route('admin.pengaduan.show', $pengaduan->id)->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();
        return redirect()->route('admin.pengaduan.index')->with('success', 'Data berhasil dihapus.');
    }

    public function showVerifikasi(Request $request)
    {
        $query = Pengaduan::where('status', 'verifikasi');
        $query->filter($request->only(['tanggal_mulai', 'tanggal_akhir', 'jenis']));
        $data = $query->latest()->paginate(10);
        $status = 'verifikasi'; // Menandakan halaman ini adalah 'verifikasi'
        return view('pengaduan.indexp', compact('data', 'status'));
    }

    public function showDiproses(Request $request)
    {
        $query = Pengaduan::where('status', 'diproses');
        $query->filter($request->only(['tanggal_mulai', 'tanggal_akhir', 'jenis']));
        $data = $query->latest()->paginate(10);
        $status = 'diproses'; // Menandakan halaman ini adalah 'diproses'
        return view('pengaduan.indexp', compact('data', 'status'));
    }

    public function showSelesai(Request $request)
    {
        $query = Pengaduan::where('status', 'selesai');
        $query->filter($request->only(['tanggal_mulai', 'tanggal_akhir', 'jenis']));
        $data = $query->latest()->paginate(10);
        $status = 'selesai'; // Menandakan halaman ini adalah 'selesai'
        return view('pengaduan.indexp', compact('data', 'status'));
    }

     public function cetakPdf($id)
    {
        $pengaduan = Pengaduan::with('progress')->findOrFail($id);
        $data = [
            'pengaduan' => $pengaduan
        ];
        $pdf = PDF::loadView('admin.pengaduan.cetak_pdf', $data);
        return $pdf->stream('laporan-pengaduan-'.$pengaduan->kode_pengaduan.'.pdf');
    }


public function cetakSemuaLaporan(Request $request){
    $query = \App\Models\Pengaduan::query();
    if ($request->has('status') && in_array($request->status, ['verifikasi', 'diproses', 'selesai'])) {
            $query->where('status', $request->status);
        }

        //  filter tanggal dan jenis
        $query->filter($request->only(['tanggal_mulai', 'tanggal_akhir', 'jenis']));

        $laporan = $query->latest()->get();

        $data = [
            'semua_laporan' => $laporan,
            'tanggal_cetak' => now()->timezone('Asia/Jakarta')->translatedFormat('d F Y')
        ];

        $pdf = \PDF::loadView('admin.pengaduan.cetak_semua_pdf', $data);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('rekapitulasi-laporan.pdf');
    }

}
