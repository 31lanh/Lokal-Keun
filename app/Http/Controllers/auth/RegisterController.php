<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     * Ini akan di-override oleh method redirectTo()
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get the post registration redirect path based on user role.
     */
    public function redirectTo()
    {
        $user = auth()->user();

        // Redirect berdasarkan role
        return match ($user->role) {
            'admin' => '/admin/dashboard',
            'penjual' => '/seller/dashboard',
            'pembeli' => '/', // Pembeli langsung ke home
            default => '/',
        };
    }

    /**
     * Show the application registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:pembeli,penjual'], // hanya bisa register sebagai pembeli atau penjual
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'role.required' => 'Pilih role Anda',
            'role.in' => 'Role tidak valid',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
    }

    /**
     * Handle a registration request for the application.
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        $this->guard()->login($user);

        return redirect($this->redirectPath());
    }

    /*
    |--------------------------------------------------------------------------
    | Social Authentication Methods (Optional - jika pakai Laravel Socialite)
    |--------------------------------------------------------------------------
    */

    // Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->email],
                [
                    'name' => $googleUser->name,
                    'password' => Hash::make(uniqid()), // random password
                    'role' => 'pembeli', // default sebagai pembeli
                ]
            );

            auth()->login($user);

            return redirect($this->redirectPath());
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login dengan Google gagal');
        }
    }

    // GitHub
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();

            $user = User::firstOrCreate(
                ['email' => $githubUser->email],
                [
                    'name' => $githubUser->name ?? $githubUser->nickname,
                    'password' => Hash::make(uniqid()),
                    'role' => 'pembeli',
                ]
            );

            auth()->login($user);

            return redirect($this->redirectPath());
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login dengan GitHub gagal');
        }
    }

    // Apple
    public function redirectToApple()
    {
        return Socialite::driver('apple')->redirect();
    }

    public function handleAppleCallback()
    {
        try {
            $appleUser = Socialite::driver('apple')->user();

            $user = User::firstOrCreate(
                ['email' => $appleUser->email],
                [
                    'name' => $appleUser->name ?? 'Apple User',
                    'password' => Hash::make(uniqid()),
                    'role' => 'pembeli',
                ]
            );

            auth()->login($user);

            return redirect($this->redirectPath());
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login dengan Apple gagal');
        }
    }
}
