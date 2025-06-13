<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PegawaiDBController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\KaryawanController;
//import java.io;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//System.out.println("Hello World");

Route::get('dosen', [DosenController::class, 'index']);

Route::get('welcome', [DosenController::class, 'welcome']);

// Route::get('/pegawai/{nama}', [PegawaiController::class, 'index']);
Route::get('/formulir', [PegawaiController::class, 'formulir']);
Route::post('/formulir/proses', [PegawaiController::class, 'proses']);


// route blog
Route::get('/blogs', [BlogController::class, 'home']);
Route::get('/blogs/tentang', [BlogController::class, 'tentang']);
Route::get('/blogs/kontak', [BlogController::class, 'kontak']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('halo', function () {
	return " <h1>Halo, Selamat datang di tutorial laravel www.malasngoding.com</h1>";
});

Route::get('blog', function () {
	return view('blog');
});

Route::get('pertemuan1', function () {
	return view('pertama');
});

Route::get('tugasvideoA', function () {
	return view('LatihanAnimation');
});

Route::get('tugasvideoB', function () {
	return view('LatihanCounter');
});

Route::get('Pertemuan4', function () {
	return view('LatihanSoalFix');
});

Route::get('ets', function () {
	return view('index');
});

Route::get('layout', function () {
	return view('LatihanSoalFix');
});

Route::get('bootstrap', function () {
	return view('bootstrap1');
});

Route::get('js', function () {
	return view('validasi1');
});

Route::get('linktree', function () {
	return view('tugaslinktreefix');
});

Route::get('frontend', function () {
	return view('frontend');
});


Route::get('danantara', function () {
	return view('indexdanan');
});


//route pegawaiDB
Route::get('/pegawai', [PegawaiDBController::class, 'indexDB']);
Route::get('/pegawai/tambah', [PegawaiDBController::class, 'tambah']);
Route::post('/pegawai/store', [PegawaiDBController::class, 'store']); //jika form dikirim, route ini akan dijalankan
Route::get('/pegawai/edit/{id}',[PegawaiDBController::class, 'edit']);
Route::post('/pegawai/update',[PegawaiDBController::class, 'update']);
Route::get('/pegawai/hapus/{id}', [PegawaiDBController::class, 'hapus']);
Route::get('/pegawai/cari', [PegawaiDBController::class, 'cari']);

Route::get('template', function () {
	return view('template');
});


Route::get('/monitor', [MonitorController::class, 'indexcrud']);
Route::get('/monitor/tambah', [MonitorController::class, 'tambah']);
Route::post('/monitor/store', [MonitorController::class, 'store']);
Route::get('/monitor/edit/{id}', [MonitorController::class, 'edit']);
Route::post('/monitor/update', [MonitorController::class, 'update']);
Route::get('/monitor/hapus/{id}', [MonitorController::class, 'hapus']);
Route::get('/monitor/cari', [MonitorController::class, 'cari']);




Route::get('/karyawan', [KaryawanController::class, 'index']);
Route::get('/karyawan/create', [KaryawanController::class, 'create']);
Route::post('/karyawan', [KaryawanController::class, 'store']);
Route::get('/karyawan/edit/{id}', [KaryawanController::class, 'edit']);
Route::post('/karyawan/update', [KaryawanController::class, 'update']);
Route::get('/karyawan/hapus/{id}', [KaryawanController::class, 'destroy']);
Route::get('/karyawan/cari', [KaryawanController::class, 'cari']);


use App\Http\Controllers\PageCounterController;

Route::get('/latihan1', [PageCounterController::class, 'index']);
