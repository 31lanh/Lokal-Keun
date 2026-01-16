<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home Route - Welcome Page (untuk semua orang termasuk pembeli yang sudah login)
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/jelajah', function () {
    return view('jelajah');
})->name('jelajah');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    // Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Social Authentication (Optional)
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
| Pembeli/Buyer Routes (Auth Required)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:pembeli'])->prefix('pembeli')->name('pembeli.')->group(function () {

    // Profile pembeli
    Route::get('/profile', function () {
        return view('pembeli.profile');
    })->name('profile');

    // Pesanan/Orders pembeli
    Route::get('/pesanan', function () {
        return view('pembeli.pesanan');
    })->name('pesanan');

    // Favorit/Wishlist pembeli
    Route::get('/favorit', function () {
        return view('pembeli.favorit');
    })->name('favorit');

    // Keranjang/Cart pembeli
    Route::get('/keranjang', function () {
        return view('pembeli.keranjang');
    })->name('keranjang');

    // Alamat pengiriman
    Route::get('/alamat', function () {
        return view('pembeli.alamat');
    })->name('alamat');

    // Notifikasi
    Route::get('/notifikasi', function () {
        return view('pembeli.notifikasi');
    })->name('notifikasi');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin & Seller Routes (Untuk Nanti)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Admin routes lainnya...
});

Route::middleware(['auth', 'role:penjual'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/dashboard', function () {
        return view('seller.dashboard');
    })->name('dashboard');

    // Seller routes lainnya...
});

/*
|--------------------------------------------------------------------------
| Public Marketplace Routes (Accessible untuk semua)
|--------------------------------------------------------------------------
*/

// Kategori
Route::get('/kategori', function () {
    return view('kategori');
})->name('kategori');

// Tentang
Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

// Kontak
Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

// UMKM List
Route::get('/umkm', function () {
    return view('umkm.index');
})->name('umkm.index');

// UMKM Detail
Route::get('/umkm/{id}', function ($id) {
    return view('umkm.show', compact('id'));
})->name('umkm.show');

// Product List
Route::get('/produk', function () {
    return view('produk.index');
})->name('produk.index');

// Product Detail
Route::get('/produk/{id}', function ($id) {
    return view('produk.show', compact('id'));
})->name('produk.show');
