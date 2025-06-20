<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    public function index()
    {
        $nilai = DB::table('Nilai')->paginate(10);
        $nilai = DB::table('Nilai')->get()->map(function ($item) {
           if ($item->NilaiAngka >= 85) {
                $item->Huruf = 'A';
            } elseif ($item->NilaiAngka >= 75) {
                $item->Huruf = 'B';
            } elseif ($item->NilaiAngka >= 65) {
                $item->Huruf = 'C';
            } elseif ($item->NilaiAngka >= 50) {
                $item->Huruf = 'D';
            } else {
                $item->Huruf = 'E';
            }
            $item->Bobot = $item->NilaiAngka * $item->SKS;
            return $item;
        });
        return view('indexnilai', ['nilai' => $nilai]);
    }

    public function create()
    {
        return view('tambahnilai');
    }

    public function store(Request $request)
    {

        DB::table('Nilai')->insert([
            'ID' => $request->ID,
            'NomorIndukSiswa' => $request->NomorIndukSiswa,
            'NilaiAngka' => $request->NilaiAngka,
            'SKS' => $request->SKS,

        ]);
        return redirect('/eas');
    }

}

