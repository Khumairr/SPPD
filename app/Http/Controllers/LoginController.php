<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function actionlogin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Login berhasil, cek role pengguna
            $user = Auth::user();

            if ($user->nama_role == 2) {
                return redirect()->route('adminutama.datauser'); // Halaman untuk superadmin
            } else {
                return redirect()->route('dashboard'); // Halaman untuk user
            }

            return redirect()->route('login')->with('error', 'Role tidak valid!');
        }

        // Login gagal
        return back()->with('error', 'Username atau Password salah!');
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


}
