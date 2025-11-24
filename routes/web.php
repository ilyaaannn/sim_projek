<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard (protected routes) - berdasarkan level user
Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
