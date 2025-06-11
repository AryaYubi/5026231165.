<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonitorController extends Controller
{
    // Menampilkan semua data monitor
    public function indexcrud()
    {
        $monitor = DB::table('monitor')->paginate(10);
        return view('indexcrud', ['monitor' => $monitor]);
    }

    // Menampilkan form tambah monitor
    public function tambah()
    {
        return view('tambahmonitor');
    }

    // Menyimpan data monitor baru
    public function store(Request $request)
    {
        DB::table('monitor')->insert([
            'merkmonitor' => $request->merkmonitor,
            'hargamonitor' => $request->hargamonitor,
            'tersedia'     => $request->tersedia,
            'berat'        => $request->berat
        ]);
        return redirect('/monitor');
    }

    // Menampilkan form edit monitor
    public function edit($id)
    {
        $monitor = DB::table('monitor')
                    ->where('ID', $id)
                    ->get();
        return view('editmonitor', ['monitor' => $monitor]);
    }

    // Update data monitor
    public function update(Request $request)
    {
        DB::table('monitor')->where('ID', $request->id)->update([
            'merkmonitor' => $request->merkmonitor,
            'hargamonitor' => $request->hargamonitor,
            'tersedia'     => $request->tersedia,
            'berat'        => $request->berat
        ]);
        return redirect('/monitor');
    }

    // Hapus data monitor
    public function hapus($id)
    {
        DB::table('monitor')->where('ID', $id)->delete();
        return redirect('/monitor');
    }

    // Cari data monitor berdasarkan merk
    public function cari(Request $request)
    {
        $cari = $request->cari;

        $monitor = DB::table('monitor')
                    ->where('merkmonitor', 'like', "%" . $cari . "%")
                    ->paginate();

        return view('indexcrud', ['monitor' => $monitor]);
    }
}
