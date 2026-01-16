@extends('layouts.app')

@section('content')

{{-- CSS Tambahan dari kode asli agar tampilan 100% sama --}}
<style>
    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #FF6B35, #4CAF50); border-radius: 20px; }

    /* Gradient Text & Border */
    .gradient-text {
        background: linear-gradient(135deg, #FF6B35 0%, #4CAF50 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .gradient-border {
        border: 2px solid transparent;
        background: linear-gradient(white, white) padding-box, linear-gradient(135deg, #FF6B35, #4CAF50) border-box;
    }

    /* Card Hover Effect */
    .card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(255, 107, 53, 0.2);
    }
</style>

<section class="relative pt-32 pb-12 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <div class="absolute top-20 right-10 w-72 h-72 bg-primary-orange/20 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-20 left-10 w-96 h-96 bg-primary-green/20 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-6 mb-12 animate-slide-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-orange-light dark:bg-orange-900/30 rounded-full">
                <span class="w-2 h-2 bg-primary-orange rounded-full animate-pulse"></span>
                <span class="text-sm font-semibold text-primary-orange">148 UMKM Tersedia</span>
            </div>

            <h1 class="text-5xl md:text-6xl font-extrabold leading-tight">
                Jelajahi <span class="gradient-text">UMKM Pilihan</span>
            </h1>

            <p class="text-xl text-gray-600 dark:text-gray-300 leading-relaxed max-w-2xl mx-auto">
                Temukan produk dan jasa lokal terbaik dari wirausaha di sekitarmu
            </p>

            <div class="bg-white dark:bg-surface-dark p-2 rounded-2xl shadow-2xl shadow-orange-500/10 max-w-3xl mx-auto">
                <div class="flex flex-col md:flex-row gap-2">
                    <div class="flex-1 flex items-center px-4 py-3 bg-gray-50 dark:bg-gray-800 rounded-xl group">
                        <span class="material-symbols-outlined text-primary-orange mr-3 group-hover:scale-110 transition-transform">search</span>
                        <input class="bg-transparent border-none w-full text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-0 p-0" placeholder="Cari UMKM, produk, atau kategori..." type="text" />
                    </div>
                    <button class="px-6 py-3 bg-gradient-to-r from-primary-orange to-primary-green hover:shadow-lg hover:shadow-orange-500/50 text-white font-bold rounded-xl transition-all transform hover:scale-105 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">search</span>
                        <span>Cari Sekarang</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    <div class="flex flex-col lg:flex-row gap-8">
        <aside class="w-full lg:w-72 flex-shrink-0">
            <div class="lg:hidden mb-4">
                <button class="flex items-center justify-center w-full px-6 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm font-bold text-gray-700 dark:text-gray-200 bg-white dark:bg-surface-dark hover:border-primary-orange transition-all">
                    <span class="material-symbols-outlined mr-2">tune</span>
                    Filter & Urutkan
                </button>
            </div>

            <div class="hidden lg:block space-y-6">
                <div class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-800">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-orange">category</span>
                        <span>Kategori</span>
                    </h3>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 cursor-pointer group p-2 rounded-lg hover:bg-orange-light dark:hover:bg-orange-900/20 transition-all">
                            <input checked class="h-5 w-5 rounded border-gray-300 text-primary-orange focus:ring-primary-orange dark:border-gray-600 dark:bg-gray-800" type="checkbox" />
                            <span class="text-gray-700 dark:text-gray-300 group-hover:text-primary-orange font-medium transition-colors">Kuliner (F&B)</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group p-2 rounded-lg hover:bg-green-light dark:hover:bg-green-900/20 transition-all">
                            <input class="h-5 w-5 rounded border-gray-300 text-primary-green focus:ring-primary-green dark:border-gray-600 dark:bg-gray-800" type="checkbox" />
                            <span class="text-gray-700 dark:text-gray-300 group-hover:text-primary-green font-medium transition-colors">Fashion & Aksesoris</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group p-2 rounded-lg hover:bg-orange-light dark:hover:bg-orange-900/20 transition-all">
                            <input class="h-5 w-5 rounded border-gray-300 text-primary-orange focus:ring-primary-orange dark:border-gray-600 dark:bg-gray-800" type="checkbox" />
                            <span class="text-gray-700 dark:text-gray-300 group-hover:text-primary-orange font-medium transition-colors">Kerajinan Tangan</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group p-2 rounded-lg hover:bg-green-light dark:hover:bg-green-900/20 transition-all">
                            <input class="h-5 w-5 rounded border-gray-300 text-primary-green focus:ring-primary-green dark:border-gray-600 dark:bg-gray-800" type="checkbox" />
                            <span class="text-gray-700 dark:text-gray-300 group-hover:text-primary-green font-medium transition-colors">Jasa & Layanan</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group p-2 rounded-lg hover:bg-orange-light dark:hover:bg-orange-900/20 transition-all">
                            <input class="h-5 w-5 rounded border-gray-300 text-primary-orange focus:ring-primary-orange dark:border-gray-600 dark:bg-gray-800" type="checkbox" />
                            <span class="text-gray-700 dark:text-gray-300 group-hover:text-primary-orange font-medium transition-colors">Agrobisnis</span>
                        </label>
                    </div>
                </div>

                <div class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-800">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-green">location_on</span>
                        <span>Lokasi</span>
                    </h3>
                    <div class="relative mb-4">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-primary-green">
                            <span class="material-symbols-outlined text-[20px]">pin_drop</span>
                        </span>
                        <select class="block w-full pl-10 pr-4 py-3 text-base border-gray-200 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-green focus:border-transparent rounded-xl dark:bg-gray-800 dark:text-white font-medium">
                            <option>Semua Lokasi</option>
                            <option>Jakarta Selatan</option>
                            <option>Jakarta Pusat</option>
                            <option>Bandung</option>
                            <option>Surabaya</option>
                        </select>
                    </div>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 cursor-pointer group p-2 rounded-lg hover:bg-green-light dark:hover:bg-green-900/20 transition-all">
                            <input class="h-4 w-4 border-gray-300 text-primary-green focus:ring-primary-green dark:border-gray-600 dark:bg-gray-800" name="distance" type="radio" />
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">< 1 km</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group p-2 rounded-lg hover:bg-green-light dark:hover:bg-green-900/20 transition-all">
                            <input class="h-4 w-4 border-gray-300 text-primary-green focus:ring-primary-green dark:border-gray-600 dark:bg-gray-800" name="distance" type="radio" />
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">1 - 5 km</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group p-2 rounded-lg hover:bg-green-light dark:hover:bg-green-900/20 transition-all">
                            <input checked class="h-4 w-4 border-gray-300 text-primary-green focus:ring-primary-green dark:border-gray-600 dark:bg-gray-800" name="distance" type="radio" />
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">Semua Jarak</span>
                        </label>
                    </div>
                </div>

                <div class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-800">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-amber-500 filled">star</span>
                        <span>Rating</span>
                    </h3>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 cursor-pointer group p-2 rounded-lg hover:bg-amber-50 dark:hover:bg-amber-900/20 transition-all">
                            <input class="h-5 w-5 rounded border-gray-300 text-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-800" type="checkbox" />
                            <div class="flex items-center text-amber-400">
                                @for($i=0; $i<5; $i++) <span class="material-symbols-outlined fill-current text-[18px]">star</span> @endfor
                                <span class="text-sm text-gray-700 dark:text-gray-300 ml-2 font-medium">& Up</span>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group p-2 rounded-lg hover:bg-amber-50 dark:hover:bg-amber-900/20 transition-all">
                            <input class="h-5 w-5 rounded border-gray-300 text-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-800" type="checkbox" />
                            <div class="flex items-center text-amber-400">
                                @for($i=0; $i<4; $i++) <span class="material-symbols-outlined fill-current text-[18px]">star</span> @endfor
                                <span class="material-symbols-outlined text-[18px]">star</span>
                                <span class="text-sm text-gray-700 dark:text-gray-300 ml-2 font-medium">& Up</span>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex-1">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 bg-white dark:bg-surface-dark p-6 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800">
                <div class="flex items-center gap-2">
                    <p class="text-gray-600 dark:text-gray-300 text-base">
                        Menampilkan <span class="font-bold text-primary-orange text-lg">12</span> dari
                        <span class="font-bold text-primary-green text-lg">148</span> hasil
                    </p>
                </div>
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <label class="text-sm text-gray-500 font-semibold whitespace-nowrap flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">sort</span>
                        Urutkan:
                    </label>
                    <div class="relative w-full sm:w-56">
                        <select class="block w-full px-4 py-3 text-sm border-gray-200 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-orange focus:border-transparent rounded-xl bg-gray-50 dark:bg-gray-800 dark:text-white font-medium cursor-pointer">
                            <option>Paling Relevan</option>
                            <option>Terbaru</option>
                            <option>Rating Tertinggi</option>
                            <option>Terlaris</option>
                            <option>Terdekat</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                <div class="group bg-white dark:bg-surface-dark rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 dark:border-gray-800">
                    <div class="relative h-56 overflow-hidden">
                        <div class="absolute top-4 right-4 z-10">
                            <button class="p-2.5 rounded-full bg-white/90 backdrop-blur-sm text-gray-400 hover:bg-white hover:text-red-500 transition-all shadow-lg transform hover:scale-110">
                                <span class="material-symbols-outlined text-[22px]">favorite</span>
                            </button>
                        </div>
                        <div class="absolute top-4 left-4 z-10">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r from-green-400 to-green-600 text-white shadow-lg">
                                <span class="w-1.5 h-1.5 bg-white rounded-full mr-2 animate-pulse"></span>
                                Buka
                            </span>
                        </div>
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAH-r_3740txB_8yriQQTGsCciGpxUi8rrtMIJgRVNrAKhwbWpBszv3KnB-gzEBk3uNMmi53gb5SqOyFHC3nplAkYcvTXl4ZhbVkDET9SIqx4Tn8JEtypviaYk3TpaTDgv2eUkVI9Kq28l5hdYYuKOgGs9z5dx1gesJJfE_BZrakAGXJ3S7ccKb5DSsoc7AZwWHqdtpc9JnPPpLFDBrAp5frVj18I_-dai1-Y3G-9kBq1Qdn_kg52HBX8-_x2GYYK2mtb63qAnEjeAB" alt="Traditional Food" />
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-xs font-bold tracking-wide uppercase text-primary-orange bg-orange-light dark:bg-orange-900/30 px-3 py-1.5 rounded-lg">Kuliner</span>
                            <div class="flex items-center gap-1 bg-amber-50 dark:bg-amber-900/20 px-2.5 py-1.5 rounded-lg">
                                <span class="material-symbols-outlined text-[16px] text-amber-500 filled">star</span>
                                <span class="text-sm font-bold text-amber-600 dark:text-amber-400">4.8</span>
                                <span class="text-xs text-gray-400">(124)</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-primary-orange transition-colors cursor-pointer">
                            Dapur Bu Sri
                        </h3>
                        <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm mb-4">
                            <span class="material-symbols-outlined text-[18px] mr-1 text-primary-green">location_on</span>
                            Yogyakarta
                        </div>
                        <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400 font-semibold">Mulai dari <span class="text-primary-orange font-bold">Rp 15rb</span></span>
                            <a class="text-sm font-bold text-primary-orange hover:text-orange-dark flex items-center gap-1 group/link" href="">
                                Lihat Detail
                                <span class="material-symbols-outlined text-[18px] group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="group bg-white dark:bg-surface-dark rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 dark:border-gray-800">
                    <div class="relative h-56 overflow-hidden">
                        <div class="absolute top-4 right-4 z-10">
                            <button class="p-2.5 rounded-full bg-white/90 backdrop-blur-sm text-gray-400 hover:bg-white hover:text-red-500 transition-all shadow-lg transform hover:scale-110">
                                <span class="material-symbols-outlined text-[22px]">favorite</span>
                            </button>
                        </div>
                        <div class="absolute top-4 left-4 z-10">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r from-green-400 to-green-600 text-white shadow-lg">
                                <span class="w-1.5 h-1.5 bg-white rounded-full mr-2 animate-pulse"></span>
                                Buka
                            </span>
                        </div>
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBpNauF4qKyBaOAEfCF5owab-gOZ_j3q864h4x4po7b6OywhnW4KWR3hkcKXonA_AJl1clWGFq-zGJz0gBHYwmvS8Y7-ZzTW8gjADs-BEUAumZuBRC2uJ5F-QjUnm1ZaPd6dVOtROvf3XCe2937Un5KYPH1IDNOTvgpx7oPDfPDSzvzkoZmKvdp_bkwO85vpQN_qpsw3yEI8WyUlui2w3iPEN9PSusoStgCOfns28-OKMvp0dXkKThA0KoM7DY_Mzd5m6eVKn1nWuPc" alt="Batik Fashion" />
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-xs font-bold tracking-wide uppercase text-purple-600 bg-purple-100 dark:bg-purple-900/30 px-3 py-1.5 rounded-lg">Fashion</span>
                            <div class="flex items-center gap-1 bg-amber-50 dark:bg-amber-900/20 px-2.5 py-1.5 rounded-lg">
                                <span class="material-symbols-outlined text-[16px] text-amber-500 filled">star</span>
                                <span class="text-sm font-bold text-amber-600 dark:text-amber-400">4.9</span>
                                <span class="text-xs text-gray-400">(86)</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-primary-green transition-colors cursor-pointer">
                            Batik Modern Nusantara
                        </h3>
                        <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm mb-4">
                            <span class="material-symbols-outlined text-[18px] mr-1 text-primary-green">location_on</span>
                            Solo
                        </div>
                        <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400 font-semibold">Mulai dari <span class="text-primary-green font-bold">Rp 150rb</span></span>
                            <a class="text-sm font-bold text-primary-green hover:text-green-dark flex items-center gap-1 group/link" href="#">
                                Lihat Detail
                                <span class="material-symbols-outlined text-[18px] group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="group bg-white dark:bg-surface-dark rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 dark:border-gray-800">
                    <div class="relative h-56 overflow-hidden">
                        <div class="absolute top-4 right-4 z-10">
                            <button class="p-2.5 rounded-full bg-white/90 backdrop-blur-sm text-gray-400 hover:bg-white hover:text-red-500 transition-all shadow-lg transform hover:scale-110">
                                <span class="material-symbols-outlined text-[22px]">favorite</span>
                            </button>
                        </div>
                        <div class="absolute top-4 left-4 z-10">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 shadow-lg">
                                Tutup
                            </span>
                        </div>
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDYzmil_sLYkQZOerAEBYphM8SqquNQsPLXGuMJH9fvhjw-WkkPriUpOMmoKoPzB9YiZjpd-v9hWfmXdVrlD0kKCaT_udmsCan6LJSwan7qmXfXVHKb7s0JN4hYTutAqnDkP-68h0whWx0SVIDnaWYwbdawtioEqNXdV9nHoLS3iDeSNPEeRDsxSqtQ2tBUKDCS5AeYzzQ_yAmz58Th2PI6TluajO9IsERi9MbhIiN_25B6QWFe74iwxo9VkPsHllVJ10SBjKH4RqEO" alt="Kerajinan" />
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-xs font-bold tracking-wide uppercase text-orange-600 bg-orange-100 dark:bg-orange-900/30 px-3 py-1.5 rounded-lg">Kerajinan</span>
                            <div class="flex items-center gap-1 bg-amber-50 dark:bg-amber-900/20 px-2.5 py-1.5 rounded-lg">
                                <span class="material-symbols-outlined text-[16px] text-amber-500 filled">star</span>
                                <span class="text-sm font-bold text-amber-600 dark:text-amber-400">4.5</span>
                                <span class="text-xs text-gray-400">(42)</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-primary-orange transition-colors cursor-pointer">
                            Gerabah Tanah Liat Jaya
                        </h3>
                        <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm mb-4">
                            <span class="material-symbols-outlined text-[18px] mr-1 text-primary-green">location_on</span>
                            Yogyakarta
                        </div>
                        <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400 font-semibold">Mulai dari <span class="text-primary-orange font-bold">Rp 25rb</span></span>
                            <a class="text-sm font-bold text-primary-orange hover:text-orange-dark flex items-center gap-1 group/link" href="#">
                                Lihat Detail
                                <span class="material-symbols-outlined text-[18px] group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="group bg-white dark:bg-surface-dark rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 dark:border-gray-800">
                    <div class="relative h-56 overflow-hidden">
                        <div class="absolute top-4 right-4 z-10">
                            <button class="p-2.5 rounded-full bg-white/90 backdrop-blur-sm text-gray-400 hover:bg-white hover:text-red-500 transition-all shadow-lg transform hover:scale-110">
                                <span class="material-symbols-outlined text-[22px]">favorite</span>
                            </button>
                        </div>
                        <div class="absolute top-4 left-4 z-10">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r from-green-400 to-green-600 text-white shadow-lg">
                                <span class="w-1.5 h-1.5 bg-white rounded-full mr-2 animate-pulse"></span>
                                Buka
                            </span>
                        </div>
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAAGnG4mr1RSsK3v4PsSPqgi2qqGhrVlNHvC7i-g0r_nHVKSgCf1CzLmVTYHyX5aB7mj7KjVqzNsejRyklqTDDLEIWAKymaQ8gVaQ0_u9DQpNO2xn_zBaykYoVKuDCoyb1JPlivRZkJmZ6Oa7XBET9ZaGSunmEB5KbAXsvrTPI40MYLmoWn2ETcS-HqUKOCjwxts4xl81k5JNZVXrnLuwoo-oBoSruEchyoY08NF1B5sD0UTafaPAzAS7uqE5qu1Qzo76EABFMrQCz" alt="Barbershop" />
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-xs font-bold tracking-wide uppercase text-blue-600 bg-blue-100 dark:bg-blue-900/30 px-3 py-1.5 rounded-lg">Jasa</span>
                            <div class="flex items-center gap-1 bg-amber-50 dark:bg-amber-900/20 px-2.5 py-1.5 rounded-lg">
                                <span class="material-symbols-outlined text-[16px] text-amber-500 filled">star</span>
                                <span class="text-sm font-bold text-amber-600 dark:text-amber-400">5.0</span>
                                <span class="text-xs text-gray-400">(210)</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-primary-green transition-colors cursor-pointer">
                            Gentlemen's Cut
                        </h3>
                        <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm mb-4">
                            <span class="material-symbols-outlined text-[18px] mr-1 text-primary-green">location_on</span>
                            Jakarta Selatan
                        </div>
                        <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400 font-semibold">Mulai dari <span class="text-primary-green font-bold">Rp 50rb</span></span>
                            <a class="text-sm font-bold text-primary-green hover:text-green-dark flex items-center gap-1 group/link" href="#">
                                Lihat Detail
                                <span class="material-symbols-outlined text-[18px] group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="group bg-white dark:bg-surface-dark rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 dark:border-gray-800">
                    <div class="relative h-56 overflow-hidden">
                        <div class="absolute top-4 right-4 z-10">
                            <button class="p-2.5 rounded-full bg-white/90 backdrop-blur-sm text-gray-400 hover:bg-white hover:text-red-500 transition-all shadow-lg transform hover:scale-110">
                                <span class="material-symbols-outlined text-[22px]">favorite</span>
                            </button>
                        </div>
                        <div class="absolute top-4 left-4 z-10">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r from-green-400 to-green-600 text-white shadow-lg">
                                <span class="w-1.5 h-1.5 bg-white rounded-full mr-2 animate-pulse"></span>
                                Buka
                            </span>
                        </div>
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBNa9MSIJi2JliUPSkWJtfDbERhR8FpRMulwoR0Y8t7UF2TJdIkPvYJJUM_dH6_ZabBUOUCW7QZSM51peWG_MPF_e54MNte1CpVMzKQG08AKm9zABGwXEK8o9eBmHEOjDf48jGk6SMA46kZw-Jj1-ZIIESg4Tm5YtEvjl1XZJ_u_FCbmV7erQywI_lLHMkbk1ZMbg6SEnR-_uhLFGUamFjOZIwy7wmu32qFoKF3XAQIcTwim-aLIH57fR4udebe5v4J5szY8qALCf84" alt="Roti Bakar" />
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-xs font-bold tracking-wide uppercase text-primary-orange bg-orange-light dark:bg-orange-900/30 px-3 py-1.5 rounded-lg">Kuliner</span>
                            <div class="flex items-center gap-1 bg-amber-50 dark:bg-amber-900/20 px-2.5 py-1.5 rounded-lg">
                                <span class="material-symbols-outlined text-[16px] text-amber-500 filled">star</span>
                                <span class="text-sm font-bold text-amber-600 dark:text-amber-400">4.7</span>
                                <span class="text-xs text-gray-400">(98)</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-primary-orange transition-colors cursor-pointer">
                            Roti Bakar Eddy 99
                        </h3>
                        <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm mb-4">
                            <span class="material-symbols-outlined text-[18px] mr-1 text-primary-green">location_on</span>
                            Jakarta Selatan
                        </div>
                        <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400 font-semibold">Mulai dari <span class="text-primary-orange font-bold">Rp 20rb</span></span>
                            <a class="text-sm font-bold text-primary-orange hover:text-orange-dark flex items-center gap-1 group/link" href="#">
                                Lihat Detail
                                <span class="material-symbols-outlined text-[18px] group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="group bg-white dark:bg-surface-dark rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 dark:border-gray-800">
                    <div class="relative h-56 overflow-hidden">
                        <div class="absolute top-4 right-4 z-10">
                            <button class="p-2.5 rounded-full bg-white/90 backdrop-blur-sm text-gray-400 hover:bg-white hover:text-red-500 transition-all shadow-lg transform hover:scale-110">
                                <span class="material-symbols-outlined text-[22px]">favorite</span>
                            </button>
                        </div>
                        <div class="absolute top-4 left-4 z-10">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r from-green-400 to-green-600 text-white shadow-lg">
                                <span class="w-1.5 h-1.5 bg-white rounded-full mr-2 animate-pulse"></span>
                                Buka
                            </span>
                        </div>
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCZeLxQGpMtQvyQi562v-OXjn-9bmgBZPK69HnzUrUG1ZWvc1lVPQSpTxsYZwuBBTfy_fbsj2apBVO39eeSLlwZ_cXUlslo3uLquYgVNq-bKQj0ZMMJWAtrEra_tvmX2hqV7iUbvNxJ0r3mpfwRzPUoYHKv-_AJi5tVT4zx8MtV9B0DiwiNT0K7sxs1Cih2OTsaE9W2-Ql9kc6zcz302EoqOLE7QKOrQLCnFBxMOE4B0vpsX5CFRBCJWZ0JdGgN6UdKiFM1OzRafZ-z" alt="Sayur Segar" />
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-xs font-bold tracking-wide uppercase text-green-600 bg-green-100 dark:bg-green-900/30 px-3 py-1.5 rounded-lg">Agrobisnis</span>
                            <div class="flex items-center gap-1 bg-amber-50 dark:bg-amber-900/20 px-2.5 py-1.5 rounded-lg">
                                <span class="material-symbols-outlined text-[16px] text-amber-500 filled">star</span>
                                <span class="text-sm font-bold text-amber-600 dark:text-amber-400">4.9</span>
                                <span class="text-xs text-gray-400">(56)</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-primary-green transition-colors cursor-pointer">
                            Sayur Segar Pak Budi
                        </h3>
                        <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm mb-4">
                            <span class="material-symbols-outlined text-[18px] mr-1 text-primary-green">location_on</span>
                            Lembang, Bandung
                        </div>
                        <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400 font-semibold">Mulai dari <span class="text-primary-green font-bold">Rp 5rb</span></span>
                            <a class="text-sm font-bold text-primary-green hover:text-green-dark flex items-center gap-1 group/link" href="#">
                                Lihat Detail
                                <span class="material-symbols-outlined text-[18px] group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-16 flex justify-center">
                <nav class="isolate inline-flex items-center -space-x-px rounded-2xl shadow-lg bg-white dark:bg-surface-dark p-2">
                    <a href="#" class="relative inline-flex items-center rounded-xl px-4 py-3 text-gray-400 hover:bg-orange-light dark:hover:bg-orange-900/20 hover:text-primary-orange transition-all">
                        <span class="material-symbols-outlined text-[22px]">chevron_left</span>
                    </a>
                    <a href="#" class="relative z-10 inline-flex items-center bg-gradient-to-r from-primary-orange to-primary-green px-5 py-3 text-sm font-bold text-white rounded-xl shadow-lg mx-1">1</a>
                    <a href="#" class="relative inline-flex items-center px-5 py-3 text-sm font-semibold text-gray-900 dark:text-white hover:bg-orange-light dark:hover:bg-orange-900/20 hover:text-primary-orange rounded-xl transition-all mx-1">2</a>
                    <a href="#" class="relative inline-flex items-center px-5 py-3 text-sm font-semibold text-gray-900 dark:text-white hover:bg-green-light dark:hover:bg-green-900/20 hover:text-primary-green rounded-xl transition-all mx-1">3</a>
                    <span class="relative inline-flex items-center px-5 py-3 text-sm font-semibold text-gray-400">...</span>
                    <a href="#" class="relative inline-flex items-center rounded-xl px-4 py-3 text-gray-400 hover:bg-green-light dark:hover:bg-green-900/20 hover:text-primary-green transition-all">
                        <span class="material-symbols-outlined text-[22px]">chevron_right</span>
                    </a>
                </nav>
            </div>

        </div>
    </div>
</main>

@endsection