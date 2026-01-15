<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Daftar - Lokal-keun</title>
    
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    
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
                    rgba(232, 245, 233, 0.4) 0%,
                    rgba(200, 230, 201, 0.5) 40%,
                    rgba(76, 175, 80, 0.6) 70%,
                    rgba(129, 199, 132, 0.5) 100%);
        }

        .role-card {
            transition: all 0.3s ease;
        }

        .role-card:hover {
            transform: translateY(-2px);
        }

        .role-card.selected {
            border-color: #FF6B35;
            background: linear-gradient(135deg, rgba(255, 107, 53, 0.05) 0%, rgba(76, 175, 80, 0.05) 100%);
            box-shadow: 0 4px 6px -1px rgba(255, 107, 53, 0.1);
        }
        
        /* Custom Scrollbar untuk Form */
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

<body class="bg-gray-100 dark:bg-gray-900 font-display h-screen w-screen overflow-hidden flex items-center justify-center">

    <a href="{{ url('/') }}" class="absolute top-6 left-6 z-50 flex items-center gap-2 px-4 py-2 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-full shadow-sm hover:shadow-md transition-all group border border-gray-200 dark:border-gray-700">
        <span class="material-symbols-outlined text-gray-600 dark:text-gray-300 group-hover:text-primary-orange transition-colors text-lg">arrow_back</span>
        <span class="text-sm font-bold text-gray-600 dark:text-gray-300 group-hover:text-primary-orange transition-colors">Kembali</span>
    </a>

    <div class="w-full h-full p-4 md:p-6 flex items-center justify-center">
        
        <div class="w-full max-w-5xl h-full md:h-[90vh] bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
            
            <div class="hidden md:flex md:w-1/2 flex-col justify-between p-10 gradient-left relative h-full">
                <div class="flex items-center gap-2">
                    <div class="size-10 bg-gradient-to-br from-primary-orange to-primary-green rounded-xl flex items-center justify-center shadow-lg">
                        <span class="material-symbols-outlined text-white text-2xl">store</span>
                    </div>
                    <span class="text-xl font-bold gradient-text">Lokal-keun</span>
                </div>

                <div class="space-y-4">
                    <p class="text-base text-gray-700 font-medium">Mari bergabung bersama</p>
                    <h2 class="text-4xl font-extrabold text-gray-900 leading-tight">
                        Bangun ekosistem UMKM yang lebih kuat dan berkelanjutan.
                    </h2>
                </div>

                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <div class="size-8 bg-white/50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-primary-green text-xl">check_circle</span>
                        </div>
                        <div>
                            <div class="font-bold text-gray-900">100% Gratis</div>
                            <div class="text-sm text-gray-600">Tanpa biaya pendaftaran</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="size-8 bg-white/50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-primary-green text-xl">security</span>
                        </div>
                        <div>
                            <div class="font-bold text-gray-900">Aman & Terpercaya</div>
                            <div class="text-sm text-gray-600">Data terenkripsi dengan baik</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="size-8 bg-white/50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-primary-green text-xl">support_agent</span>
                        </div>
                        <div>
                            <div class="font-bold text-gray-900">Support 24/7</div>
                            <div class="text-sm text-gray-600">Tim siap membantu kapan saja</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-1/2 h-full overflow-y-auto custom-scroll p-6 md:p-10">
                
                <div class="md:hidden flex items-center gap-2 mb-6 justify-center">
                    <div class="size-10 bg-gradient-to-br from-primary-orange to-primary-green rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-white text-2xl">store</span>
                    </div>
                    <span class="text-xl font-bold gradient-text">Lokal-keun</span>
                </div>

                <div class="mb-6">
                    <div class="inline-flex items-center justify-center size-12 bg-green-50 dark:bg-green-900/30 rounded-2xl mb-4">
                        <span class="material-symbols-outlined text-3xl text-primary-green">person_add</span>
                    </div>
                    <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-2">
                        Buat akun baru
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                        Lengkapi data di bawah untuk memulai perjalanan kamu.
                    </p>
                </div>

                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="role" id="roleInput" value="buyer">

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Daftar sebagai
                        </label>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="role-card selected cursor-pointer p-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl" onclick="selectRole(this, 'buyer')">
                                <div class="flex flex-col items-center text-center gap-1.5">
                                    <div class="size-10 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center">
                                        <span class="material-symbols-outlined text-xl text-primary-orange">shopping_bag</span>
                                    </div>
                                    <div>
                                        <div class="font-bold text-sm text-gray-900 dark:text-white">Pembeli</div>
                                        <div class="text-[10px] text-gray-500">Belanja produk</div>
                                    </div>
                                </div>
                            </div>
                            <div class="role-card cursor-pointer p-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl" onclick="selectRole(this, 'seller')">
                                <div class="flex flex-col items-center text-center gap-1.5">
                                    <div class="size-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                                        <span class="material-symbols-outlined text-xl text-primary-green">storefront</span>
                                    </div>
                                    <div>
                                        <div class="font-bold text-sm text-gray-900 dark:text-white">Penjual</div>
                                        <div class="text-[10px] text-gray-500">Jual produk</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Nama lengkap</label>
                            <input type="text" name="name" placeholder="Masukkan nama lengkap" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-xl text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-primary-orange text-sm transition-all" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Email</label>
                            <input type="email" name="email" placeholder="nama@email.com" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-xl text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-primary-orange text-sm transition-all" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Nomor WhatsApp</label>
                            <input type="tel" name="whatsapp" placeholder="08xxxxxxxxxx" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-xl text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-primary-orange text-sm transition-all" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Password</label>
                            <div class="relative">
                                <input type="password" name="password" placeholder="Minimal 8 karakter" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-xl text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-primary-orange text-sm transition-all" />
                                <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                    <span class="material-symbols-outlined text-lg">visibility_off</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-2 mt-4">
                        <input type="checkbox" required class="mt-0.5 w-4 h-4 rounded border-gray-300 text-primary-orange focus:ring-primary-orange" />
                        <label class="text-xs text-gray-600 dark:text-gray-400 leading-snug">
                            Saya setuju dengan <a href="#" class="font-bold text-primary-orange hover:underline">Syarat & Ketentuan</a> serta <a href="#" class="font-bold text-primary-orange hover:underline">Kebijakan Privasi</a>
                        </label>
                    </div>

                    <button type="submit" class="w-full py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-bold rounded-xl hover:bg-gray-800 dark:hover:bg-gray-200 transition-all transform hover:scale-[1.01] active:scale-[0.99] shadow-lg mt-2">
                        Daftar sekarang
                    </button>
                </form>

                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200 dark:border-gray-700"></div></div>
                    <div class="relative flex justify-center text-xs"><span class="px-3 bg-white dark:bg-gray-800 text-gray-500 font-medium">atau daftar dengan</span></div>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <button class="py-2.5 px-4 bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 rounded-xl transition-all flex items-center justify-center">
                        <svg class="w-5 h-5" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" /><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" /><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" /><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" /></svg>
                    </button>
                    <button class="py-2.5 px-4 bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 rounded-xl transition-all flex items-center justify-center">
                         <svg class="w-5 h-5 fill-gray-900 dark:fill-white" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" /></svg>
                    </button>
                    <button class="py-2.5 px-4 bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 rounded-xl transition-all flex items-center justify-center">
                        <svg class="w-5 h-5 fill-gray-900 dark:fill-white" viewBox="0 0 24 24"><path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z" /></svg>
                    </button>
                </div>

                <div class="text-center pt-6 pb-2">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-primary-orange hover:text-orange-600 transition-colors">Masuk</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectRole(element, role) {
            document.querySelectorAll('.role-card').forEach(card => card.classList.remove('selected'));
            element.classList.add('selected');
            document.getElementById('roleInput').value = role;
        }
    </script>
</body>
</html>