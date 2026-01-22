<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Buyer\PublicController;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Front\UmkmDetailController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Buyer\ReviewController; // [Punya Anda]
use App\Http\Controllers\Buyer\ProfileController; // [Punya Teman]

/*
|--------------------------------------------------------------------------
| Web Routes - Authentication (GUEST)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/auth/google', [RegisterController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [RegisterController::class, 'handleGoogleCallback']);
});

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
    // [GABUNGAN]: Route profile edit dan update (dari kode teman)
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // =====================
    // SWITCH ROLE (Pembeli -> Penjual)
    // =====================
    // [PUNYA ANDA]
    Route::post('/switch-to-seller', [SellerController::class, 'switchRole'])->name('seller.switch');

    // =====================
    // REVIEW ROUTES (Simpan & Hapus)
    // =====================
    // [PUNYA ANDA]
    Route::post('/umkm/{id}/review', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // =====================
    // FAVORITE (Toggle)
    // =====================
    // [PUNYA TEMAN]
    Route::post('/favorite/{id}', [BuyerController::class, 'toggleFavorite'])->name('favorite.toggle');


    // =====================
    // SELLER ROUTES
    // =====================
    Route::middleware('role:penjual')->prefix('seller')->name('seller.')->group(function () {
        Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('dashboard');
        Route::get('/daftar', [SellerController::class, 'showDaftarForm'])->name('daftar');
        Route::post('/daftar', [SellerController::class, 'storeDaftar'])->name('daftar.store');
        Route::get('/branding', [SellerController::class, 'editBranding'])->name('branding');
        Route::put('/branding', [SellerController::class, 'updateBranding'])->name('branding.update');
        Route::get('/umkm/edit', [SellerController::class, 'editUmkm'])->name('umkm.edit');
        Route::put('/umkm/update', [SellerController::class, 'updateUmkm'])->name('umkm.update');
        Route::delete('/photo/{id}/delete', [SellerController::class, 'deletePhoto'])->name('photo.delete');
        Route::delete('/menu/{id}/delete', [SellerController::class, 'deleteMenu'])->name('menu.delete');
    });

    // =====================
    // ADMIN ROUTES
    // =====================
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/umkm', [AdminController::class, 'umkmIndex'])->name('umkm.index');
        Route::put('/umkm/{id}/approve', [AdminController::class, 'approveUmkm'])->name('umkm.approve');
        Route::put('/umkm/{id}/reject', [AdminController::class, 'rejectUmkm'])->name('umkm.reject');
        Route::get('/users', [AdminController::class, 'usersIndex'])->name('users.index');
        Route::put('/users/{id}/verify', [AdminController::class, 'verifyUser'])->name('users.verify');
        Route::delete('/users/{id}', [AdminController::class, 'userDestroy'])->name('users.destroy');
    });

    // =====================
    // BUYER ROUTES
    // =====================
    Route::middleware('role:pembeli')->prefix('buyer')->name('buyer.')->group(function () {
        Route::get('/dashboard', [BuyerController::class, 'index'])->name('dashboard');
    });
});

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;
        if ($role === 'admin') return redirect()->route('admin.dashboard');
        if ($role === 'penjual') return redirect()->route('seller.dashboard');
    }
    return app(App\Http\Controllers\Buyer\PublicController::class)->welcome();
})->name('home');

Route::get('/jelajah', [PublicController::class, 'index'])->name('jelajah');
Route::get('/kategori/{slug}', [PublicController::class, 'category'])->name('kategori.detail');
Route::get('/umkm/{slug}', [UmkmDetailController::class, 'show'])->name('umkm.show');
// Route::get('/direktori-umkm', [PublicController::class, 'direktori'])->name('umkm.index');

Route::middleware(['auth'])->get('/dashboard-redirect', function () {
    $user = auth()->user();
    if ($user->role === 'admin') return redirect()->route('admin.dashboard');
    elseif ($user->role === 'penjual') return redirect()->route('seller.dashboard');
    else return redirect()->route('buyer.dashboard');
})->name('dashboard');

Route::get('/run-seeder', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
        return 'Seeder successfully run!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

require __DIR__ . '/debug_db.php';
require __DIR__ . '/debug_transaction.php';
require __DIR__ . '/debug_schema_deep.php';
require __DIR__ . '/debug_data_check.php';
require __DIR__ . '/debug_upload.php';