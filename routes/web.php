<?php

use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PrintPdfController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenawaranController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\HargaWajarController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\DaftarBarangController;
use App\Http\Controllers\BarangRampasanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
//Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/profile', [pegawaiController::class, 'myProfile'])->middleware('auth');

Route::put('updateUser/{id}', [UserController::class, 'updateUser'])->middleware('auth');
Route::group(['middleware' => 'checkAdmin'], function () {
  Route::resource('pegawai', PegawaiController::class)->middleware('auth');
  Route::post('/admin/tambahPegawai', [AdminController::class, 'storePegawai'])->middleware('auth');
  Route::get('/editpegawai/{nip}/edit', [AdminController::class, 'editPegawai'])->middleware('auth');
  Route::put('/updatepegawai/{id}', [AdminController::class, 'updatePegawai'])->middleware('auth');
  Route::delete('/deletepegawai/{nip}', [AdminController::class, 'destroyPegawai'])->middleware('auth');
  
  Route::resource('kategori', KategoriController::class)->middleware('auth');
});

Route::resource('barang-rampasan', BarangRampasanController::class)->middleware('auth');
Route::get('generate-qr/{id}', [BarangRampasanController::class, 'generateQR'])->name('qr');
Route::get('print-pdf/{id}', [BarangRampasanController::class, 'printPdf']);

Route::get('izin/create/{id}',[ IzinController::class, 'create'])->middleware('auth');
Route::post('izin/create/{id}',[ IzinController::class, 'store'])->middleware('auth');
Route::get('izin/{id}/edit',[ IzinController::class, 'edit'])->middleware('auth');
Route::put('izin/{no_sk}',[ IzinController::class, 'update'])->middleware('auth');
Route::delete('/deleteIzin/{id}', [IzinController::class, 'destroy'])->middleware('auth');

Route::get('harga-wajar/create/{id}',[ HargaWajarController::class, 'create'])->middleware('auth');
Route::post('harga-wajar/create/{id}',[ HargaWajarController::class, 'store'])->middleware('auth');
Route::get('harga-wajar/{id}/edit',[ HargaWajarController::class, 'edit'])->middleware('auth');
Route::put('harga-wajar/{no_laporan_penilaian}',[ HargaWajarController::class, 'update'])->middleware('auth');
Route::delete('deleteHarga/{id}',[ HargaWajarController::class, 'destroy'])->middleware('auth');

Route::resource('jadwal', JadwalController::class)->middleware('auth');
Route::get('/jadwal/{no_sprint}', [JadwalController::class, 'show'])->middleware('auth');

Route::get('jadwal/detail/{id}', [DaftarBarangController::class, 'show'])->middleware('auth');
Route::get('/jadwal/detail/create/{id}', [DaftarBarangController::class, 'create'])->middleware('auth');
Route::post('/jadwal/detail/create', [DaftarBarangController::class, 'store'])->middleware('auth');
Route::delete('daftar-barang/{id}', [DaftarBarangController::class, 'destroy'])->middleware('auth');

Route::get('pembeli', [PembeliController::class, 'index'])->middleware('auth');;
Route::delete('deletepembeli/{id}', [PembeliController::class, 'destroy'])->middleware('auth');

Route::get('pembeli/verifikasi/{username}', [VerifikasiController::class, 'show'])->middleware('auth');;
Route::put('pembeli/verifikasi/{id}/', [VerifikasiController::class, 'update'])->middleware('auth');;
Route::put('pembeli/verified/{id}/', [VerifikasiController::class, 'verified'])->middleware('auth');;
Route::put('pembeli/verifikasi-notelp/{id}/', [VerifikasiController::class, 'updateTelp'])->middleware('auth');;

Route::get('transaksi', [TransaksiController::class, 'index'])->middleware('auth');;

Route::get('penawaran/{id}', [PenawaranController::class, 'show'])->middleware('auth');;
Route::get('penawaran/{jadwalId}/showbidder/{barangId}', [PenawaranController::class, 'detail'])->name('detailPenawaran')->middleware('auth');;
Route::put('penawaran/{jadwalId}/{barangId}/{penawarID}', [PenawaranController::class, 'updateWinner'])->middleware('auth');;
Route::put('penawaran/{penawarID}', [PenawaranController::class, 'updateWanprestasi'])->middleware('auth');;

Route::get('pembayaran/{id}', [PembayaranController::class, 'show'])->middleware('auth');;
Route::put('pembayaran/verified/{id}', [PembayaranController::class, 'update'])->middleware('auth');;
Route::put('pembayaran/salah/{id}', [PembayaranController::class, 'updateSalah'])->middleware('auth');;

Route::get('report', [ReportController::class, 'index'])->middleware('auth');;
Route::get('report/{tahun}', [ReportController::class, 'filter'])->middleware('auth');;
Route::post('report/{tahun}/detail', [ReportController::class, 'filterByJadwal'])->middleware('auth');;

Route::post('cetak-kwitansi/{id}', [PrintPdfController::class, 'cetak_kwitansi'])->middleware('auth');;
Route::get('cetak-bukti/{id}', [PrintPdfController::class, 'cetak_bukti'])->middleware('auth');;
Route::get('batch-kwitansi/{pembeliID}/{jadwalID}', [PrintPdfController::class, 'batch_kwitansi'])->middleware('auth');;
Route::get('batch-bukti/{pembeliID}/{jadwalID}', [PrintPdfController::class, 'batch_bukti'])->middleware('auth');;

Route::get('/cetak-report/{id}', [PrintPdfController::class, 'cetak_report'])->middleware('auth');;

