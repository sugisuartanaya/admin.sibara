<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KategoriController;
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

Route::get('/dashboard', function(){
  return view('dashboard.index', [
      'active' => 'active',
      'title' => 'Dashboard',
  ]);
})->middleware('auth');

Route::get('/profile', [pegawaiController::class, 'myProfile']);

Route::resource('pegawai', PegawaiController::class)->middleware('checkAdmin');

Route::put('updateUser/{id}', [UserController::class, 'updateUser']);

Route::post('/admin/tambahPegawai', [AdminController::class, 'storePegawai']);
Route::get('/editpegawai/{nip}/edit', [AdminController::class, 'editPegawai']);
Route::put('/updatepegawai/{nip}', [AdminController::class, 'updatePegawai']);
Route::delete('/deletepegawai/{nip}', [AdminController::class, 'destroyPegawai']);

Route::resource('kategori', KategoriController::class);

Route::resource('barang-rampasan', BarangRampasanController::class);

Route::resource('izin', IzinController::class);

Route::resource('jadwal', JadwalController::class);
Route::get('/jadwal/{no_sprint}', [JadwalController::class, 'show']);



