<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\UmkmController;

Route::get('/detail', [UmkmController::class, 'show'])->name('umkm.detail');


Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.signup')->name('register'); // Asumsi nanti nama filenya auth/signup.blade.php

// routes/web.php
Route::get('/jelajah', [UmkmController::class, 'index'])->name('umkm.index');