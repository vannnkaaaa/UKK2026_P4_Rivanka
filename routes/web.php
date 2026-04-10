    <?php

    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\Anggota\DashboardController as AnggotaDashboardController;
    use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
    use App\Http\Controllers\Admin;
    use App\Http\Controllers\Admin\AnggotaController;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "web" middleware group. Make something great!
    |
    */

    Route::get('/', function () {
        return view('auth.login');
    });

    //Auth
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login-proses', [AuthController::class, 'loginProses']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register-proses', [AuthController::class, 'prosesRegister'])->name('register.proses');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('layouts.master');
    });

    Route::prefix('anggota')->name('anggota.')->middleware(['auth'])->group(function () {
        Route::get('/dashboard', [AnggotaDashboardController::class, 'index'])->name('dashboard');
    });

    Route::prefix('petugas')->name('petugas.')->middleware(['auth'])->group(function () {
        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');
    });

    // Admin
    Route::prefix('admin')
        ->name('admin.')
        ->middleware(['auth'])
        ->group(function () {

            Route::get('/dashboard', function () {
                return view('admin.dashboard.index');
            })->name('dashboard');

            Route::resource('anggota', \App\Http\Controllers\Admin\AnggotaController::class);
            Route::resource('buku', \App\Http\Controllers\Admin\BukuController::class);
        });
