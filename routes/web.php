<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\DetailPembelianController;
use App\Http\Controllers\PenjualanController;


// Rute untuk login dan register
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    // Rute dashboard dengan redireksi berdasarkan role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'kasir') {
            return redirect()->route('kasir.dashboard');
        } elseif ($user->role === 'pemilik') {
            return redirect()->route('pemilik.dashboard');
        }
        return abort(403, 'Unauthorized');
    })->name('dashboard');

    // Logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rute khusus berdasarkan role dengan middleware
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    });

    Route::middleware(['role:kasir'])->group(function () {
        Route::get('/kasir/dashboard', [DashboardController::class, 'kasir'])->name('kasir.dashboard');
    });

    Route::middleware(['role:pemilik'])->group(function () {
        Route::get('/pemilik/dashboard', [DashboardController::class, 'pemilik'])->name('pemilik.dashboard');
    });


    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::patch('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::patch('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');



    Route::get('/pemasok', [PemasokController::class, 'index'])->name('pemasok.index');
    Route::post('/pemasok', [PemasokController::class, 'store'])->name('pemasok.store');
    Route::get('/pemasok/create', [PemasokController::class, 'create'])->name('pemasok.create');
    Route::patch('/pemasok/update/{id}', [PemasokController::class, 'update'])->name('pemasok.update');
    Route::delete('/pemasok/{id}', [PemasokController::class, 'destroy'])->name('pemasok.destroy');
    Route::get('/pemasok/{id}', [PemasokController::class, 'show'])->name('pemasok.show');

    // Rute Pembelian
    Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
    Route::get('/pembelian/create', [PembelianController::class, 'create'])->name('pembelian.create');
    Route::post('/pembelian', [PembelianController::class, 'store'])->name('pembelian.store');
    // Route::get('/pembelian/{id}/edit', [PembelianController::class, 'edit'])->name('pembelian.edit');
    // Route::patch('/pembelian/{id}', [PembelianController::class, 'update'])->name('pembelian.update');
    // Route::delete('/pembelian/{id}', [PembelianController::class, 'destroy'])->name('pembelian.destroy');
    Route::get('/pembelian/{id}', [PembelianController::class, 'show'])->name('pembelian.show');


    // Rute Detail Pembelian
    Route::get('/detail_pembelian', [DetailPembelianController::class, 'index'])->name('detail_pembelian.index');
    Route::get('/detail_pembelian/create', [DetailPembelianController::class, 'create'])->name('detail_pembelian.create');
    Route::post('/detail_pembelian', [DetailPembelianController::class, 'store'])->name('detail_pembelian.store');
    Route::get('/detail_pembelian/{id}/edit', [DetailPembelianController::class, 'edit'])->name('detail_pembelian.edit');
    Route::patch('/detail_pembelian/{id}', [DetailPembelianController::class, 'update'])->name('detail_pembelian.update');
    Route::delete('/detail_pembelian/{id}', [DetailPembelianController::class, 'destroy'])->name('detail_pembelian.destroy');
    Route::get('/detail_pembelian/{id}', [DetailPembelianController::class, 'show'])->name('detail_pembelian.show');

    //Rute Penjualan
    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index'); // Menampilkan daftar penjualan
    Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create'); // Form tambah penjualan
    Route::post('/penjualan', [PenjualanController::class, 'store'])->name('penjualan.store'); // Simpan penjualan baru
    Route::get('/penjualan/{id}/edit', [PenjualanController::class, 'edit'])->name('penjualan.edit'); // Form edit penjualan
    Route::patch('/penjualan/{id}', [PenjualanController::class, 'update'])->name('penjualan.update'); // Update penjualan
    Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy'); // Hapus penjualan
    Route::get('/penjualan/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
});
