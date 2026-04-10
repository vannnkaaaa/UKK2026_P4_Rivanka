<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Anggota;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginProses(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(
            $request->only('email', 'password'),
            $request->filled('remember')
        )) {

            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }
            if ($user->role == 'anggota') {
                return redirect()->route('anggota.dashboard');
            }
            if ($user->role == 'petugas') {
                return redirect()->route('petugas.dashboard');
            }
            Auth::logout();
            return back()->with('error', 'Role tidak dikenali');
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function prosesRegister(Request $request)
    {
        $request->validate([
            'nama_depan' => 'required',
            'nim' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        // simpan ke tabel users
        $user = User::create([
            'name' => $request->nama_depan . ' ' . $request->nama_belakang,
            'nim' => $request->nim,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // simpan ke tabel anggota
        Anggota::create([
            'user_id' => $user->id,
            'nama' => $user->name,
            'nim' => $request->nim,
            'email' => $request->email,
        ]);

        return redirect()->route('login')->with('success', 'Register berhasil!');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
