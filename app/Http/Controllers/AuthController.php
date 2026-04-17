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
        $kelas = \App\Models\Kelas::all();
        return view('auth.register', compact('kelas'));
    }

    public function prosesRegister(Request $request)
    {
        $request->validate([
            'nama_depan' => 'required',
            'nis'        => 'required|unique:users',
            'email'      => 'required|email|unique:users',
            'password'   => 'required|min:8|confirmed',
        ]);

        User::create([
            'name'        => $request->nama_depan . ' ' . $request->nama_belakang,
            'nis'         => $request->nis,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'role'        => 'anggota',
            'alamat'       => $request->alamat,
            'kelas_id'     => $request->kelas_id,
            'no_kartu'    => 'ANG-' . str_pad(User::where('role', 'anggota')->count() + 1, 3, '0', STR_PAD_LEFT),
            'status_aktif' => 1,
        ]);

        return redirect()->route('login')->with('success', 'Register berhasil! Silakan login.');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
