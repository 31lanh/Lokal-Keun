<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Buyer\PublicController;
use App\Http\Controllers\Front\UmkmDetailController;
use App\Http\Controllers\Admin\AdminController;



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

    Route::get('/auth/github', [RegisterController::class, 'redirectToGithub'])->name('auth.github');
    Route::get('/auth/github/callback', [RegisterController::class, 'handleGithubCallback']);

    Route::get('/auth/apple', [RegisterController::class, 'redirectToApple'])->name('auth.apple');
    Route::get('/auth/apple/callback', [RegisterController::class, 'handleAppleCallback']);
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

    // =====================
    // SELLER / PENJUAL ROUTES
    // =====================
    Route::middleware('role:penjual')
        ->prefix('seller')
        ->name('seller.')
        ->group(function () {

            // 1. DASHBOARD
            Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('dashboard');

            // 2. PENDAFTARAN UMKM
            Route::get('/daftar', [SellerController::class, 'showDaftarForm'])->name('daftar');
            Route::post('/daftar', [SellerController::class, 'storeDaftar'])->name('daftar.store');

            // 3. BRANDING
            Route::get('/branding', [SellerController::class, 'editBranding'])->name('branding');
            Route::put('/branding', [SellerController::class, 'updateBranding'])->name('branding.update');

            // 4. EDIT INFORMASI UMKM
            Route::get('/umkm/edit', [SellerController::class, 'editUmkm'])->name('umkm.edit');
            Route::put('/umkm/update', [SellerController::class, 'updateUmkm'])->name('umkm.update');

            // 5. FITUR HAPUS (Foto & Menu)
            Route::get('/photo/{id}/delete', [SellerController::class, 'deletePhoto'])->name('photo.delete');
            Route::delete('/menu/{id}/delete', [SellerController::class, 'deleteMenu'])->name('menu.delete');
        });
});


// GROUP ROUTE ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Utama
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Manajemen UMKM (Validasi)
    Route::get('/umkm', [AdminController::class, 'umkmIndex'])->name('umkm.index');
    Route::put('/umkm/{id}/approve', [AdminController::class, 'approveUmkm'])->name('umkm.approve');
    Route::put('/umkm/{id}/reject', [AdminController::class, 'rejectUmkm'])->name('umkm.reject');

    // MANAJEMEN USER
    Route::get('/users', [AdminController::class, 'usersIndex'])->name('users.index');
    Route::delete('/users/{id}', [AdminController::class, 'userDestroy'])->name('users.destroy');
});

/*
|--------------------------------------------------------------------------
| Public Routes (Bisa diakses siapa saja)
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if ($user->role === 'pembeli') {
            return view('welcome');
        }
        if (method_exists($user, 'getRedirectRoute')) {
            return redirect()->route($user->getRedirectRoute());
        }
    }
    return view('welcome');
})->name('home');

// Jelajah
Route::get('/jelajah', [PublicController::class, 'index'])->name('jelajah');

// Kategori Detail (Punya Temanmu - Kita Ambil)
Route::get('/kategori/{slug}', [PublicController::class, 'category'])->name('kategori.detail');

// Detail UMKM
Route::get('/umkm/{slug}', [UmkmDetailController::class, 'show'])->name('umkm.show');

// Route Debugging
Route::get('/cek-slug', function () {
    $umkms = \App\Models\Umkm::all();
    if ($umkms->isEmpty()) {
        return "Database UMKM masih kosong.";
    }
    return $umkms->map(function ($umkm) {
        return url('/umkm/' . $umkm->slug);
    });
});
