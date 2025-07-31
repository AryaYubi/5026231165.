<?php

// use App\Http\Controllers\ProfileController;

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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// pengaduan nasabah




use Illuminate\Support\Facades\Route;
// Hapus 'use ProfileController' yang duplikat jika ada
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProgressLaporanController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;


// Halaman utama akan mengarahkan ke login.
Route::get('/', function () {
    return redirect()->route('login');
});

// Rute ini akan menentukan dashboard mana yang ditampilkan setelah login.
Route::get('/dashboard', function () {
    if (auth()->user()->role == 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('pengaduan.create');
})->middleware(['auth'])->name('dashboard');


// Rute yang membutuhkan login (untuk semua user terdaftar).
Route::middleware('auth')->group(function () {
    Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Grup Rute KHUSUS untuk Panel Admin.
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute untuk Laporan berdasarkan status
    Route::get('/laporan/verifikasi', [PengaduanController::class, 'showVerifikasi'])->name('laporan.verifikasi');
    Route::get('/laporan/diproses', [PengaduanController::class, 'showDiproses'])->name('laporan.diproses');
    Route::get('/laporan/selesai', [PengaduanController::class, 'showSelesai'])->name('laporan.selesai');

    // Rute untuk menyimpan progress laporan
    Route::resource('progress', ProgressLaporanController::class)->except(['index', 'show', 'create']);

    // Menggunakan Route::resource untuk semua aksi CRUD Pengaduan & User
    Route::resource('pengaduan', PengaduanController::class);
    Route::resource('users', UserController::class);




});
// autentikasi (login, logout, dll.)
require __DIR__.'/auth.php';

//cetak PDF laporan pengaduan
Route::get('/pengaduan/{id}/cetak', [PengaduanController::class, 'cetakPdf'])->name('admin.pengaduan.cetak');


Route::get('/laporan/cetak-semua', [PengaduanController::class, 'cetakSemuaLaporan'])->name('admin.laporan.cetakSemua');
