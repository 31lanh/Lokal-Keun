<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Masuk - Lokal-keun</title>

    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .gradient-text {
            background: linear-gradient(135deg, #FF6B35 0%, #4CAF50 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .gradient-left {
            background: linear-gradient(180deg,
                    rgba(255, 235, 220, 0.4) 0%,
                    rgba(255, 200, 170, 0.5) 40%,
                    rgba(255, 107, 53, 0.6) 70%,
                    rgba(255, 150, 100, 0.5) 100%);
        }

        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 20px;
        }

        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background-color: #94a3b8;
        }
    </style>
</head>

<body
    class="bg-gray-100 dark:bg-gray-900 font-display h-screen w-screen overflow-hidden flex items-center justify-center relative">

    <a href="{{ url('/') }}"
        class="absolute top-6 left-6 z-50 flex items-center gap-2 px-4 py-2 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-full shadow-sm hover:shadow-md transition-all group border border-gray-200 dark:border-gray-700">
        <span
            class="material-symbols-outlined text-gray-600 dark:text-gray-300 group-hover:text-primary-orange transition-colors text-lg">arrow_back</span>
        <span
            class="text-sm font-bold text-gray-600 dark:text-gray-300 group-hover:text-primary-orange transition-colors">Kembali</span>
    </a>

    <div class="w-full h-full p-4 md:p-6 flex items-center justify-center">

        <div
            class="w-full max-w-5xl h-full md:h-[90vh] bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row">

            <div class="hidden md:flex md:w-1/2 flex-col justify-between p-12 gradient-left relative h-full">
                <div class="flex items-center gap-2">
                    <div
                        class="size-10 bg-gradient-to-br from-primary-orange to-primary-green rounded-xl flex items-center justify-center shadow-lg">
                        <span class="material-symbols-outlined text-white text-2xl">store</span>
                    </div>
                    <span class="text-xl font-bold gradient-text">Lokal-keun</span>
                </div>

                <div class="space-y-4">
                    <p class="text-base text-gray-700 font-medium">Kamu bisa dengan mudah</p>
                    <h2 class="text-4xl font-extrabold text-gray-900 leading-tight">
                        Dukung UMKM lokal dan tingkatkan ekonomi rakyat.
                    </h2>
                </div>

                <div class="flex gap-8">
                    <div>
                        <div class="text-2xl font-bold text-gray-900">10K+</div>
                        <div class="text-sm text-gray-600">UMKM</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-900">50K+</div>
                        <div class="text-sm text-gray-600">Produk</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-900">100K+</div>
                        <div class="text-sm text-gray-600">Pengguna</div>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-1/2 h-full overflow-y-auto custom-scroll p-8 md:p-12">

                <div class="md:hidden flex items-center gap-2 mb-8 justify-center">
                    <div
                        class="size-10 bg-gradient-to-br from-primary-orange to-primary-green rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-white text-2xl">store</span>
                    </div>
                    <span class="text-xl font-bold gradient-text">Lokal-keun</span>
                </div>

                <div class="mb-6">
                    <div
                        class="inline-flex items-center justify-center size-12 bg-orange-50 dark:bg-orange-900/30 rounded-2xl">
                        <span class="material-symbols-outlined text-3xl text-primary-orange">lock</span>
                    </div>
                </div>

                <div class="mb-8">
                    <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-2">
                        Masuk ke akun
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                        Kelola toko dan pesanan kamu dengan mudah – semua dalam satu platform.
                    </p>
                </div>

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf

                    @if ($errors->any())
                        <div
                            class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-200 px-4 py-3 rounded-xl text-sm">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div
                            class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-200 px-4 py-3 rounded-xl text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Email kamu
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com"
                            required
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-transparent focus:border-primary-orange rounded-xl text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-primary-orange/20 outline-none transition-all" />
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Password
                            </label>
                            <a href="#" class="text-xs font-bold text-primary-orange hover:underline">Lupa
                                Password?</a>
                        </div>
                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="••••••••" required
                                class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-transparent focus:border-primary-orange rounded-xl text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-primary-orange/20 outline-none transition-all" />
                            <button type="button" onclick="togglePassword()"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                <span class="material-symbols-outlined text-xl" id="password-icon">visibility_off</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="remember" id="remember"
                            class="w-4 h-4 rounded border-gray-300 text-primary-orange focus:ring-primary-orange" />
                        <label for="remember" class="text-sm text-gray-600 dark:text-gray-400">
                            Ingat saya
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full py-3.5 bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-bold rounded-xl hover:bg-gray-800 dark:hover:bg-gray-200 transition-all transform hover:scale-[1.01] active:scale-[0.99] mt-2 shadow-lg">
                        Masuk sekarang
                    </button>
                </form>

                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                    </div>
                    <div class="relative flex justify-center text-xs">
                        <span class="px-3 bg-white dark:bg-gray-800 text-gray-500 font-medium">atau lanjutkan
                            dengan</span>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <a href="{{ route('auth.google') }}"
                        class="py-3 px-4 bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 rounded-xl transition-all flex items-center justify-center">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="#4285F4"
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                            <path fill="#34A853"
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                            <path fill="#FBBC05"
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                            <path fill="#EA4335"
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                        </svg>
                    </a>
                    <a href="{{ route('auth.github') }}"
                        class="py-3 px-4 bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 rounded-xl transition-all flex items-center justify-center">
                        <svg class="w-5 h-5 fill-gray-900 dark:fill-white" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                        </svg>
                    </a>
                    <a href="{{ route('auth.apple') }}"
                        class="py-3 px-4 bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 rounded-xl transition-all flex items-center justify-center">
                        <svg class="w-5 h-5 fill-gray-900 dark:fill-white" viewBox="0 0 24 24">
                            <path
                                d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z" />
                        </svg>
                    </a>
                </div>

                <div class="text-center pt-4">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Belum punya akun? <a href="{{ route('register') }}"
                            class="font-bold text-primary-orange hover:text-orange-600 transition-colors">Daftar
                            Sekarang</a>
                    </p>
                </div>
            </div>

        </div>
    </div>

    <script>
        function togglePassword() {
            const field = document.getElementById('password');
            const icon = document.getElementById('password-icon');
            if (field.type === 'password') {
                field.type = 'text';
                icon.textContent = 'visibility';
            } else {
                field.type = 'password';
                icon.textContent = 'visibility_off';
            }
        }
    </script>
</body>

</html>
