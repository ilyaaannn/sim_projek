<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    // Menampilkan halaman register
    public function index()
    {
        // Jika sudah login, redirect ke dashboard
        if (Session::has('user')) {
            return redirect()->route('dashboard');
        }
        return view('login_sibima', ['isRegister' => true]);
    }

    // Proses registrasi
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|min:3|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|numeric|digits_between:10,15',
            'alamat' => 'required|max:200',
            'level' => 'required|in:kostumer,admin,staff',
            'password' => 'required|min:6|max:20|confirmed',
        ], [
            'username.required' => 'Nama lengkap harus diisi',
            'username.min' => 'Nama lengkap minimal 3 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'phone.required' => 'No handphone harus diisi',
            'phone.numeric' => 'No handphone harus berupa angka',
            'phone.digits_between' => 'No handphone harus 10-15 digit',
            'alamat.required' => 'Alamat harus diisi',
            'level.required' => 'Level harus dipilih',
            'level.in' => 'Level tidak valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        // Cek apakah username sudah ada
        $existingUsername = DB::table('tbl_user')
            ->where('username', $request->username)
            ->first();

        if ($existingUsername) {
            return back()->with('error', 'Username sudah terdaftar!')->withInput();
        }

        // Cek apakah email sudah ada
        $existingEmail = DB::table('tbl_user')
            ->where('email', $request->email)
            ->first();

        if ($existingEmail) {
            return back()->with('error', 'Email sudah terdaftar!')->withInput();
        }

        // Generate ID user baru (ambil ID terakhir + 1)
        $lastUser = DB::table('tbl_user')
            ->orderBy('id_user', 'desc')
            ->first();

        $newIdUser = $lastUser ? $lastUser->id_user + 1 : 1;

        // Insert user baru
        try {
            DB::table('tbl_user')->insert([
                'id_user' => $newIdUser,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'alamat' => $request->alamat,
                'level' => $request->level,
                'password' => $request->password, // Note: Dalam production, gunakan Hash::make()
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat registrasi. Silakan coba lagi.')->withInput();
        }
    }
}
