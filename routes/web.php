<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Seller\SellerController;
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
Route::get('/jelajah', function () {
    return view('jelajah');
})->name('jelajah');

// // =====================
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
