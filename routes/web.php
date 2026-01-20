<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Buyer\PublicController;
use App\Http\Controllers\Buyer\BuyerController; // [BARU] Import Controller Dashboard Pembeli
use App\Http\Controllers\Front\UmkmDetailController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Buyer\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes - Authentication (GUEST)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    // Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Social Auth
    Route::get('/auth/google', [RegisterController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [RegisterController::class, 'handleGoogleCallback']);

    // ... (Github/Apple jika ada)
});

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Protected Routes (AUTH)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

        // =====================
        // PROFILE (ALL ROLES)
        // =====================
        Route::get('/profile', function () {
            return view('profile.edit');
        })->name('profile.edit');
        Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    // =====================
    // SELLER / PENJUAL ROUTES
    // =====================
    Route::middleware('role:penjual')
        ->prefix('seller')
        ->name('seller.')
        ->group(function () {
            // Dashboard
            Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('dashboard');

            // Pendaftaran & Branding
            Route::get('/daftar', [SellerController::class, 'showDaftarForm'])->name('daftar');
            Route::post('/daftar', [SellerController::class, 'storeDaftar'])->name('daftar.store');
            Route::get('/branding', [SellerController::class, 'editBranding'])->name('branding');
            Route::put('/branding', [SellerController::class, 'updateBranding'])->name('branding.update');

            // Manajemen UMKM
            Route::get('/umkm/edit', [SellerController::class, 'editUmkm'])->name('umkm.edit');
            Route::put('/umkm/update', [SellerController::class, 'updateUmkm'])->name('umkm.update');

            // Hapus Data (Gunakan DELETE method agar aman)
            Route::delete('/photo/{id}/delete', [SellerController::class, 'deletePhoto'])->name('photo.delete');
            Route::delete('/menu/{id}/delete', [SellerController::class, 'deleteMenu'])->name('menu.delete');
        });

    // =====================
    // ADMIN ROUTES
    // =====================
    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

            // Validasi UMKM
            Route::get('/umkm', [AdminController::class, 'umkmIndex'])->name('umkm.index');
            Route::put('/umkm/{id}/approve', [AdminController::class, 'approveUmkm'])->name('umkm.approve');
            Route::put('/umkm/{id}/reject', [AdminController::class, 'rejectUmkm'])->name('umkm.reject');

            // Manajemen User
            Route::get('/users', [AdminController::class, 'usersIndex'])->name('users.index');
            Route::delete('/users/{id}', [AdminController::class, 'userDestroy'])->name('users.destroy');
        });

    // =====================
    // BUYER / PEMBELI ROUTES [BARU]
    // =====================
    Route::middleware('role:pembeli')
        ->prefix('buyer')
        ->name('buyer.')
        ->group(function () {
            // Ini route dashboard khusus pembeli yang baru kita buat
            Route::get('/dashboard', [BuyerController::class, 'index'])->name('dashboard');
        });

    // Toggle Favorite (Bisa diakses semua user yang login)
    Route::post('/favorite/{id}', [BuyerController::class, 'toggleFavorite'])->name('favorite.toggle');
});

/*
|--------------------------------------------------------------------------
| Public Routes (Bisa diakses siapa saja)
|--------------------------------------------------------------------------
*/

// Home (Logika Redirect Cerdas)
Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;

        // Redirect sesuai role
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'penjual') {
            return redirect()->route('seller.dashboard');
        }
    }
    // Jika tamu (belum login), tampilkan landing page
    return app(App\Http\Controllers\Buyer\PublicController::class)->welcome();
})->name('home');

// Jelajah & Detail
Route::get('/jelajah', [PublicController::class, 'index'])->name('jelajah');
Route::get('/kategori/{slug}', [PublicController::class, 'category'])->name('kategori.detail');
Route::get('/umkm/{slug}', [UmkmDetailController::class, 'show'])->name('umkm.show');

// Debugging (Bisa dihapus nanti saat production)
Route::get('/cek-slug', function () {
    $umkms = \App\Models\Umkm::all();
    if ($umkms->isEmpty()) return "Database UMKM masih kosong.";
    return $umkms->map(fn($umkm) => url('/umkm/' . $umkm->slug));
});

// Direktori Semua UMKM
Route::get('/direktori-umkm', [PublicController::class, 'direktori'])->name('umkm.index');

/*
|--------------------------------------------------------------------------
| ROUTE PENGHUBUNG (TRAFFIC COP)
|--------------------------------------------------------------------------
| Route ini menangani pemanggilan route('dashboard') dari header/view.
| Dia akan melempar user ke dashboard spesifik sesuai role.
*/
Route::middleware(['auth'])->get('/dashboard-redirect', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'penjual') {
        return redirect()->route('seller.dashboard');
    } else {
        // Default pembeli
        return redirect()->route('buyer.dashboard');
    }
})->name('dashboard'); // <--- INI PENTING: Namanya harus 'dashboard'