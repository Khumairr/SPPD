<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            // Jika sudah login, redirect ke dashboard
            return redirect()->route('dashboard');
        }
        // Jika belum login, tampilkan halaman login
        return view('login');
    }

    public function actionlogin(Request $request)
    {
        // Validasi input
        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        // Attempt login
        if (Auth::attempt($credentials)) {
            // Redirect ke dashboard jika login berhasil
            return redirect()->route('dashboard');
        } else {
            // Redirect kembali ke login dengan pesan error jika gagal
            return redirect()->route('login')->with('error', 'Username atau Password salah');
        }
    }

    public function actionlogout()
    {
        // Logout dan redirect ke halaman login
        Auth::logout();
        return redirect()->route('login');
    }
}
