<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Daftar - Lokal-keun</title>

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
    class="bg-gray-100 dark:bg-gray-900 font-display h-screen w-screen overflow-hidden flex items-center justify-center">

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

            <div class="hidden md:flex md:w-1/2 flex-col justify-between p-10 gradient-left relative h-full">
                <div class="flex items-center gap-2">
                    <div
                        class="size-10 bg-gradient-to-br from-primary-orange to-primary-green rounded-xl flex items-center justify-center shadow-lg">
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
                    <div
                        class="size-10 bg-gradient-to-br from-primary-orange to-primary-green rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-white text-2xl">store</span>
                    </div>
                    <span class="text-xl font-bold gradient-text">Lokal-keun</span>
                </div>

                <div class="mb-6">
                    <div
                        class="inline-flex items-center justify-center size-12 bg-green-50 dark:bg-green-900/30 rounded-2xl mb-4">
                        <span class="material-symbols-outlined text-3xl text-primary-green">person_add</span>
                    </div>
                    <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-2">
                        Buat akun baru
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                        Lengkapi data di bawah untuk memulai perjalanan kamu.
                    </p>
                </div>

                <form action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="role" id="roleInput" value="{{ old('role', 'buyer') }}">

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

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Daftar sebagai
                        </label>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="role-card {{ old('role', 'buyer') == 'buyer' ? 'selected' : '' }} cursor-pointer p-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl"
                                onclick="selectRole(this, 'buyer')">
                                <div class="flex flex-col items-center text-center gap-1.5">
                                    <div
                                        class="size-10 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center">
                                        <span
                                            class="material-symbols-outlined text-xl text-primary-orange">shopping_bag</span>
                                    </div>
                                    <div>
                                        <div class="font-bold text-sm text-gray-900 dark:text-white">Pembeli</div>
                                        <div class="text-[10px] text-gray-500">Belanja produk</div>
                                    </div>
                                </div>
                            </div>
                            <div class="role-card {{ old('role') == 'seller' ? 'selected' : '' }} cursor-pointer p-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl"
                                onclick="selectRole(this, 'seller')">
                                <div class="flex flex-col items-center text-center gap-1.5">
                                    <div
                                        class="size-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                                        <span
                                            class="material-symbols-outlined text-xl text-primary-green">storefront</span>
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
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Nama
                                lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                placeholder="Masukkan nama lengkap" required
                                class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-xl text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-primary-orange text-sm transition-all" />
                        </div>

                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                placeholder="nama@email.com" required
                                class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-xl text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-primary-orange text-sm transition-all" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Nomor
                                WhatsApp</label>
                            <input type="tel" name="whatsapp" value="{{ old('whatsapp') }}"
                                placeholder="08xxxxxxxxxx" required pattern="08[0-9]{8,13}"
                                class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-xl text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-primary-orange text-sm transition-all" />
                            <p class="text-xs text-gray-500 mt-1">Format: 08xxxxxxxxxx (10-15 digit)</p>
                        </div>

                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Password</label>
                            <div class="relative">
                                <input type="password" name="password" id="password"
                                    placeholder="Minimal 8 karakter" required minlength="8"
                                    class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-0 rounded-xl text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-primary-orange text-sm transition-all" />
                                <button type="button" onclick="togglePassword('password')"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                    <span class="material-symbols-outlined text-lg"
                                        id="password-icon">visibility_off</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-2 mt-4">
                        <input type="checkbox" name="terms" required
                            class="mt-0.5 w-4 h-4 rounded border-gray-300 text-primary-orange focus:ring-primary-orange" />
                        <label class="text-xs text-gray-600 dark:text-gray-400 leading-snug">
                            Saya setuju dengan <a href="#"
                                class="font-bold text-primary-orange hover:underline">Syarat & Ketentuan</a> serta <a
                                href="#" class="font-bold text-primary-orange hover:underline">Kebijakan
                                Privasi</a>
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-bold rounded-xl hover:bg-gray-800 dark:hover:bg-gray-200 transition-all transform hover:scale-[1.01] active:scale-[0.99] shadow-lg mt-2">
                        Daftar sekarang
                    </button>
                </form>

                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                    </div>
                </div>
                <div class="text-center pt-6 pb-2">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Sudah punya akun? <a href="{{ route('login') }}"
                            class="font-bold text-primary-orange hover:text-orange-600 transition-colors">Masuk</a>
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

        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '-icon');
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
