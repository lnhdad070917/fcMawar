<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiPembayaranController;

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

// Route::get('/', function () {
//     return view('app');
// });


Route::get('/', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');
Route::get('/barangs/{id}', [BarangController::class, 'show']);

Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
Route::get('/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
Route::get('/supplier/{supplier}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
Route::put('/supplier/{supplier}', [SupplierController::class, 'update'])->name('supplier.update');
Route::delete('/supplier/{supplier}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

Route::get('/transaksi', [TransaksiPembayaranController::class, 'index'])->name('transaksi.index');
Route::get('/transaksi/create', [TransaksiPembayaranController::class, 'create'])->name('transaksi.create');
Route::post('/transaksi', [TransaksiPembayaranController::class, 'store'])->name('transaksi.store');
Route::get('/transaksi/{transaksi}/edit', [TransaksiPembayaranController::class, 'edit'])->name('transaksi.edit');
Route::put('/transaksi/{transaksi}', [TransaksiPembayaranController::class, 'update'])->name('transaksi.update');
Route::delete('/transaksi/{transaksi}', [TransaksiPembayaranController::class, 'destroy'])->name('transaksi.destroy');
Route::get('/transaksi/{transaksi_id}/pembayaran', [TransaksiPembayaranController::class, 'createPembayaran'])->name('transaksi.createPembayaran');
Route::post('/transaksi/pembayaran', [TransaksiPembayaranController::class, 'storePembayaran'])->name('transaksi.storePembayaran');