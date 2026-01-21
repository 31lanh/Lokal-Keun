<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'whatsapp' => 'required|regex:/^08[0-9]{8,13}$/',
            'password' => 'required|min:8',
            'role' => 'required|in:buyer,seller',
            'terms' => 'accepted',
        ], [
            'name.required' => 'Nama lengkap wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'whatsapp.required' => 'Nomor WhatsApp wajib diisi',
            'whatsapp.regex' => 'Format nomor WhatsApp tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'role.required' => 'Pilih peran Anda',
            'terms.accepted' => 'Anda harus menyetujui syarat & ketentuan',
        ]);

        // Konversi role ke bahasa Indonesia untuk database
        $role = $validated['role'] === 'buyer' ? 'pembeli' : 'penjual';

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'whatsapp' => $validated['whatsapp'],
            'password' => Hash::make($validated['password']),
            'role' => $role,
        ]);

        Auth::login($user);

        // Redirect berdasarkan role
        if ($role === 'penjual') {
            return redirect()->route('seller.daftar')
                ->with('success', 'Akun berhasil dibuat! Silakan lengkapi data UMKM Anda.');
        }

        return redirect('/')->with('success', 'Akun berhasil dibuat!');
    }

    // Social Auth methods (Google, GitHub, Apple) - sesuaikan dengan kebutuhan
    public function redirectToGoogle()
    {
        // Implementasi OAuth Google
    }

    public function handleGoogleCallback()
    {
        // Handle callback Google
    }

    public function redirectToGithub()
    {
        // Implementasi OAuth GitHub
    }

    public function handleGithubCallback()
    {
        // Handle callback GitHub
    }

    public function redirectToApple()
    {
        // Implementasi OAuth Apple
    }

    public function handleAppleCallback()
    {
        // Handle callback Apple
    }
}
