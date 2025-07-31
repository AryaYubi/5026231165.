<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\ProgressLaporan;
use Illuminate\Http\Request;

class ProgressLaporanController extends Controller
{
    /**
     * Menyimpan progress baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,id',
            'judul' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        ProgressLaporan::create($request->all());

        return back()->with('success', 'Progress berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit progress.
     */
    public function edit(ProgressLaporan $progress)
    {
        return view('admin.progress.edit', compact('progress'));
    }

    /**
     * Mengupdate progress yang sudah ada.
     */
    public function update(Request $request, ProgressLaporan $progress)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        $progress->update($request->all());

        // Kembali ke halaman detail laporan induknya
        return redirect()->route('admin.pengaduan.show', $progress->pengaduan_id)->with('success', 'Progress berhasil diperbarui.');
    }

    /**
     * Menghapus progress.
     */
    public function destroy(ProgressLaporan $progress)
    {
        $progress->delete();
        return back()->with('success', 'Progress berhasil dihapus.');
    }
}
