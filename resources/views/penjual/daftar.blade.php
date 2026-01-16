<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Halaman Pendaftaran UMKM</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Tailwind Configuration -->
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary-orange": "#FF6B35",
                        "primary-green": "#4CAF50",
                        "orange-light": "#FFF5F2",
                        "orange-dark": "#E85A2A",
                        "green-light": "#F1F8F4",
                        "green-dark": "#3D8B40",
                        "background-light": "#FAFAFA",
                        "background-dark": "#101922",
                        "surface-dark": "#1a2632",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0px)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            },
                        }
                    }
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .material-symbols-outlined.filled {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .gradient-text {
            background: linear-gradient(135deg, #FF6B35 0%, #4CAF50 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark text-gray-900 dark:text-slate-50 transition-colors duration-200">
    <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden font-display">

        <!-- Top Navigation Bar -->
        <header
            class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-gray-200 dark:border-slate-800 bg-white/80 dark:bg-background-dark/90 backdrop-blur-md px-4 sm:px-10 py-3">
            <div class="flex items-center gap-4">
                <div
                    class="size-10 flex items-center justify-center rounded-xl bg-gradient-to-br from-primary-orange to-primary-green shadow-lg">
                    <span class="material-symbols-outlined text-2xl text-white">storefront</span>
                </div>
                <h2 class="text-gray-900 dark:text-white text-xl font-black leading-tight">Lokal<span
                        class="gradient-text">-keun</span></h2>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex flex-1 justify-end gap-8">
                <div class="flex items-center gap-9">
                    <a class="text-gray-900 dark:text-slate-200 hover:text-primary-orange dark:hover:text-primary-orange transition-colors text-sm font-semibold leading-normal"
                        href="#">Beranda</a>
                    <a class="text-gray-900 dark:text-slate-200 hover:text-primary-orange dark:hover:text-primary-orange transition-colors text-sm font-semibold leading-normal"
                        href="#">Jelajahi UMKM</a>
                    <a class="text-gray-900 dark:text-slate-200 hover:text-primary-orange dark:hover:text-primary-orange transition-colors text-sm font-semibold leading-normal"
                        href="#">Panduan</a>
                    <a class="text-gray-900 dark:text-slate-200 hover:text-primary-orange dark:hover:text-primary-orange transition-colors text-sm font-semibold leading-normal"
                        href="#">Kontak</a>
                </div>
                <button
                    class="px-6 py-2.5 bg-gradient-to-r from-primary-orange to-primary-green hover:shadow-lg hover:shadow-orange-500/30 text-white text-sm font-bold rounded-xl transition-all transform hover:scale-105">
                    <span class="truncate">Masuk</span>
                </button>
            </div>

            <!-- Mobile Menu Icon -->
            <button class="md:hidden p-2 text-gray-900 dark:text-white">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </header>

        <!-- Background Decorations -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <div
                class="absolute top-20 right-10 w-72 h-72 bg-primary-orange/10 rounded-full blur-3xl animate-pulse-slow">
            </div>
            <div class="absolute bottom-20 left-10 w-96 h-96 bg-primary-green/10 rounded-full blur-3xl animate-pulse-slow"
                style="animation-delay: 1s;"></div>
        </div>

        <div class="relative z-10 flex-1 flex justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col max-w-[1000px] w-full gap-10">

                <!-- Hero Section -->
                <div class="text-center space-y-6 pt-8">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 bg-orange-light dark:bg-orange-900/30 rounded-full mb-4">
                        <span class="w-2 h-2 bg-primary-orange rounded-full animate-pulse"></span>
                        <span class="text-sm font-bold text-primary-orange uppercase tracking-wider">Daftar
                            Sekarang</span>
                    </div>

                    <h1 class="text-4xl sm:text-6xl font-extrabold leading-tight">
                        Bergabung dengan <span class="gradient-text">Jaringan UMKM</span>
                    </h1>

                    <p class="text-gray-600 dark:text-slate-400 text-lg max-w-2xl mx-auto leading-relaxed">
                        Isi formulir di bawah ini untuk memperkenalkan produk Anda kepada ribuan pelanggan potensial.
                        <strong>100% Gratis</strong> dan mudah!
                    </p>

                    <!-- Stats -->
                    <div class="flex flex-wrap justify-center gap-8 pt-4">
                        <div class="text-center">
                            <div class="text-3xl font-bold gradient-text">10K+</div>
                            <div class="text-sm text-gray-500">UMKM Terdaftar</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold gradient-text">50K+</div>
                            <div class="text-sm text-gray-500">Produk Lokal</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold gradient-text">100K+</div>
                            <div class="text-sm text-gray-500">Pelanggan Aktif</div>
                        </div>
                    </div>
                </div>

                <!-- Main Form Container -->
                <form class="flex flex-col gap-8">

                    <!-- Section 1: Informasi Dasar -->
                    <div
                        class="group relative bg-white dark:bg-surface-dark rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 border-2 border-transparent hover:border-primary-orange/20 overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-48 h-48 bg-gradient-to-br from-primary-orange/5 to-transparent rounded-full -mr-24 -mt-24">
                        </div>

                        <div class="relative p-6 sm:p-8">
                            <div
                                class="flex items-center gap-4 mb-6 pb-5 border-b border-gray-100 dark:border-gray-700">
                                <div
                                    class="p-3 bg-gradient-to-br from-primary-orange to-orange-dark rounded-2xl shadow-lg text-white transform group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-2xl">badge</span>
                                </div>
                                <div>
                                    <h2 class="text-gray-900 dark:text-white text-2xl font-bold">Informasi Dasar Usaha
                                    </h2>
                                    <p class="text-sm text-gray-500">Perkenalkan bisnis Anda kepada kami</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <label class="flex flex-col gap-2">
                                    <span
                                        class="text-gray-900 dark:text-slate-200 text-sm font-bold flex items-center gap-1">
                                        Nama Usaha
                                        <span class="text-primary-orange">*</span>
                                    </span>
                                    <input
                                        class="form-input w-full rounded-xl text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary-orange/50 border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 focus:border-primary-orange h-12 px-4 text-base font-medium transition-all hover:border-primary-orange/50"
                                        placeholder="Contoh: Keripik Tempe Bu Ani" required />
                                </label>

                                <label class="flex flex-col gap-2">
                                    <span
                                        class="text-gray-900 dark:text-slate-200 text-sm font-bold flex items-center gap-1">
                                        Kategori Usaha
                                        <span class="text-primary-orange">*</span>
                                    </span>
                                    <select
                                        class="form-select w-full appearance-none rounded-xl text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary-orange/50 border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 focus:border-primary-orange h-12 px-4 text-base font-medium transition-all cursor-pointer hover:border-primary-orange/50"
                                        required>
                                        <option disabled selected value="">Pilih Kategori</option>
                                        <option value="kuliner">🍜 Kuliner & Makanan</option>
                                        <option value="fashion">👗 Fashion & Busana</option>
                                        <option value="kerajinan">🎨 Kerajinan Tangan</option>
                                        <option value="pertanian">🌾 Pertanian & Agrobisnis</option>
                                        <option value="jasa">🛠️ Jasa & Layanan</option>
                                    </select>
                                </label>

                                <label class="flex flex-col gap-2">
                                    <span
                                        class="text-gray-900 dark:text-slate-200 text-sm font-bold flex items-center gap-1">
                                        Nama Pemilik
                                        <span class="text-primary-orange">*</span>
                                    </span>
                                    <input
                                        class="form-input w-full rounded-xl text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary-orange/50 border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 focus:border-primary-orange h-12 px-4 text-base font-medium transition-all hover:border-primary-orange/50"
                                        placeholder="Nama Lengkap Anda" required />
                                </label>

                                <label class="flex flex-col gap-2">
                                    <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Tahun
                                        Berdiri</span>
                                    <input
                                        class="form-input w-full rounded-xl text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary-orange/50 border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 focus:border-primary-orange h-12 px-4 text-base font-medium transition-all hover:border-primary-orange/50"
                                        max="2099" min="1900" placeholder="Contoh: 2019" type="number" />
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Deskripsi -->
                    <div
                        class="group relative bg-white dark:bg-surface-dark rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 border-2 border-transparent hover:border-primary-green/20 overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-48 h-48 bg-gradient-to-br from-primary-green/5 to-transparent rounded-full -mr-24 -mt-24">
                        </div>

                        <div class="relative p-6 sm:p-8">
                            <div
                                class="flex items-center gap-4 mb-6 pb-5 border-b border-gray-100 dark:border-gray-700">
                                <div
                                    class="p-3 bg-gradient-to-br from-primary-green to-green-dark rounded-2xl shadow-lg text-white transform group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-2xl">description</span>
                                </div>
                                <div>
                                    <h2 class="text-gray-900 dark:text-white text-2xl font-bold">Tentang Usaha</h2>
                                    <p class="text-sm text-gray-500">Ceritakan keunikan produk Anda</p>
                                </div>
                            </div>

                            <label class="flex flex-col gap-2">
                                <span
                                    class="text-gray-900 dark:text-slate-200 text-sm font-bold flex items-center gap-1">
                                    Deskripsi Singkat
                                    <span class="text-primary-orange">*</span>
                                </span>
                                <textarea
                                    class="form-textarea w-full resize-y rounded-xl text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary-green/50 border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 focus:border-primary-green p-4 text-base font-medium transition-all hover:border-primary-green/50"
                                    placeholder="Ceritakan tentang sejarah singkat, keunggulan produk, dan nilai unik dari usaha Anda..." required
                                    rows="5"></textarea>
                                <p class="text-xs text-gray-500 text-right">Minimal 50 karakter</p>
                            </label>
                        </div>
                    </div>

                    <!-- Section 3: Kontak & Lokasi -->
                    <div
                        class="group relative bg-white dark:bg-surface-dark rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 border-2 border-transparent hover:border-primary-orange/20 overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-48 h-48 bg-gradient-to-br from-primary-orange/5 to-transparent rounded-full -mr-24 -mt-24">
                        </div>

                        <div class="relative p-6 sm:p-8">
                            <div
                                class="flex items-center gap-4 mb-6 pb-5 border-b border-gray-100 dark:border-gray-700">
                                <div
                                    class="p-3 bg-gradient-to-br from-primary-orange to-orange-dark rounded-2xl shadow-lg text-white transform group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-2xl">location_on</span>
                                </div>
                                <div>
                                    <h2 class="text-gray-900 dark:text-white text-2xl font-bold">Kontak & Lokasi</h2>
                                    <p class="text-sm text-gray-500">Agar pelanggan dapat menghubungi Anda</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <label class="flex flex-col gap-2">
                                    <span
                                        class="text-gray-900 dark:text-slate-200 text-sm font-bold flex items-center gap-1">
                                        Nomor WhatsApp / Telepon
                                        <span class="text-primary-orange">*</span>
                                    </span>
                                    <div class="relative flex items-center">
                                        <span
                                            class="absolute left-4 text-primary-orange material-symbols-outlined text-xl">call</span>
                                        <input
                                            class="form-input pl-12 w-full rounded-xl text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary-orange/50 border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 focus:border-primary-orange h-12 text-base font-medium transition-all hover:border-primary-orange/50"
                                            placeholder="0812-3456-7890" required type="tel" />
                                    </div>
                                </label>

                                <label class="flex flex-col gap-2">
                                    <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Alamat
                                        Email</span>
                                    <div class="relative flex items-center">
                                        <span
                                            class="absolute left-4 text-primary-green material-symbols-outlined text-xl">mail</span>
                                        <input
                                            class="form-input pl-12 w-full rounded-xl text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary-green/50 border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 focus:border-primary-green h-12 text-base font-medium transition-all hover:border-primary-green/50"
                                            placeholder="contoh@email.com" type="email" />
                                    </div>
                                </label>
                            </div>

                            <label class="flex flex-col gap-2">
                                <span
                                    class="text-gray-900 dark:text-slate-200 text-sm font-bold flex items-center gap-1">
                                    Alamat Lengkap
                                    <span class="text-primary-orange">*</span>
                                </span>
                                <textarea
                                    class="form-textarea w-full resize-none rounded-xl text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary-orange/50 border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 focus:border-primary-orange p-4 text-base font-medium transition-all hover:border-primary-orange/50"
                                    placeholder="Nama Jalan, RT/RW, Kelurahan, Kecamatan..." required rows="3"></textarea>
                            </label>
                        </div>
                    </div>

                    <!-- Section 4: Upload Media -->
                    <div
                        class="group relative bg-white dark:bg-surface-dark rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 border-2 border-transparent hover:border-primary-green/20 overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-48 h-48 bg-gradient-to-br from-primary-green/5 to-transparent rounded-full -mr-24 -mt-24">
                        </div>

                        <div class="relative p-6 sm:p-8">
                            <div
                                class="flex items-center gap-4 mb-6 pb-5 border-b border-gray-100 dark:border-gray-700">
                                <div
                                    class="p-3 bg-gradient-to-br from-primary-green to-green-dark rounded-2xl shadow-lg text-white transform group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-2xl">add_photo_alternate</span>
                                </div>
                                <div>
                                    <h2 class="text-gray-900 dark:text-white text-2xl font-bold">Galeri Produk</h2>
                                    <p class="text-sm text-gray-500">Tampilkan produk terbaik Anda</p>
                                </div>
                            </div>

                            <div class="flex flex-col gap-4">
                                <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Unggah Foto Produk &
                                    Lokasi</span>

                                <div
                                    class="border-2 border-dashed border-primary-green/30 dark:border-primary-green/50 rounded-2xl p-10 flex flex-col items-center justify-center text-center gap-4 bg-green-light/30 dark:bg-green-900/10 hover:bg-green-light/50 dark:hover:bg-green-900/20 hover:border-primary-green transition-all cursor-pointer group/upload">
                                    <div
                                        class="size-20 rounded-2xl bg-gradient-to-br from-primary-green/20 to-green-dark/20 flex items-center justify-center text-primary-green group-hover/upload:scale-110 transition-transform shadow-lg">
                                        <span class="material-symbols-outlined text-4xl">cloud_upload</span>
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <p class="text-gray-900 dark:text-white font-bold text-lg">Klik untuk unggah
                                            atau seret foto ke sini</p>
                                        <p class="text-gray-500 dark:text-slate-400 text-sm">Mendukung JPG, PNG (Maks.
                                            5MB per file)</p>
                                    </div>
                                </div>

                                <!-- Preview Slots -->
                                <div class="flex gap-4 overflow-x-auto py-2">
                                    <div
                                        class="w-28 h-28 rounded-2xl bg-gradient-to-br from-gray-100 to-gray-50 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center border-2 border-gray-200 dark:border-slate-600 shrink-0 hover:border-primary-green transition-colors cursor-pointer group/slot">
                                        <span
                                            class="material-symbols-outlined text-gray-400 text-3xl group-hover/slot:text-primary-green transition-colors">image</span>
                                    </div>
                                    <div
                                        class="w-28 h-28 rounded-2xl bg-gradient-to-br from-gray-100 to-gray-50 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center border-2 border-gray-200 dark:border-slate-600 shrink-0 hover:border-primary-green transition-colors cursor-pointer group/slot">
                                        <span
                                            class="material-symbols-outlined text-gray-400 text-3xl group-hover/slot:text-primary-green transition-colors">image</span>
                                    </div>
                                    <div
                                        class="w-28 h-28 rounded-2xl bg-gradient-to-br from-gray-100 to-gray-50 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center border-2 border-gray-200 dark:border-slate-600 shrink-0 hover:border-primary-green transition-colors cursor-pointer group/slot">
                                        <span
                                            class="material-symbols-outlined text-gray-400 text-3xl group-hover/slot:text-primary-green transition-colors">image</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Area -->
                    <div
                        class="sticky bottom-0 bg-white/95 dark:bg-surface-dark/95 backdrop-blur-xl p-6 -mx-4 sm:mx-0 sm:p-0 sm:bg-transparent sm:backdrop-blur-none sm:relative flex flex-col-reverse sm:flex-row justify-between items-center gap-4 border-t sm:border-t-0 border-gray-200 dark:border-slate-800 rounded-t-3xl sm:rounded-none shadow-2xl sm:shadow-none">
                        <div class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-400">
                            <span class="material-symbols-outlined text-primary-green">verified</span>
                            <span class="font-semibold">100% Gratis • Setup dalam 5 menit</span>
                        </div>

                        <div class="flex flex-col-reverse sm:flex-row gap-3 w-full sm:w-auto">
                            <button
                                class="w-full sm:w-auto px-8 py-3.5 rounded-xl border-2 border-gray-300 dark:border-slate-600 bg-transparent hover:bg-gray-50 dark:hover:bg-slate-800 text-gray-900 dark:text-slate-200 text-base font-bold transition-all transform hover:scale-105"
                                type="button">
                                <span class="truncate">Simpan Draf</span>
                            </button>
                            <button
                                class="w-full sm:w-auto px-10 py-3.5 bg-gradient-to-r from-primary-orange to-primary-green hover:shadow-2xl hover:shadow-orange-500/40 text-white text-base font-bold rounded-xl transition-all transform hover:scale-105 flex items-center justify-center gap-2"
                                type="submit">
                                <span class="material-symbols-outlined">rocket_launch</span>
                                <span class="truncate">Daftarkan Usaha</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <footer class="py-12 border-t border-gray-200 dark:border-slate-800 mt-auto bg-white dark:bg-surface-dark">
            <div class="max-w-7xl mx-auto px-4 sm:px-10">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex items-center gap-3">
                        <div
                            class="size-10 flex items-center justify-center rounded-xl bg-gradient-to-br from-primary-orange to-primary-green shadow-lg">
                            <span class="material-symbols-outlined text-2xl text-white">storefront</span>
                        </div>
                        <div>
                            <h3 class="font-black text-lg">Lokal<span class="gradient-text">-keun</span></h3>
                            <p class="text-xs text-gray-500">Platform Pemberdayaan UMKM</p>
                        </div>
                    </div>
                    <p class="text-gray-500 dark:text-slate-500 text-sm text-center">© 2024 Lokal-keun. Mendukung
                        Ekonomi Lokal Indonesia 🇮🇩</p>
                    <div class="flex gap-3">
                        <a href="#"
                            class="p-2 rounded-lg bg-gray-100 dark:bg-slate-800 hover:bg-primary-orange/10 text-gray-600 dark:text-gray-400 hover:text-primary-orange transition-all">
                            <span class="material-symbols-outlined">help</span>
                        </a>
                        <a href="#"
                            class="p-2 rounded-lg bg-gray-100 dark:bg-slate-800 hover:bg-primary-green/10 text-gray-600 dark:text-gray-400 hover:text-primary-green transition-all">
                            <span class="material-symbols-outlined">support_agent</span>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
