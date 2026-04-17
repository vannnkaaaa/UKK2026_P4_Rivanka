<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Anggota\DashboardController as AnggotaDashboardController;
use App\Http\Controllers\Anggota\PeminjamanController as AnggotaPeminjamanController;
use App\Http\Controllers\Anggota\PengembalianController as AnggotaPengembalianController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjamanController;
use App\Http\Controllers\Petugas\PengembalianController as PetugasPengembalianController;
use App\Http\Controllers\Petugas\DendaController as PetugasDendaController;
use Illuminate\Support\Facades\Route;

// =====================
// AUTH
// =====================
Route::get('/', fn() => redirect()->route('login'));

Route::get('/login',          [AuthController::class, 'login'])->name('login');
Route::post('/login-proses',  [AuthController::class, 'loginProses'])->name('login.proses');
Route::get('/register',       [AuthController::class, 'register'])->name('register');
Route::post('/register-proses', [AuthController::class, 'prosesRegister'])->name('register.proses');
Route::post('/logout',        [AuthController::class, 'logout'])->name('logout');

// =====================
// ADMIN
// =====================
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

   Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('anggota',   \App\Http\Controllers\Admin\AnggotaController::class);
    Route::resource('buku',      \App\Http\Controllers\Admin\BukuController::class);
    Route::resource('rak',       \App\Http\Controllers\Admin\RakController::class);
    Route::resource('kelas',     \App\Http\Controllers\Admin\KelasController::class);
    Route::resource('penerbit',  \App\Http\Controllers\Admin\PenerbitController::class);
    Route::resource('pengarang', \App\Http\Controllers\Admin\PengarangController::class);
    Route::resource('petugas',   \App\Http\Controllers\Admin\PetugasController::class);
});

// =====================
// ANGGOTA
// =====================
Route::prefix('anggota')->name('anggota.')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', [AnggotaDashboardController::class, 'index'])->name('dashboard');

    // Peminjaman: lihat daftar + ajukan
    Route::get('/peminjaman',  [AnggotaPeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('/peminjaman', [AnggotaPeminjamanController::class, 'store'])->name('peminjaman.store');

    // Pengembalian: lihat daftar + ajukan
    Route::get('/pengembalian',  [AnggotaPengembalianController::class, 'index'])->name('pengembalian.index');
    Route::post('/pengembalian', [AnggotaPengembalianController::class, 'store'])->name('pengembalian.store');

    // Katalog buku (read only)
    Route::get('/buku', [\App\Http\Controllers\Anggota\BukuController::class, 'index'])->name('buku.index');
    
    // Riwayat peminjaman
    Route::get('/riwayat', [\App\Http\Controllers\Anggota\RiwayatController::class, 'index'])->name('riwayat.index');
});

// =====================
// PETUGAS
// =====================
Route::prefix('petugas')->name('petugas.')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');

    // Peminjaman: list + terima/tolak
    Route::get('/peminjaman', [PetugasPeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('/peminjaman/{id}/terima', [PetugasPeminjamanController::class, 'terima'])->name('peminjaman.terima');
    Route::post('/peminjaman/{id}/tolak',  [PetugasPeminjamanController::class, 'tolak'])->name('peminjaman.tolak');

    // Pengembalian: list + terima/tolak
    Route::get('/pengembalian', [PetugasPengembalianController::class, 'index'])->name('pengembalian.index');
    Route::post('/pengembalian/{id}/terima', [PetugasPengembalianController::class, 'terima'])->name('pengembalian.terima');
    Route::post('/pengembalian/{id}/tolak',  [PetugasPengembalianController::class, 'tolak'])->name('pengembalian.tolak');

    // Denda: list + tandai lunas
    Route::get('/denda', [PetugasDendaController::class, 'index'])->name('denda.index');
    Route::post('/denda/{id}/lunas', [PetugasDendaController::class, 'lunas'])->name('denda.lunas');

    // Lihat data buku (read only)
    Route::get('/buku', [\App\Http\Controllers\Petugas\BukuController::class, 'index'])->name('buku.index');
});
