<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function index()
    {
        // Jika sudah login, redirect ke dashboard
        if (Session::has('user')) {
            return redirect()->route('dashboard');
        }
        return view('login_sibima');
    }

    // Proses autentikasi
    public function authenticate(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username harus diisi',
            'password.required' => 'Password harus diisi',
        ]);

        $username = $request->username;
        $password = $request->password;

        // Cek user di database
        $user = DB::table('tbl_user')
            ->where('username', $username)
            ->where('password', $password)
            ->first();

        if ($user) {
            // Login berhasil - simpan data user ke session
            Session::put('user', [
                'id_user' => $user->id_user,
                'username' => $user->username,
                'level' => $user->level,
                'email' => $user->email,
                'alamat' => $user->alamat,
                'phone' => $user->phone,
            ]);

            // Redirect berdasarkan level
            return redirect()->route('dashboard')->with('success', 'Login berhasil! Selamat datang ' . $user->username);
        } else {
            // Login gagal
            return back()->with('error', 'Username atau password salah!')->withInput();
        }
    }

    // Logout
    public function logout()
    {
        Session::forget('user');
        Session::flush();

        return redirect()->route('login')->with('success', 'Anda telah logout');
    }

    // Dashboard - redirect berdasarkan level user
    public function dashboard()
    {
        // Cek apakah user sudah login
        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $level = Session::get('user.level');

        // Redirect ke dashboard sesuai level
        switch ($level) {
            case 'admin':
                return view('dashboard_admin');
            case 'kostumer':
                return view('dashboard_kostumer');
            case 'staff':
                return view('dashboard_staff');
            default:
                return redirect()->route('login')->with('error', 'Level user tidak valid');
        }
    }
}
