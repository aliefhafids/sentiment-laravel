<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

     public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika login berhasil, simpan informasi pengguna ke dalam sesi dan cookie
            session(['user_id' => Auth::id()]);
            return redirect()->intended('/dashboard');
        }

        return redirect()->back()->withInput()->withErrors([
            'login' => 'Invalid email or password. Please try again.',
        ]);
    }

    public function logout(Request $request)
    {
       Auth::logout();

        // Hapus informasi pengguna dari sesi
        $request->session()->forget('user_id');

        // Hapus informasi pengguna dari cookie saat logout
        Cookie::queue(Cookie::forget('user_id'));

        return redirect('/');
    }
}
