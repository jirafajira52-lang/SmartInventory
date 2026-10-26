
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\AgenController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengelolaanStokController;
use App\Http\Controllers\RiwayatStokController;

// ==========================
// LOGIN DAN LOGOUT
// ==========================

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ==========================
// HALAMAN UTAMA DAN FITUR
// HANYA UNTUK PENGGUNA LOGIN
// ==========================

Route::middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Data master
    Route::resource('barang', BarangController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('distributor', DistributorController::class);
    Route::resource('agen', AgenController::class);

    // Barang masuk
    Route::get('/barang-masuk', [BarangMasukController::class, 'index'])
        ->name('barang-masuk.index');

    Route::get('/barang-masuk/create', [BarangMasukController::class, 'create'])
        ->name('barang-masuk.create');

    Route::post('/barang-masuk', [BarangMasukController::class, 'store'])
        ->name('barang-masuk.store');

    // Barang keluar
    Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])
        ->name('barang-keluar.index');

    Route::get('/barang-keluar/create', [BarangKeluarController::class, 'create'])
        ->name('barang-keluar.create');

    Route::post('/barang-keluar', [BarangKeluarController::class, 'store'])
        ->name('barang-keluar.store');

    // Pengelolaan stok
    Route::get('/pengelolaan-stok', [PengelolaanStokController::class, 'index'])
        ->name('pengelolaan-stok.index');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    // Riwayat stok
    Route::get('/riwayat-stok', [RiwayatStokController::class, 'index'])
        ->name('riwayat-stok.index');
});
