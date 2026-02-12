<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function loginProses(Request $r)
    {
        $r->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $r->username)->first();
        
        if (!$user) {
            return back()->with('error', 'Username tidak ditemukan');
        }

        if (!$user->status_aktif) {
            return back()->with('error', 'Akun anda sedang tidak aktif');
        }

        if ($r->password === $user->password) {
            Auth::login($user);

            if ($user->role == 'admin') {
                return redirect('/admin/dashboard');
            } elseif ($user->role == 'petugas') {
                return redirect('/petugas/dashboard');
            } else {
                return redirect('/owner/dashboard');
            }
        }

        return back()->with('error', 'Password yang anda masukkan salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
