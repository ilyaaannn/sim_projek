<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\KostumerController;
use App\Http\Controllers\AdminController;

# Route::get('/', function () {
#     return view('welcome');
# });

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

// Halaman Register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard (protected routes) - berdasarkan level user
Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');

// Routes untuk Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Kelola Penjualan
    Route::get('/penjualan', [AdminController::class, 'penjualan'])->name('penjualan.index');
    Route::get('/penjualan/{id}', [AdminController::class, 'detailPenjualan'])->name('penjualan.detail');
    Route::put('/penjualan/{id}/status', [AdminController::class, 'updateStatusPenjualan'])->name('penjualan.update_status');

    // Kelola Barang
    Route::get('/barang', [AdminController::class, 'barang'])->name('barang.index');
    Route::post('/barang', [AdminController::class, 'storeBarang'])->name('barang.store');
    Route::put('/barang/{id}', [AdminController::class, 'updateBarang'])->name('barang.update');
    Route::delete('/barang/{id}', [AdminController::class, 'destroyBarang'])->name('barang.destroy');

    // Lihat Stok
    Route::get('/stok', [AdminController::class, 'stok'])->name('stok.index');

    // Transaksi Penjualan
    Route::get('/transaksi', [AdminController::class, 'transaksi'])->name('transaksi.index');
    Route::post('/transaksi', [AdminController::class, 'storeTransaksi'])->name('transaksi.store');

    // Laporan Penjualan
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan.index');
    Route::get('/laporan/pdf', [AdminController::class, 'laporanPDF'])->name('laporan.pdf');
    Route::get('/laporan/excel', [AdminController::class, 'laporanExcel'])->name('laporan.excel');
});

Route::prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffController::class, 'dashboardStaff'])->name('dashboard_staff');

    // Routes untuk Kategori
    Route::get('/kategori', [StaffController::class, 'kategori'])->name('kategori.index');
    Route::post('/kategori', [StaffController::class, 'storek'])->name('kategori.store');
    Route::put('/kategori/{id}', [StaffController::class, 'updatek'])->name('kategori.update');
    Route::delete('/kategori/{id}', [StaffController::class, 'destroyk'])->name('kategori.destroy');

    // Routes untuk Barang
    Route::get('/barang', [StaffController::class, 'dataBarang'])->name('barang.index');
    Route::post('/barang', [StaffController::class, 'storeBarang'])->name('barang.store');
    Route::put('/barang/{id}', [StaffController::class, 'updateBarang'])->name('barang.update');
    Route::delete('/barang/{id}', [StaffController::class, 'destroyBarang'])->name('barang.destroy');

    Route::get('/stok', [StaffController::class, 'tambahStok'])->name('stok.index');
    Route::post('/stok', [StaffController::class, 'storeStok'])->name('stok.store');
    Route::put('/stok/{id}', [StaffController::class, 'updateStok'])->name('stok.update');
    Route::delete('/stok/{id}', [StaffController::class, 'destroyStok'])->name('stok.destroy');

    // Routes untuk Stok Barang (Laporan)
    Route::get('/stok-barang', [StaffController::class, 'stokBarang'])->name('stok_barang.index');
    Route::get('/stok-barang/pdf', [StaffController::class, 'cetakStokPDF'])->name('stok_barang.pdf');
});

// Routes untuk Kostumer
Route::middleware(['web'])->group(function () {
    // Produk
    Route::get('/kostumer/produk', [KostumerController::class, 'produk'])->name('kostumer.produk');
    Route::get('/kostumer/produk/kategori/{id}', [KostumerController::class, 'produkByKategori'])->name('kostumer.produk.kategori');
    Route::get('/kostumer/produk/detail/{id}', [KostumerController::class, 'detailProduk'])->name('kostumer.produk.detail');

    // Keranjang
    Route::get('/kostumer/keranjang', [KostumerController::class, 'keranjang'])->name('kostumer.keranjang');
    Route::post('/kostumer/keranjang/tambah', [KostumerController::class, 'tambahKeranjang'])->name('kostumer.keranjang.tambah');
    Route::post('/kostumer/keranjang/update/{id}', [KostumerController::class, 'updateKeranjang'])->name('kostumer.keranjang.update');
    Route::delete('/kostumer/keranjang/hapus/{id}', [KostumerController::class, 'hapusKeranjang'])->name('kostumer.keranjang.hapus');

    // Checkout & Order
    Route::get('/kostumer/checkout', [KostumerController::class, 'checkout'])->name('kostumer.checkout');
    Route::post('/kostumer/order/buat', [KostumerController::class, 'buatOrder'])->name('kostumer.order.buat');

    // Riwayat
    Route::get('/kostumer/riwayat', [KostumerController::class, 'riwayat'])->name('kostumer.riwayat');
    Route::get('/kostumer/riwayat/detail/{id}', [KostumerController::class, 'detailRiwayat'])->name('kostumer.riwayat.detail');

    // PDF Download - ROUTE BARU
    Route::get('/kostumer/riwayat/pdf/{id}', [KostumerController::class, 'generatePDF'])->name('kostumer.riwayat.pdf');
});
