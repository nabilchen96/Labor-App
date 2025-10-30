<?php

use Illuminate\Support\Facades\Route;

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


//STATISTIKPEMINJAMAN
Route::get('/statistik-status-peminjaman', 'App\Http\Controllers\StatistikPeminjamanController@statusPeminjaman')->name('statistik.status');
Route::get('/statistik-laboratorium-peminjaman', 'App\Http\Controllers\StatistikPeminjamanController@laboratoriumPeminjaman')->name('statistik.laboratorium');
Route::get('/statistik-harian-peminjaman', 'App\Http\Controllers\StatistikPeminjamanController@harianPeminjaman')->name('statistik.harian');
Route::get('/statistik-instruktur-peminjaman', 'App\Http\Controllers\StatistikPeminjamanController@instrukturPeminjaman')->name('statistik.instruktur');


//STATISTIKPENGGUNAANALAT
Route::get('/statistik-penggunaan-alat', 'App\Http\Controllers\StatistikPenggunaanAlatController@penggunaanAlat')->name('statistik.penggunaan.alat');
Route::get('/statistik-rata-penggunaan-alat', 'App\Http\Controllers\StatistikPenggunaanAlatController@rataAlat')->name('statistik.rata.alat');
Route::get('/statistik-kondisi-penggunaan-alat', 'App\Http\Controllers\StatistikPenggunaanAlatController@kondisiAlat')->name('statistik.kondisi.alat');
