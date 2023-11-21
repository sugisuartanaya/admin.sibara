<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;


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
  return view('dashboard.index');
})->middleware('auth');

// Route::get('/pegawai', [PegawaiController::class, 'index']);
// Route::get('/create', [PegawaiController::class, 'create']);
Route::resource('pegawai', PegawaiController::class);

Route::post('/user/store', [UserController::class, 'store']);

