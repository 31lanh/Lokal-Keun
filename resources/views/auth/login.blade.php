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
