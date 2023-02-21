<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\BarangController;

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

Route::get('/', Authentication::class)->name('login')->middleware('guest');
Route::get('/register', [Authentication::class, 'register'])->name('register')->middleware('guest');
Route::post('/login', [Authentication::class, 'login'])->middleware('guest');
Route::post('/register', [Authentication::class, 'save'])->middleware('guest');
Route::post('/logout', [Authentication::class, 'logout'])->middleware('auth');

Route::get('/barang/laporan', [BarangController::class, 'laporan'])->middleware('auth');
Route::resource('/barang', BarangController::class)->middleware('auth');
Route::get('/barang/detail/{id}', [BarangController::class, 'detail'])->middleware('auth');
Route::get('/export/barang', [BarangController::class, 'exportExcel'])->middleware('auth');

Route::get('/dashboard',Dashboard::class)->middleware('auth');
