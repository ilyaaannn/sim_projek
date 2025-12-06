<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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
