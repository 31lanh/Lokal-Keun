@extends('layouts.app')

@section('content')
    {{-- 
        CATATAN: 
        Pastikan Anda sudah memasang CSS & JS AOS di layouts/app.blade.php 
        agar animasi di bawah ini berfungsi.
    --}}

    {{-- 1. SECTION BERANDA --}}
    <section id="beranda" class="relative min-h-screen flex items-center justify-center overflow-hidden pt-16">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-20 right-10 w-72 h-72 bg-primary-orange/20 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-20 left-10 w-96 h-96 bg-primary-green/20 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid lg:grid-cols-2 gap-8 items-center">
                
                {{-- KONTEN KIRI (Teks) --}}
                <div class="text-left space-y-6">
                    {{-- Badge: Fade Down --}}
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-orange-light dark:bg-orange-900/30 rounded-full" 
                         data-aos="fade-down" data-aos-delay="100">
                        <span class="w-2 h-2 bg-primary-orange rounded-full animate-pulse"></span>
                        <span class="text-xs font-semibold text-primary-orange">Platform UMKM Terpercaya #1</span>
                    </div>

                    {{-- Headline: Fade Right --}}
                    <h1 class="text-4xl md:text-6xl font-extrabold leading-tight" 
                        data-aos="fade-right" data-aos-delay="200"> 
                        Belanja Lokal,<br />
                        <span class="gradient-text">Berkah Global</span>
                    </h1>

                    {{-- Deskripsi: Fade Right (Delayed) --}}
                    <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed max-w-lg" 
                       data-aos="fade-right" data-aos-delay="300">
                        Temukan produk berkualitas dari UMKM lokal pilihan. Dukung ekonomi rakyat dengan setiap pembelianmu!
                    </p>

                    {{-- Search Box: Fade Up --}}
                    <div class="bg-white dark:bg-surface-dark p-2 rounded-2xl shadow-xl shadow-orange-500/10 max-w-xl" 
                         data-aos="fade-up" data-aos-delay="400">
                        <form action="{{ route('jelajah') }}" method="GET">
                            <div class="flex flex-col md:flex-row gap-2">
                                <div class="flex-1 flex items-center px-4 py-2 bg-gray-50 dark:bg-gray-800 rounded-xl group">
                                    <span class="material-symbols-outlined text-primary-orange mr-2 group-hover:scale-110 transition-transform">search</span>
                                    <input name="q" class="bg-transparent border-none w-full text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-0 p-0 text-sm" placeholder="Cari produk lokal..." type="text" />
                                </div>
                                <button type="submit" class="px-5 py-2 bg-gradient-to-r from-primary-orange to-primary-green hover:shadow-lg text-white font-bold rounded-xl transition-all transform hover:scale-105 flex items-center justify-center gap-2 text-sm">
                                    <span class="material-symbols-outlined text-sm">search</span>
                                    <span>Cari</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Stats: Fade Up (Delayed) --}}
                    <div class="flex flex-wrap gap-6 pt-2" data-aos="fade-up" data-aos-delay="500">
                        <div>
                            <div class="text-2xl font-bold gradient-text">{{ $stats['total_umkm'] }}+</div>
                            <div class="text-xs text-gray-500">UMKM Terdaftar</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold gradient-text">{{ $stats['total_products'] }}+</div>
                            <div class="text-xs text-gray-500">Produk Lokal</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold gradient-text">{{ $stats['total_users'] }}+</div>
                            <div class="text-xs text-gray-500">Pelanggan Puas</div>
                        </div>
                    </div>
                </div>

                {{-- KONTEN KANAN (Gambar): Fade Left --}}
                <div class="relative hidden lg:block flex justify-center" data-aos="fade-left" data-aos-delay="400">
                    <div class="relative w-[90%] mx-auto">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-orange to-primary-green rounded-3xl transform rotate-6 opacity-20"></div>
                        <div class="relative bg-gradient-to-br from-orange-light to-green-light rounded-3xl p-6 shadow-2xl">
                            <img class="w-full h-auto object-cover rounded-2xl shadow-lg animate-float" src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800&q=80" alt="Indonesian Local Market" style="max-height: 400px;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 2. SECTION TENTANG --}}
    <section id="tentang" class="min-h-screen flex items-center justify-center py-20 bg-background-light dark:bg-background-dark overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                
                {{-- Info Grid Kiri: Fade Right --}}
                <div class="relative order-2 lg:order-1" data-aos="fade-right">
                    {{-- Background Blob --}}
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-gradient-to-tr from-orange-100 to-green-100 dark:from-orange-900/20 dark:to-green-900/20 rounded-full blur-3xl -z-10"></div>

                    <div class="grid grid-cols-2 gap-6">
                        {{-- Card 1 --}}
                        <div class="bg-white dark:bg-surface-dark p-6 rounded-3xl shadow-xl border border-orange-100 dark:border-gray-700 transform hover:-translate-y-2 transition-transform duration-300">
                            <div class="w-14 h-14 bg-orange-50 dark:bg-orange-900/30 rounded-2xl flex items-center justify-center mb-4 text-primary-orange">
                                <span class="material-symbols-outlined text-3xl">storefront</span>
                            </div>
                            <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-1">{{ $stats['total_umkm'] }}+</h3>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Mitra UMKM Bergabung</p>
                        </div>

                        {{-- Card 2 (Offset Down) --}}
                        <div class="bg-white dark:bg-surface-dark p-6 rounded-3xl shadow-xl border border-green-100 dark:border-gray-700 transform translate-y-8 hover:translate-y-6 transition-transform duration-300">
                            <div class="w-14 h-14 bg-green-50 dark:bg-green-900/30 rounded-2xl flex items-center justify-center mb-4 text-primary-green">
                                <span class="material-symbols-outlined text-3xl">inventory_2</span>
                            </div>
                            <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-1">{{ $stats['total_products'] }}+</h3>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Produk Lokal Unik</p>
                        </div>

                        {{-- Card 3 --}}
                        <div class="bg-white dark:bg-surface-dark p-6 rounded-3xl shadow-xl border border-blue-100 dark:border-gray-700 transform hover:-translate-y-2 transition-transform duration-300">
                            <div class="w-14 h-14 bg-blue-50 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center mb-4 text-blue-600">
                                <span class="material-symbols-outlined text-3xl">groups</span>
                            </div>
                            <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-1">{{ $stats['total_users'] }}+</h3>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pengguna Aktif</p>
                        </div>

                        {{-- Card 4 (Offset Down) --}}
                        <div class="bg-white dark:bg-surface-dark p-6 rounded-3xl shadow-xl border border-amber-100 dark:border-gray-700 transform translate-y-8 hover:translate-y-6 transition-transform duration-300">
                            <div class="w-14 h-14 bg-amber-50 dark:bg-amber-900/30 rounded-2xl flex items-center justify-center mb-4 text-amber-500">
                                <span class="material-symbols-outlined text-3xl">verified</span>
                            </div>
                            <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-1">100%</h3>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Terverifikasi & Aman</p>
                        </div>
                    </div>
                </div>

                {{-- Teks Kanan: Fade Left --}}
                <div class="order-1 lg:order-2" data-aos="fade-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-green-light dark:bg-green-900/30 rounded-full mb-4">
                        <span class="text-xs font-bold text-primary-green uppercase tracking-wider">Tentang Kami</span>
                    </div>

                    <h2 class="text-4xl font-bold mb-6">Mengenal Lebih Dekat <br><span class="gradient-text">LokalKeun</span></h2>

                    <p class="text-gray-600 dark:text-gray-300 text-lg mb-6 leading-relaxed">
                        <strong class="gradient-text">LokalKeun</strong> hadir sebagai platform untuk mendukung dan mempromosikan UMKM lokal
                        Indonesia. Kami percaya setiap produk lokal memiliki cerita dan kualitas yang layak dikenal lebih
                        luas.
                        Bersama tim yang berdedikasi, kami berupaya menghubungkan pelaku
                        UMKM dengan konsumen yang menghargai karya asli Indonesia, sehingga setiap transaksi bukan hanya
                        soal jual beli, tapi juga tentang mendukung pertumbuhan komunitas dan kreativitas lokal.
                    </p>

                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start gap-3" data-aos="fade-up" data-aos-delay="100">
                            <span class="material-symbols-outlined text-primary-orange mt-1">check_circle</span>
                            <div>
                                <h4 class="font-bold text-gray-900 dark:text-white">Kurasi Kualitas Terbaik</h4>
                                <p class="text-sm text-gray-500">Hanya produk lokal pilihan yang telah lolos standar kualitas kami.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3" data-aos="fade-up" data-aos-delay="200">
                            <span class="material-symbols-outlined text-primary-green mt-1">handshake</span>
                            <div>
                                <h4 class="font-bold text-gray-900 dark:text-white">Pemberdayaan Ekonomi</h4>
                                <p class="text-sm text-gray-500">Setiap transaksi berdampak langsung pada kesejahteraan pelaku UMKM.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. SECTION KATEGORI --}}
    <section id="kategori" class="min-h-screen flex items-center justify-center py-20 bg-white dark:bg-surface-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center mb-12" data-aos="fade-down">
                <h2 class="text-4xl font-bold mb-4">Kategori <span class="gradient-text">Pilihan</span></h2>
                <p class="text-gray-600 dark:text-gray-300">Jelajahi beragam produk lokal berkualitas</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @php
                    $categories = [
                        ['name' => 'Kuliner', 'icon' => 'restaurant', 'color' => 'orange', 'slug' => 'kuliner'],
                        ['name' => 'Fashion', 'icon' => 'checkroom', 'color' => 'green', 'slug' => 'fashion'],
                        ['name' => 'Kerajinan', 'icon' => 'palette', 'color' => 'orange', 'slug' => 'kerajinan'],
                        ['name' => 'Jasa', 'icon' => 'design_services', 'color' => 'green', 'slug' => 'jasa'],
                        ['name' => 'Kecantikan', 'icon' => 'spa', 'color' => 'orange', 'slug' => 'kecantikan'],
                        ['name' => 'Pertanian', 'icon' => 'agriculture', 'color' => 'green', 'slug' => 'pertanian'],
                    ];
                @endphp

                @foreach ($categories as $index => $cat)
                    {{-- Animasi delay bertingkat berdasarkan index loop --}}
                    <a href="{{ route('kategori.detail', $cat['slug']) }}" class="group relative" 
                       data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-{{ $cat['color'] }} to-{{ $cat['color'] }}-dark rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity"></div>
                        <div class="relative p-6 bg-{{ $cat['color'] }}-light dark:bg-{{ $cat['color'] }}-900/20 rounded-2xl text-center transform group-hover:scale-105 group-hover:shadow-xl transition-all">
                            <div class="size-16 mx-auto mb-4 bg-gradient-to-br from-primary-{{ $cat['color'] }} to-{{ $cat['color'] }}-dark rounded-xl flex items-center justify-center shadow-lg">
                                <span class="material-symbols-outlined text-white text-3xl">{{ $cat['icon'] }}</span>
                            </div>
                            <span class="font-bold text-gray-900 dark:text-white">{{ $cat['name'] }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 4. SECTION JELAJAH (UMKM Unggulan) --}}
    <section id="jelajah" class="min-h-screen flex items-center justify-center py-20 bg-background-light dark:bg-background-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4" data-aos="fade-right">
                <div>
                    <h2 class="text-4xl font-bold mb-2">UMKM <span class="gradient-text">Unggulan</span></h2>
                    <p class="text-gray-600 dark:text-gray-300">Produk terbaik dari mitra lokal kami</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($featuredUmkms as $index => $umkm)
                    @php
                        // Logika PHP tetap sama
                        $photoUrl = $umkm->primaryPhoto ? asset($umkm->primaryPhoto->photo_path) : 'https://via.placeholder.com/400x300?text=UMKM';
                        if ($umkm->primaryPhoto && !str_starts_with($umkm->primaryPhoto->photo_path, 'http')) {
                            if (file_exists(public_path('storage/' . $umkm->primaryPhoto->photo_path))) {
                                $photoUrl = asset('storage/' . $umkm->primaryPhoto->photo_path);
                            } elseif (file_exists(public_path($umkm->primaryPhoto->photo_path))) {
                                $photoUrl = asset($umkm->primaryPhoto->photo_path);
                            }
                        } elseif ($umkm->primaryPhoto) {
                            $photoUrl = $umkm->primaryPhoto->photo_path;
                        }
                    @endphp

                    {{-- Animasi delay bertingkat berdasarkan index loop ($loop->index juga bisa dipakai) --}}
                    <div class="group bg-white dark:bg-surface-dark rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2"
                         data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        
                        <div class="relative h-48 overflow-hidden">
                            <div class="absolute top-4 left-4 z-10">
                                <span class="px-3 py-1.5 bg-gradient-to-r from-primary-orange to-orange-dark text-white text-xs font-bold rounded-full shadow-lg">
                                    {{ ucfirst($umkm->kategori) }}
                                </span>
                            </div>
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="{{ $photoUrl }}" alt="{{ $umkm->nama_usaha }}" onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'" />
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="font-bold text-lg group-hover:text-primary-orange transition-colors line-clamp-1">
                                    {{ $umkm->nama_usaha }}
                                </h3>
                                <div class="flex items-center gap-1 bg-amber-50 dark:bg-amber-900/20 px-2 py-1 rounded-lg shrink-0">
                                    <span class="material-symbols-outlined text-sm text-amber-500 filled">star</span>
                                    <span class="text-sm font-bold text-amber-600 dark:text-amber-400">{{ $umkm->rating }}</span>
                                </div>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-2">
                                {{ $umkm->deskripsi }}
                            </p>
                            <div class="pt-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                                <div class="flex items-center gap-1 text-xs text-gray-500">
                                    <span class="material-symbols-outlined text-sm text-primary-green">location_on</span>
                                    <span class="line-clamp-1 max-w-[100px]">{{ $umkm->alamat }}</span>
                                </div>
                                <a href="{{ route('umkm.show', $umkm->slug) }}" class="text-primary-orange font-bold text-sm hover:underline">
                                    Detail →
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-10 text-gray-500" data-aos="fade-in">
                        Belum ada UMKM Unggulan.
                    </div>
                @endforelse
            </div>

            <div class="mt-12 text-center" data-aos="fade-up">
                <a href="{{ route('jelajah') }}" class="inline-block px-8 py-4 bg-gradient-to-r from-primary-orange to-primary-green hover:shadow-xl hover:shadow-orange-500/30 text-white font-bold rounded-xl transition-all transform hover:scale-105">
                    Lihat Lebih Banyak UMKM →
                </a>
            </div>
        </div>
    </section>

    {{-- 5. SECTION GABUNG MITRA --}}
    <section id="gabung-mitra" 
             class="min-h-screen flex items-center justify-center py-20 bg-white dark:bg-surface-dark"
             x-data="{ showConfirmModal: false }"> 
             
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 w-full" data-aos="zoom-in-up">
            <div class="relative bg-gradient-to-br from-primary-orange via-orange-dark to-primary-green rounded-3xl p-10 md:p-12 overflow-hidden shadow-2xl">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full -ml-32 -mb-32 blur-3xl"></div>

                <div class="relative z-10 text-center text-white">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white/20 backdrop-blur-sm rounded-full mb-5" data-aos="fade-down" data-aos-delay="200">
                        <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                        <span class="text-xs font-semibold">Bergabung Sekarang</span>
                    </div>

                    <h2 class="text-4xl md:text-5xl font-extrabold mb-5 leading-tight" data-aos="fade-up" data-aos-delay="300">
                        Punya Usaha Sendiri?<br />Waktunya Go Digital!
                    </h2>

                    <p class="text-lg text-white/90 mb-10 max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="400">
                        Bergabunglah dengan ribuan UMKM lainnya dan tingkatkan penjualan hingga 300%. Gratis tanpa biaya tersembunyi!
                    </p>

                    <div class="flex flex-col sm:flex-row justify-center gap-4 mb-10" data-aos="fade-up" data-aos-delay="500">
                        @auth
                            {{-- ... Logika tombol Auth tetap sama ... --}}
                            @if(auth()->user()->role === 'pembeli')
                                <button @click="showConfirmModal = true" 
                                   class="px-8 py-3 bg-white text-primary-orange font-bold rounded-xl hover:bg-gray-100 transition-all transform hover:scale-105 shadow-xl flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined">store</span>
                                    <span>Daftar Sebagai Mitra</span>
                                </button>
                            @elseif(auth()->user()->role === 'penjual')
                                <a href="{{ route('seller.dashboard') }}" 
                                   class="px-8 py-3 bg-white text-primary-orange font-bold rounded-xl hover:bg-gray-100 transition-all transform hover:scale-105 shadow-xl flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined">dashboard</span>
                                    <span>Ke Dashboard Toko</span>
                                </a>
                            @elseif(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" 
                                   class="px-8 py-3 bg-white text-primary-orange font-bold rounded-xl hover:bg-gray-100 transition-all shadow-xl">
                                    Ke Dashboard Admin
                                </a>
                            @endif
                        @else
                            <a href="{{ route('register') }}" 
                               class="px-8 py-3 bg-white text-primary-orange font-bold rounded-xl hover:bg-gray-100 transition-all transform hover:scale-105 shadow-xl flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">rocket_launch</span>
                                <span>Daftar Sebagai Mitra</span>
                            </a>
                        @endauth
                    </div>

                    <div class="flex flex-wrap justify-center gap-6 md:gap-8 text-white/90 text-sm" data-aos="fade-up" data-aos-delay="600">
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

        {{-- INCLUDE POP-UP --}}
        @auth
            @if(auth()->user()->role === 'pembeli')
                @include('partials.become-seller-modal')
            @endif
        @endauth

    </section>
@endsection