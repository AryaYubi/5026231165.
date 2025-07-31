<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PengaduanController extends Controller
{
    /**
     * Menampilkan daftar semua pengaduan (untuk admin).
     */
    public function index(Request $request)
    {
        // Mulai query
        $query = Pengaduan::query();

        // Jika ada input pencarian
        if ($request->has('cari') && $request->cari != '') {
            $query->where('nama_lengkap', 'like', '%' . $request->cari . '%');
        }

        // Urutkan berdasarkan yang terbaru, lalu paginasi
        $data = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('pengaduan.indexp', compact('data'));
    }

    /**
     * Menampilkan form untuk membuat pengaduan baru (untuk publik).
     */
    public function create()
    {
        return view('pengaduan.createp');
    }

    /**
     * Menyimpan pengaduan baru dari form publik.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
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
            $path = $request->file('file_pendukung')->store('public/files');
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

    /**
     * Menampilkan detail satu pengaduan.
     */
    public function show(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    /**
     * Menampilkan form untuk mengedit pengaduan.
     */
    public function edit(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.edit', compact('pengaduan'));
    }

    /**
     * Mengupdate data pengaduan (khususnya status oleh admin).
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

        return redirect()->route('admin.pengaduan.show', $pengaduan->id)->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Menghapus data pengaduan.
     */
    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();
        // Arahkan ke halaman 'semua laporan' setelah hapus
        return redirect()->route('admin.pengaduan.index')->with('success', 'Data berhasil dihapus.');
    }

    // --- Metode untuk Filtering Laporan ---

    public function showVerifikasi(Request $request)
    {
        $query = Pengaduan::where('status', 'verifikasi');

        if ($request->has('cari') && $request->cari != '') {
            $query->where('nama_lengkap', 'like', '%' . $request->cari . '%');
        }

        $data = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('pengaduan.indexp', compact('data'));
    }

    public function showDiproses(Request $request)
    {
        $query = Pengaduan::where('status', 'diproses');

        if ($request->has('cari') && $request->cari != '') {
            $query->where('nama_lengkap', 'like', '%' . $request->cari . '%');
        }

        $data = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('pengaduan.indexp', compact('data'));
    }

    public function showSelesai(Request $request)
    {
        $query = Pengaduan::where('status', 'selesai');

        if ($request->has('cari') && $request->cari != '') {
            $query->where('nama_lengkap', 'like', '%' . $request->cari . '%');
        }

        $data = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('pengaduan.indexp', compact('data'));
    }
}
