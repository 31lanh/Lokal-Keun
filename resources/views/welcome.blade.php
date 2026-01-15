@extends('layouts.app')

@section('content')

    <section id="beranda" class="relative min-h-screen flex items-center justify-center overflow-hidden pt-16">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-20 right-10 w-72 h-72 bg-primary-orange/20 rounded-full blur-3xl animate-pulse-slow">
            </div>
            <div class="absolute bottom-20 left-10 w-96 h-96 bg-primary-green/20 rounded-full blur-3xl animate-pulse-slow"
                style="animation-delay: 1s;"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid lg:grid-cols-2 gap-8 items-center">
                <div class="text-left space-y-6">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 bg-orange-light dark:bg-orange-900/30 rounded-full">
                        <span class="w-2 h-2 bg-primary-orange rounded-full animate-pulse"></span>
                        <span class="text-xs font-semibold text-primary-orange">Platform UMKM Terpercaya #1</span>
                    </div>

                    <h1 class="text-4xl md:text-6xl font-extrabold leading-tight"> Belanja Lokal,<br />
                        <span class="gradient-text">Berkah Global</span>
                    </h1>

                    <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed max-w-lg">
                        Temukan produk berkualitas dari UMKM lokal pilihan. Dukung ekonomi rakyat dengan setiap pembelianmu!
                    </p>

                    <div class="bg-white dark:bg-surface-dark p-2 rounded-2xl shadow-xl shadow-orange-500/10 max-w-xl">
                        <div class="flex flex-col md:flex-row gap-2">
                            <div class="flex-1 flex items-center px-4 py-2 bg-gray-50 dark:bg-gray-800 rounded-xl group">
                                <span
                                    class="material-symbols-outlined text-primary-orange mr-2 group-hover:scale-110 transition-transform">search</span>
                                <input
                                    class="bg-transparent border-none w-full text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-0 p-0 text-sm"
                                    placeholder="Cari produk lokal..." type="text" />
                            </div>
                            <button
                                class="px-5 py-2 bg-gradient-to-r from-primary-orange to-primary-green hover:shadow-lg text-white font-bold rounded-xl transition-all transform hover:scale-105 flex items-center justify-center gap-2 text-sm">
                                <span class="material-symbols-outlined text-sm">search</span>
                                <span>Cari</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-6 pt-2">
                        <div>
                            <div class="text-2xl font-bold gradient-text">10K+</div>
                            <div class="text-xs text-gray-500">UMKM Terdaftar</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold gradient-text">50K+</div>
                            <div class="text-xs text-gray-500">Produk Lokal</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold gradient-text">100K+</div>
                            <div class="text-xs text-gray-500">Pelanggan Puas</div>
                        </div>
                    </div>
                </div>

                <div class="relative hidden lg:block flex justify-center">
                    <div class="relative w-[90%] mx-auto">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-primary-orange to-primary-green rounded-3xl transform rotate-6 opacity-20">
                        </div>
                        <div class="relative bg-gradient-to-br from-orange-light to-green-light rounded-3xl p-6 shadow-2xl">
                            <img class="w-full h-auto object-cover rounded-2xl shadow-lg animate-float"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCful4tTkrHSdQqfR3prS8LuZ0K2hoxhO3HV45KiRKiAVmMVHF022_h7lx4Oa0fTVdzZaG9DxuvY1P2hjhyFCZ_h11REB3cHc1d0ME9pKoQ5mK7lIG98eB3QD9UFh9fsST1-4krrNtYNr4Q3ZA1zq4eTsL6ssyTE36-uku23VrH0V--iKoW9lCaC2A4xITzkTP2MKVYO1U7KKl0F2qnhTdYproSnP9QvgU23N7uWyZ9Kg0E3rlZ6xaoS2bHg1L4CV3lRzmxCBgIW_D1"
                                alt="Indonesian Local Market" style="max-height: 400px;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="kategori" class="min-h-screen flex items-center justify-center py-20 bg-white dark:bg-surface-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">Kategori <span class="gradient-text">Pilihan</span></h2>
                <p class="text-gray-600 dark:text-gray-300">Jelajahi beragam produk lokal berkualitas</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @php
                    $categories = [
                        ['name' => 'Kuliner', 'icon' => 'restaurant', 'color' => 'orange'],
                        ['name' => 'Fashion', 'icon' => 'checkroom', 'color' => 'green'],
                        ['name' => 'Kerajinan', 'icon' => 'palette', 'color' => 'orange'],
                        ['name' => 'Jasa', 'icon' => 'design_services', 'color' => 'green'],
                        ['name' => 'Kecantikan', 'icon' => 'spa', 'color' => 'orange'],
                        ['name' => 'Agribisnis', 'icon' => 'agriculture', 'color' => 'green'],
                    ];
                @endphp

                @foreach($categories as $cat)
                    <a href="#" class="group relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-primary-{{ $cat['color'] }} to-{{ $cat['color'] }}-dark rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity">
                        </div>
                        <div
                            class="relative p-6 bg-{{ $cat['color'] }}-light dark:bg-{{ $cat['color'] }}-900/20 rounded-2xl text-center transform group-hover:scale-105 group-hover:shadow-xl transition-all">
                            <div
                                class="size-16 mx-auto mb-4 bg-gradient-to-br from-primary-{{ $cat['color'] }} to-{{ $cat['color'] }}-dark rounded-xl flex items-center justify-center shadow-lg">
                                <span class="material-symbols-outlined text-white text-3xl">{{ $cat['icon'] }}</span>
                            </div>
                            <span class="font-bold text-gray-900 dark:text-white">{{ $cat['name'] }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section id="tentang"
        class="min-h-screen flex items-center justify-center py-20 bg-background-light dark:bg-background-dark overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="relative order-2 lg:order-1">
                    <div class="absolute -top-4 -left-4 w-72 h-72 bg-primary-green/20 rounded-full blur-3xl"></div>

                    <div
                        class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white dark:border-surface-dark transform rotate-[-2deg] hover:rotate-0 transition-transform duration-500">
                        <img src="https://images.unsplash.com/photo-1576669801775-ffdeb4403cb0?q=80&w=1000&auto=format&fit=crop"
                            alt="Tentang Lokal-keun" class="w-full h-full object-cover">
                    </div>

                    <div
                        class="absolute -bottom-6 -right-6 bg-white dark:bg-surface-dark p-6 rounded-2xl shadow-xl animate-float">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-orange-light rounded-full text-primary-orange">
                                <span class="material-symbols-outlined">diversity_3</span>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Komunitas</p>
                                <p class="font-bold text-gray-900 dark:text-white">1000+ Mitra</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 bg-green-light dark:bg-green-900/30 rounded-full mb-4">
                        <span class="text-xs font-bold text-primary-green uppercase tracking-wider">Tentang Kami</span>
                    </div>

                    <h2 class="text-4xl font-bold mb-6">Mengenal Lebih Dekat <br><span
                            class="gradient-text">Lokal-keun</span></h2>

                    <p class="text-gray-600 dark:text-gray-300 text-lg mb-6 leading-relaxed">
                        <strong>Lokal-Keun</strong> hadir sebagai platform untuk mendukung dan mempromosikan UMKM lokal
                        Indonesia. Kami percaya setiap produk lokal memiliki cerita dan kualitas yang layak dikenal lebih
                        luas.
                        Bersama tim yang berdedikasi, kami berupaya menghubungkan pelaku
                        UMKM dengan konsumen yang menghargai karya asli Indonesia, sehingga setiap transaksi bukan hanya
                        soal jual beli, tapi juga tentang mendukung pertumbuhan komunitas dan kreativitas lokal.
                    </p>

                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary-orange mt-1">check_circle</span>
                            <div>
                                <h4 class="font-bold text-gray-900 dark:text-white">Kurasi Kualitas Terbaik</h4>
                                <p class="text-sm text-gray-500">Hanya produk lokal pilihan yang telah lolos standar
                                    kualitas kami.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary-green mt-1">handshake</span>
                            <div>
                                <h4 class="font-bold text-gray-900 dark:text-white">Pemberdayaan Ekonomi</h4>
                                <p class="text-sm text-gray-500">Setiap transaksi berdampak langsung pada kesejahteraan
                                    pelaku UMKM.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="min-h-screen flex items-center justify-center py-20 bg-white dark:bg-surface-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div>
                    <h2 class="text-4xl font-bold mb-2">UMKM <span class="gradient-text">Unggulan</span></h2>
                    <p class="text-gray-600 dark:text-gray-300">Produk terbaik dari mitra lokal kami</p>
                </div>
                <div class="flex gap-2 bg-background-light dark:bg-background-dark p-1.5 rounded-xl shadow-inner">
                    <button
                        class="px-5 py-2 rounded-lg bg-gradient-to-r from-primary-orange to-primary-green text-white text-sm font-bold shadow-md">Semua</button>
                    <button
                        class="px-5 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-white dark:hover:bg-gray-700 text-sm font-semibold transition-colors">Kuliner</button>
                    <button
                        class="px-5 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-white dark:hover:bg-gray-700 text-sm font-semibold transition-colors">Fashion</button>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div
                    class="group bg-background-light dark:bg-background-dark rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="relative h-48 overflow-hidden">
                        <div class="absolute top-4 left-4 z-10">
                            <span
                                class="px-3 py-1.5 bg-gradient-to-r from-primary-orange to-orange-dark text-white text-xs font-bold rounded-full shadow-lg">Kuliner</span>
                        </div>
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAH-r_3740txB_8yriQQTGsCciGpxUi8rrtMIJgRVNrAKhwbWpBszv3KnB-gzEBk3uNMmi53gb5SqOyFHC3nplAkYcvTXl4ZhbVkDET9SIqx4Tn8JEtypviaYk3TpaTDgv2eUkVI9Kq28l5hdYYuKOgGs9z5dx1gesJJfE_BZrakAGXJ3S7ccKb5DSsoc7AZwWHqdtpc9JnPPpLFDBrAp5frVj18I_-dai1-Y3G-9kBq1Qdn_kg52HBX8-_x2GYYK2mtb63qAnEjeAB"
                            alt="Traditional Food" />
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="font-bold text-lg group-hover:text-primary-orange transition-colors">Dapur Bu Sri
                            </h3>
                            <div class="flex items-center gap-1 bg-amber-50 dark:bg-amber-900/20 px-2 py-1 rounded-lg">
                                <span class="material-symbols-outlined text-sm text-amber-500 filled">star</span>
                                <span class="text-sm font-bold text-amber-600 dark:text-amber-400">4.8</span>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-2">Spesialis nasi gudeg dan
                            masakan tradisional Jawa Tengah yang otentik.</p>
                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                            <div class="flex items-center gap-1 text-xs text-gray-500">
                                <span class="material-symbols-outlined text-sm text-primary-green">location_on</span>
                                <span>Yogyakarta</span>
                            </div>
                            <a href="{{ route('umkm.detail') }}"
                                class="text-primary-orange font-bold text-sm hover:underline">
                                Detail →
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="group bg-background-light dark:bg-background-dark rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="relative h-48 overflow-hidden">
                        <div class="absolute top-4 left-4 z-10">
                            <span
                                class="px-3 py-1.5 bg-gradient-to-r from-primary-green to-green-dark text-white text-xs font-bold rounded-full shadow-lg">Fashion</span>
                        </div>
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAvCYL1K2Vb5nl9qmT4MeAovBFSusJK5EmRy9YvgPhPtstRFHvGC7Sty164aF_DzTMnpl0UqflAOS9cgc2P3Vc0UMSzZka5TZAsmXyrmRmLWSlc_g-M3et6vQD5ob83dH6SPiGhEYD0TQJrQP55uhfEbmR8Yo1QyIuD5YpVqpyAkcIzpGgTiBKnoflMLzB_BuISBMwEL1no4UaIa5tmHWyuMfXoBgw8LClF0o1kQvfPpUSJfLi9DpnGjONFXXowaP_QBkJY1FO6-E_N"
                            alt="Batik Fashion" />
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="font-bold text-lg group-hover:text-primary-green transition-colors">Batik Modern Jaya
                            </h3>
                            <div class="flex items-center gap-1 bg-amber-50 dark:bg-amber-900/20 px-2 py-1 rounded-lg">
                                <span class="material-symbols-outlined text-sm text-amber-500 filled">star</span>
                                <span class="text-sm font-bold text-amber-600 dark:text-amber-400">4.9</span>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-2">Koleksi batik tulis dan cap
                            dengan desain kontemporer untuk anak muda.</p>
                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                            <div class="flex items-center gap-1 text-xs text-gray-500">
                                <span class="material-symbols-outlined text-sm text-primary-green">location_on</span>
                                <span>Solo</span>
                            </div>
                            <a href="{{ route('umkm.detail') }}"
                                class="text-primary-orange font-bold text-sm hover:underline">
                                Detail →
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="group bg-background-light dark:bg-background-dark rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="relative h-48 overflow-hidden">
                        <div class="absolute top-4 left-4 z-10">
                            <span
                                class="px-3 py-1.5 bg-gradient-to-r from-primary-orange to-orange-dark text-white text-xs font-bold rounded-full shadow-lg">Kerajinan</span>
                        </div>
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuClDw98UeX5KmhV1ow2cOiRvODhKEhLV1dEONNeECFOEVXTcHFN34HPUPWYS7HnhuzWVFvmXmhtxvRRi2Jo6dy8C98HFpCpsjeV9S30YU4NJVYgxRna8ZOoCyanyL0L96toVHPScs9gYCAaQpxcOkfMR13x8ZqSaF_3hUNcClKcYbFXnysQxbpjswagwWA-_-jd3-F5dzTYwzeMkgK4OEP-3hCgDsoMoHxpXZwxSiNbJ6Mw3D-PI-rVwYNjJ2W9_HCqj2KM5QRLOipV"
                            alt="Bamboo Crafts" />
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="font-bold text-lg group-hover:text-primary-orange transition-colors">Anyaman Bambu
                                Sejahtera</h3>
                            <div class="flex items-center gap-1 bg-amber-50 dark:bg-amber-900/20 px-2 py-1 rounded-lg">
                                <span class="material-symbols-outlined text-sm text-amber-500 filled">star</span>
                                <span class="text-sm font-bold text-amber-600 dark:text-amber-400">4.7</span>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-2">Produk ramah lingkungan dari
                            bambu pilihan, dibuat oleh pengrajin lokal.</p>
                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                            <div class="flex items-center gap-1 text-xs text-gray-500">
                                <span class="material-symbols-outlined text-sm text-primary-green">location_on</span>
                                <span>Tasikmalaya</span>
                            </div>
                            <a href="{{ route('umkm.detail') }}"
                                class="text-primary-orange font-bold text-sm hover:underline">
                                Detail →
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="group bg-background-light dark:bg-background-dark rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="relative h-48 overflow-hidden">
                        <div class="absolute top-4 left-4 z-10">
                            <span
                                class="px-3 py-1.5 bg-gradient-to-r from-primary-green to-green-dark text-white text-xs font-bold rounded-full shadow-lg">Jasa</span>
                        </div>
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBGZiqA8-xH_lf8eUUogxsEpoKauCFlWw9A4CUXqzEeBPoVnoNj33c0hnnyI9IrqVeulwzMP2YrG_DFcW3_PVnrwzEsa228ua8MetPAD3i76r1xeiCP40wzaAjdLewtOL0Vhz7rTYNTcN36nDujphesKibu7JJsraQqeEbxrPogfCjKrskVvGCjNloFcsuKLcG_qPtF9p5Xi_rHHLK4npy84BlqEDSclRM89ng9Z5Cka5NZ5BLXDpSiWzmcUBFvXTB4TFf1H9U4h0Xo"
                            alt="Bicycle Repair" />
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="font-bold text-lg group-hover:text-primary-green transition-colors">Bengkel Sepeda
                                Mas Joko</h3>
                            <div class="flex items-center gap-1 bg-amber-50 dark:bg-amber-900/20 px-2 py-1 rounded-lg">
                                <span class="material-symbols-outlined text-sm text-amber-500 filled">star</span>
                                <span class="text-sm font-bold text-amber-600 dark:text-amber-400">5.0</span>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-2">Servis sepeda segala merk,
                            cepat dan terpercaya dengan sparepart lengkap.</p>
                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                            <div class="flex items-center gap-1 text-xs text-gray-500">
                                <span class="material-symbols-outlined text-sm text-primary-green">location_on</span>
                                <span>Bandung</span>
                            </div>
                            <a href="{{ route('umkm.detail') }}"
                                class="text-primary-orange font-bold text-sm hover:underline">
                                Detail →
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('umkm.index') }}"
                    class="inline-block px-8 py-4 bg-gradient-to-r from-primary-orange to-primary-green hover:shadow-xl hover:shadow-orange-500/30 text-white font-bold rounded-xl transition-all transform hover:scale-105">
                    Lihat Lebih Banyak UMKM →
                </a>
            </div>
        </div>
    </section>

    <section id="gabung-mitra"
        class="min-h-screen flex items-center justify-center pt-24 pb-10 bg-background-light dark:bg-background-dark">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 w-full">

            <div
                class="relative bg-gradient-to-br from-primary-orange via-orange-dark to-primary-green rounded-3xl p-10 md:p-12 overflow-hidden shadow-2xl">

                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full -ml-32 -mb-32 blur-3xl"></div>

                <div class="relative z-10 text-center text-white">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white/20 backdrop-blur-sm rounded-full mb-5">
                        <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                        <span class="text-xs font-semibold">Bergabung Sekarang</span>
                    </div>

                    <h2 class="text-4xl md:text-5xl font-extrabold mb-5 leading-tight">
                        Punya Usaha Sendiri?<br />
                        Waktunya Go Digital!
                    </h2>

                    <p class="text-lg text-white/90 mb-10 max-w-xl mx-auto">
                        Bergabunglah dengan ribuan UMKM lainnya dan tingkatkan penjualan hingga 300%. Gratis tanpa biaya
                        tersembunyi!
                    </p>

                    <div class="flex flex-col sm:flex-row justify-center gap-4 mb-10">
                        <button
                            class="px-8 py-3 bg-white text-primary-orange font-bold rounded-xl hover:bg-gray-100 transition-all transform hover:scale-105 shadow-xl flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">rocket_launch</span>
                            <span>Daftar Sebagai Mitra</span>
                        </button>
                    </div>

                    <div class="flex flex-wrap justify-center gap-6 md:gap-8 text-white/90 text-sm">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined">verified</span>
                            <span class="font-semibold">100% Gratis</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined">speed</span>
                            <span class="font-semibold">Setup 5 Menit</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined">support_agent</span>
                            <span class="font-semibold">Support 24/7</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="flex flex-wrap justify-center gap-6 md:gap-8 text-white/90 text-sm">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined">verified</span>
            <span class="font-semibold">100% Gratis</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined">speed</span>
            <span class="font-semibold">Setup 5 Menit</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined">support_agent</span>
            <span class="font-semibold">Support 24/7</span>
        </div>
    </div>
    </div>
    </div>
    </div>
    </section>

    <section class="min-h-screen flex items-center justify-center py-20 bg-white dark:bg-surface-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">Kata <span class="gradient-text">Mereka</span></h2>
                <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Ribuan pelanggan dan mitra UMKM telah merasakan manfaatnya
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="bg-background-light dark:bg-background-dark p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 border-2 border-transparent hover:border-primary-orange">
                    <div class="flex text-amber-400 mb-4">
                        @for($i = 0; $i < 5; $i++) <span class="material-symbols-outlined filled">star</span> @endfor
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 mb-6 italic leading-relaxed">
                        "Platform ini sangat membantu saya menemukan oleh-oleh khas daerah yang otentik. Prosesnya mudah dan
                        mendukung pedagang kecil!"
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="size-12 rounded-full overflow-hidden ring-2 ring-primary-orange/20">
                            <img class="w-full h-full object-cover"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuB0xsGru9lx5Mrst5a-pPmtKBM3aRMmV0BHqYKYaCPoP4-pCQ4D6p78Q7mRLBloDLECU5Bf575ejicR3ACnKP0RKqYco9S6kxTuS3Qm4A5YPXT9fnfL40lnknKqJE9MiL_jWWZBzNf2YozIQW1uWZ-i8CeUbcJuUrwAUQ00egINv2BnRtH8U_BZFe9z23Dn_J-cepnd7IIs45xmKRjnt8YArYoMpbEqPjkLSrWIwFXOGaCWyqM7PiEGPrdeFz4MfS2c7Y6ztrgVtMsF"
                                alt="User" />
                        </div>
                        <div>
                            <h4 class="font-bold">Siti Aminah</h4>
                            <p class="text-sm text-gray-500">Pelanggan, Jakarta</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-background-light dark:bg-background-dark p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 border-2 border-transparent hover:border-primary-green">
                    <div class="flex text-amber-400 mb-4">
                        @for($i = 0; $i < 5; $i++) <span class="material-symbols-outlined filled">star</span> @endfor
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 mb-6 italic leading-relaxed">
                        "Sejak bergabung dengan Lokal-keun, pesanan katering saya meningkat 250%! Fitur lokasinya sangat
                        membantu."
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="size-12 rounded-full overflow-hidden ring-2 ring-primary-green/20">
                            <img class="w-full h-full object-cover"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBKV3F4P5InsYlhfAvgpuPIzYrNxMraZBPOs70d1qmzPTeMgPTQMk1XN5c_TH59xeugw7gQAcEu5duOtjqXadNM1SGWCZhUXBeK3MlRiJxRfIjiop649Brbf54blFYR3yyBoedzt4O5T4lepZPaDFajX2yC32lQD4gJ5X_vZMABSYpcl6grGblGGqg9rHz5EjKcTcJdcWFMGu4Pw6rpjwj3w6l1mk_e1tGxRN-aY6mjHRK2BNeR7mQUqvzoobkIBRLaRuXRAqy8QM_0"
                                alt="User" />
                        </div>
                        <div>
                            <h4 class="font-bold">Budi Santoso</h4>
                            <p class="text-sm text-gray-500">Pemilik UMKM, Surabaya</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-background-light dark:bg-background-dark p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 border-2 border-transparent hover:border-primary-orange">
                    <div class="flex text-amber-400 mb-4">
                        @for($i = 0; $i < 5; $i++) <span class="material-symbols-outlined filled">star</span> @endfor
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 mb-6 italic leading-relaxed">
                        "Saya suka bagaimana aplikasi ini mengkurasi produk berkualitas. Sangat direkomendasikan untuk
                        support lokal!"
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="size-12 rounded-full overflow-hidden ring-2 ring-primary-orange/20">
                            <img class="w-full h-full object-cover"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBsbKD-QCHbUA6Yc3KttZJsvF21OwlT-mT4JnoMHpf5vzVLLmnLRe8xeDbJay3jqNb3Bbjd8-3mxA4dhvhgtgU1iwZt5DDUVChaOgTvgUfnihoNWrUXSsBWBYoqfROAZgeuXd1v8ywzUE7wDf25rNlUZOw5lXGRyFtP3sr90kMmDs3-QTzWJcAvdk4-z38h9JYClyI-Z0ym4giQjlM2rE41811SK-7LwH7Blo-B6WUGAWYN_ZlBlnIpOA0xsvVRkoiW4TMNX0thzG_Z"
                                alt="User" />
                        </div>
                        <div>
                            <h4 class="font-bold">Rina Wati</h4>
                            <p class="text-sm text-gray-500">Pelanggan, Bandung</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection