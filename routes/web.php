<?php

use Illuminate\Support\Facades\Route;
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
