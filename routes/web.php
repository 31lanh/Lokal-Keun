<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Buyer\PublicController;
use App\Http\Controllers\Front\UmkmDetailController;
/*
|--------------------------------------------------------------------------
| Web Routes - Authentication
|--------------------------------------------------------------------------
*/

// =====================
// GUEST ROUTES
// =====================
Route::middleware('guest')->group(function () {

    // Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
        ->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Social Auth (optional)
    Route::get('/auth/google', [RegisterController::class, 'redirectToGoogle'])
        ->name('auth.google');
    Route::get('/auth/google/callback', [RegisterController::class, 'handleGoogleCallback']);

    Route::get('/auth/github', [RegisterController::class, 'redirectToGithub'])
        ->name('auth.github');
    Route::get('/auth/github/callback', [RegisterController::class, 'handleGithubCallback']);

    Route::get('/auth/apple', [RegisterController::class, 'redirectToApple'])
        ->name('auth.apple');
    Route::get('/auth/apple/callback', [RegisterController::class, 'handleAppleCallback']);
});

// Logout
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| Protected Routes (Auth)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // =====================
    // ADMIN
    // =====================
    // Route::middleware('role:admin')->group(function () {
    //     Route::get('/admin/dashboard', function () {
    //         return view('admin.dashboard');
    //     })->name('admin.dashboard');
    // });

    // =====================
    // SELLER / PENJUAL
    // =====================
    Route::middleware('role:penjual')
        ->prefix('seller')
        ->name('seller.')
        ->group(function () {

            // Daftar UMKM (wajib pertama kali)
            Route::get('/daftar', [SellerController::class, 'showDaftarForm'])
                ->name('daftar');
            Route::post('/daftar', [SellerController::class, 'storeDaftar'])
                ->name('daftar.store');

            // Dashboard Seller
            Route::get('/dashboard', [SellerController::class, 'dashboard'])
                ->name('dashboard');

            // UMKM Profile
            Route::get('/umkm/edit', [SellerController::class, 'editUmkm'])
                ->name('umkm.edit');
            Route::put('/umkm/update', [SellerController::class, 'updateUmkm'])
                ->name('umkm.update');

            // Delete UMKM Photo
            Route::delete('/umkm/photo/{photoId}', [SellerController::class, 'deletePhoto'])
                ->name('umkm.photo.delete');
        });

    // =====================
    // PROFILE (ALL ROLES)
    // =====================
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');
});

/*
|--------------------------------------------------------------------------
| GROUP ROUTE KHUSUS SELLER (PENJUAL)
|--------------------------------------------------------------------------
| Semua route di sini otomatis punya awalan "/seller" dan nama "seller."
|
*/
Route::middleware(['auth', 'role:penjual'])->prefix('seller')->name('seller.')->group(function () {

    // 1. DASHBOARD
    Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('dashboard');

    // 2. PENDAFTARAN UMKM (Hanya bisa diakses jika belum punya UMKM)
    Route::get('/daftar', [SellerController::class, 'showDaftarForm'])->name('daftar');
    Route::post('/daftar', [SellerController::class, 'storeDaftar'])->name('daftar.store');

    // Di dalam group prefix('seller') -> name('seller.')
    Route::get('/branding', [App\Http\Controllers\Seller\SellerController::class, 'editBranding'])->name('branding');
    Route::put('/branding', [App\Http\Controllers\Seller\SellerController::class, 'updateBranding'])->name('branding.update');

    // 3. EDIT INFORMASI UMKM (Data Dasar, Menu, Gallery)
    Route::get('/umkm/edit', [SellerController::class, 'editUmkm'])->name('umkm.edit');
    Route::put('/umkm/update', [SellerController::class, 'updateUmkm'])->name('umkm.update');

    // 4. [BARU] EDIT BRANDING (Logo & Banner Toko)
    Route::get('/branding', [SellerController::class, 'editBranding'])->name('branding');
    Route::put('/branding', [SellerController::class, 'updateBranding'])->name('branding.update');

    // 5. FITUR HAPUS (Foto & Menu)
    Route::delete('/photo/delete/{id}', [SellerController::class, 'deletePhoto'])->name('photo.delete');
    Route::delete('/menu/delete/{id}', [SellerController::class, 'deleteMenu'])->name('menu.delete');
});


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();

        // Pembeli tetap ke home
        if ($user->role === 'pembeli') {
            return view('welcome');
        }

        // Admin & Seller ke dashboard
        return redirect()->route($user->getRedirectRoute());
    }

    return view('welcome');
})->name('home');

// =====================
// JELAJAH (PUBLIC)
// =====================
Route::get('/jelajah', [PublicController::class, 'index'])->name('jelajah');

// =====================
// KATEGORI DETAIL (PUBLIC)
// =====================
Route::get('/kategori/{slug}', [PublicController::class, 'category'])->name('kategori.detail');

// =====================
// DETAIL UMKM (PUBLIC)
// =====================
// Route::get('/detail', function () {
//     // Pastikan path ini sesuai dengan lokasi file detail.blade.php kamu.
//     // Jika file ada di folder: resources/views/penjual/detail.blade.php
//     return view('detail');

//     // TAPI jika file ada langsung di: resources/views/detail.blade.php
//     // return view('detail');
// })->name('umkm.detail');

Route::get('/seller/photo/delete/{id}', [App\Http\Controllers\Seller\SellerController::class, 'deletePhoto'])->name('seller.photo.delete');

// Route untuk Hapus Menu
Route::delete('/seller/menu/{id}', [App\Http\Controllers\Seller\SellerController::class, 'deleteMenu'])->name('seller.menu.delete');

// // =====================

Route::get('/umkm/{slug}', [UmkmDetailController::class, 'show'])->name('umkm.show');

// // GABUNG MITRA (PUBLIC)
// // =====================
// Route::get('/gabung-mitra', function () {
//     return view('penjual.daftar');
// })->name('gabung-mitra');

// =====================
// MARKETPLACE (OPTIONAL)
// =====================
// Route::get('/products', [ProductController::class, 'index'])->name('products.index');
// Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
// Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');


// Route sementara untuk mengintip daftar slug yang ada di database
Route::get('/cek-slug', function () {
    $umkms = \App\Models\Umkm::all();

    if ($umkms->isEmpty()) {
        return "Database UMKM masih kosong. Silakan input data dulu lewat database atau form seller.";
    }

    return $umkms->map(function ($umkm) {
        return url('/umkm/' . $umkm->slug);
    });
});
