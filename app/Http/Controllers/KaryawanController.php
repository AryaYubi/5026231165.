<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index()
    {
        $data = DB::table('karyawan')->paginate(10);
        return view('indexkaryawan', ['data' => $data]);
    }

    public function create()
    {
        return view('tambahkaryawan');
    }

    public function store(Request $request)
    {
        DB::table('karyawan')->insert([
            'kodepegawai' => $request->kodepegawai,
            'namalengkap' => strtoupper($request->namalengkap),
            'divisi' => $request->divisi,
            'departemen' => strtolower($request->departemen)
        ]);


        return redirect('/karyawan');
    }

    public function destroy($id)
    {
        DB::table('karyawan')->where('kodepegawai', $id)->delete();
        return redirect('/karyawan');
    }

    public function edit($id)
    {
        $data = DB::table('karyawan')->where('kodepegawai', $id)->first();
        return view('editkaryawan', ['data' => $data]);
    }

    public function update(Request $request)
    {
        DB::table('karyawan')->where('kodepegawai', $request->kodepegawai)->update([
            'namalengkap' => strtoupper($request->namalengkap),
            'divisi' => $request->divisi,
            'departemen' => strtolower($request->departemen)
        ]);

        return redirect('/karyawan');
    }

    public function cari(Request $request)
    {
        $cari = $request->cari;
        $data = DB::table('karyawan')
            ->where('namalengkap', 'like', '%' . $cari . '%')
            ->paginate(10);

        return view('indexkaryawan', ['data' => $data]);
    }
}
