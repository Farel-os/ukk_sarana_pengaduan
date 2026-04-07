<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // fungsi ini untuk menampilkan form login
    public function loginForm()
    {
        return view('auth.login');
    }

    // fungsi ini digunakan untuk menampilkan form register
    public function registerForm()
    {
        return view('auth.register');
    }
    /**
     * pada bagian ini adalah fungsi untuk memproses login
     * didalamnya ada sebuah validasi yang dilakukan, membutuhkan input username dan password user
     * jika input yang dimasukkan user cocok dengan data di database, maka proses akan berhasil dan diarahkan menuju dashboard siswa
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

       if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard.admin');
            } else {
                return redirect()->route('dashboard.siswa');
            }
        }
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }


    // berikut adalah fungsi untuk memproses registrasi
    public function register(Request $request)
    {
        /**
         * ini adalah validasi yang membutuhkan beberapa input dari user
         * diantaranya username, email, nis, kelas, dan juga password
         */
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|email|unique:users',
            'nis' => 'required|string|min:10',
            'kelas'=>'required|string|min:3',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'nis'=> $request->nis,
            'kelas'=>$request->kelas,
            'role'=>'siswa',
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect()->route('dashboard.siswa');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginForm');
    }
}
