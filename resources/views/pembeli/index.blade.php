@extends('layouts.app')

@section('content')
    {{-- Hero Section dengan Animasi --}}
    <section
        class="relative min-h-[45vh] flex items-center justify-center overflow-hidden pt-20 pb-16 bg-gradient-to-br from-orange-50 via-white to-green-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        {{-- Background Decorations --}}
        <div class="absolute inset-0 z-0 overflow-hidden">
            <div class="absolute top-10 right-20 w-72 h-72 bg-primary-orange/10 rounded-full blur-3xl animate-pulse-slow">
            </div>
            <div class="absolute bottom-10 left-20 w-96 h-96 bg-primary-green/10 rounded-full blur-3xl animate-pulse-slow"
                style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-blue-500/5 rounded-full blur-3xl animate-pulse-slow"
                style="animation-delay: 2s;"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center space-y-6">
                {{-- Welcome Badge --}}
                <div
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-white dark:bg-surface-dark rounded-full shadow-lg border border-gray-100 dark:border-gray-700 hover:scale-105 transition-transform">
                    <span class="relative flex h-3 w-3">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </span>
                    <span class="text-sm font-bold text-gray-700 dark:text-gray-300">Selamat Datang Kembali!</span>
                </div>

                {{-- Greeting --}}
                <div class="space-y-3">
                    <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 dark:text-white leading-tight">
                        Halo, <span
                            class="bg-gradient-to-r from-primary-orange via-orange-500 to-primary-green bg-clip-text text-transparent animate-gradient">{{ Auth::user()->name }}</span>!
                        <span class="inline-block animate-wave">👋</span>
                    </h1>
                    <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        Temukan produk lokal terbaik dari UMKM pilihan
                    </p>
                </div>

                {{-- Quick Search Bar --}}
                <div class="max-w-2xl mx-auto mt-8">
                    <form action="{{ route('jelajah') }}" method="GET">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Cari produk, UMKM, atau kategori..."
                                class="w-full px-6 py-4 pr-32 rounded-2xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-surface-dark text-gray-900 dark:text-white placeholder-gray-400 focus:border-primary-orange focus:ring-4 focus:ring-orange-100 dark:focus:ring-orange-900/30 transition-all shadow-lg">
                            <button type="submit"
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 px-6 py-2.5 bg-gradient-to-r from-primary-orange to-orange-600 text-white rounded-xl font-semibold hover:shadow-lg hover:scale-105 transition-all flex items-center gap-2">
                                <span class="material-symbols-outlined text-xl">search</span>
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Cards - Fokus Pemasaran --}}
    <section class="py-10 bg-white dark:bg-surface-dark -mt-8 relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
                {{-- Card 1: UMKM Favorit --}}
                <div
                    class="group bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-orange-200/50 dark:border-orange-700/30 cursor-pointer">
                    <div class="flex items-start justify-between mb-4">
                        <div
                            class="p-3 bg-white dark:bg-orange-900/30 rounded-xl shadow-sm group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-primary-orange text-3xl">store</span>
                        </div>
                        <span class="material-symbols-outlined text-orange-600 animate-pulse">favorite</span>
                    </div>
                    <div class="text-3xl font-extrabold text-gray-900 dark:text-white mb-1">
                        {{ $favoriteUmkms->count() }}
                    </div>
                    <div class="text-sm font-medium text-gray-600 dark:text-gray-300">UMKM Favorit</div>
                    <div class="mt-3 flex items-center text-xs text-orange-600 dark:text-orange-400 font-semibold">
                        <span class="material-symbols-outlined text-sm mr-1">arrow_forward</span>
                        Kelola favorit
                    </div>
                </div>

                {{-- Card 2: Produk Disimpan --}}
                <div
                    class="group bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-green-200/50 dark:border-green-700/30 cursor-pointer">
                    <div class="flex items-start justify-between mb-4">
                        <div
                            class="p-3 bg-white dark:bg-green-900/30 rounded-xl shadow-sm group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-primary-green text-3xl">bookmark</span>
                        </div>
                        <span class="text-xs font-bold text-green-600 bg-green-200/50 px-2 py-1 rounded-full">Baru</span>
                    </div>
                    <div class="text-3xl font-extrabold text-gray-900 dark:text-white mb-1">
                        {{ $stats['saved_products'] ?? 0 }}
                    </div>
                    <div class="text-sm font-medium text-gray-600 dark:text-gray-300">Produk Disimpan</div>
                    <div class="mt-3 flex items-center text-xs text-green-600 dark:text-green-400 font-semibold">
                        <span class="material-symbols-outlined text-sm mr-1">collections_bookmark</span>
                        Lihat koleksi
                    </div>
                </div>

                {{-- Card 3: Katalog Dilihat --}}
                <div
                    class="group bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-blue-200/50 dark:border-blue-700/30 cursor-pointer">
                    <div class="flex items-start justify-between mb-4">
                        <div
                            class="p-3 bg-white dark:bg-blue-900/30 rounded-xl shadow-sm group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-blue-600 text-3xl">visibility</span>
                        </div>
                        <span class="text-xs font-bold text-blue-600 bg-blue-200/50 px-2 py-1 rounded-full">7 Hari</span>
                    </div>
                    <div class="text-3xl font-extrabold text-gray-900 dark:text-white mb-1">
                        {{ $stats['views_count'] ?? 0 }}
                    </div>
                    <div class="text-sm font-medium text-gray-600 dark:text-gray-300">Katalog Dilihat</div>
                    <div class="mt-3 flex items-center text-xs text-blue-600 dark:text-blue-400 font-semibold">
                        <span class="material-symbols-outlined text-sm mr-1">history</span>
                        Lihat riwayat
                    </div>
                </div>

                {{-- Card 4: UMKM Terhubung --}}
                <div
                    class="group bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-purple-200/50 dark:border-purple-700/30 cursor-pointer">
                    <div class="flex items-start justify-between mb-4">
                        <div
                            class="p-3 bg-white dark:bg-purple-900/30 rounded-xl shadow-sm group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-purple-600 text-3xl">handshake</span>
                        </div>
                        <span class="material-symbols-outlined text-purple-600 animate-bounce">link</span>
                    </div>
                    <div class="text-3xl font-extrabold text-gray-900 dark:text-white mb-1">
                        {{ $stats['contacted_umkm'] ?? 0 }}
                    </div>
                    <div class="text-sm font-medium text-gray-600 dark:text-gray-300">UMKM Terhubung</div>
                    <div class="mt-3 flex items-center text-xs text-purple-600 dark:text-purple-400 font-semibold">
                        <span class="material-symbols-outlined text-sm mr-1">chat</span>
                        Lihat kontak
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-12 bg-background-light dark:bg-background-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-8">
                {{-- Left Column --}}
                <div class="lg:col-span-2 space-y-8">
                    {{-- Produk Baru & Unggulan --}}
                    <div
                        class="bg-white dark:bg-surface-dark rounded-2xl p-6 lg:p-8 shadow-xl border border-gray-100 dark:border-gray-800">
                        <div class="flex items-center justify-between mb-6">
                            <h2
                                class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                                <div class="p-2 bg-orange-100 dark:bg-orange-900/30 rounded-xl">
                                    <span class="material-symbols-outlined text-primary-orange text-2xl">new_releases</span>
                                </div>
                                Produk Baru & Unggulan
                            </h2>
                            <a href="{{ route('jelajah') }}"
                                class="group flex items-center gap-2 text-primary-orange font-bold hover:gap-3 transition-all text-sm lg:text-base">
                                Lihat Semua
                                <span
                                    class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            @forelse($featuredMenus ?? [] as $menu)
                                @php
                                    $photoUrl = 'https://via.placeholder.com/400x300/f97316/ffffff?text=No+Image';
                                    if ($menu->photo_path) {
                                        $path = $menu->photo_path;
                                        if (Str::startsWith($path, ['http'])) {
                                            $photoUrl = $path;
                                        } else {
                                            $path = ltrim($path, '/');
                                            $photoUrl = asset('storage/' . $path);
                                        }
                                    }
                                @endphp

                                <div
                                    class="group bg-background-light dark:bg-background-dark rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-300 border border-gray-200 dark:border-gray-700 hover:border-primary-orange transform hover:-translate-y-1">
                                    <div
                                        class="relative h-48 overflow-hidden bg-gradient-to-br from-orange-100 to-green-100 dark:from-gray-800 dark:to-gray-700">
                                        <img src="{{ $photoUrl }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                            alt="{{ $menu->name }}"
                                            onerror="this.src='https://via.placeholder.com/400x300/f97316/ffffff?text=Error';">

                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                        </div>

                                        <span
                                            class="absolute top-3 left-3 bg-red-500 text-white px-3 py-1.5 rounded-xl text-xs font-bold shadow-lg flex items-center gap-1">
                                            <span class="material-symbols-outlined text-sm">new_releases</span>
                                            BARU
                                        </span>

                                        <button
                                            class="absolute top-3 right-3 p-2 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-all hover:scale-110 border border-gray-200 dark:border-gray-700">
                                            <span class="material-symbols-outlined text-red-500">favorite_border</span>
                                        </button>
                                    </div>

                                    <div class="p-5">
                                        <a href="{{ route('umkm.show', $menu->umkm->slug) }}">
                                            <h3
                                                class="font-bold text-lg text-gray-900 dark:text-white mb-2 line-clamp-1 group-hover:text-primary-orange transition-colors">
                                                {{ $menu->name }}
                                            </h3>
                                        </a>

                                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-3 flex items-center gap-2">
                                            <span class="material-symbols-outlined text-base">store</span>
                                            <span class="truncate">{{ $menu->umkm->nama_usaha }}</span>
                                        </p>

                                        <div
                                            class="flex items-center justify-between pt-3 border-t border-gray-200 dark:border-gray-700">
                                            <div>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Mulai dari</p>
                                                <span class="text-xl font-bold text-primary-green">
                                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                                </span>
                                            </div>
                                            <a href="{{ route('umkm.show', $menu->umkm->slug) }}"
                                                class="px-4 py-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl hover:shadow-lg hover:scale-105 transition-all font-semibold text-sm flex items-center gap-1">
                                                <span class="material-symbols-outlined text-lg">info</span>
                                                Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div
                                    class="col-span-2 flex flex-col items-center justify-center py-12 px-4 text-center border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-2xl bg-gray-50 dark:bg-gray-800/30">
                                    <div
                                        class="w-20 h-20 bg-orange-100 dark:bg-orange-900/30 rounded-full flex items-center justify-center mb-4">
                                        <span class="material-symbols-outlined text-5xl text-orange-400">inventory_2</span>
                                    </div>
                                    <p class="text-gray-700 dark:text-gray-300 font-semibold text-lg mb-2">Belum ada produk
                                        unggulan</p>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">Jelajahi katalog lengkap kami!
                                    </p>
                                    <a href="{{ route('jelajah') }}"
                                        class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-orange to-orange-600 text-white rounded-xl font-bold hover:shadow-lg hover:scale-105 transition-all">
                                        <span class="material-symbols-outlined">explore</span>
                                        Jelajahi Sekarang
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Rekomendasi Produk --}}
                    <div
                        class="bg-white dark:bg-surface-dark rounded-2xl p-6 lg:p-8 shadow-xl border border-gray-100 dark:border-gray-800">
                        <div class="flex items-center justify-between mb-6">
                            <h2
                                class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                                <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-xl">
                                    <span class="material-symbols-outlined text-primary-green text-2xl">recommend</span>
                                </div>
                                Rekomendasi Untukmu
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            @forelse($recommendedMenus as $menu)
                                @php
                                    $photoUrl = 'https://via.placeholder.com/400x300/f97316/ffffff?text=No+Image';
                                    if ($menu->photo_path) {
                                        $path = $menu->photo_path;
                                        if (Str::startsWith($path, ['http'])) {
                                            $photoUrl = $path;
                                        } else {
                                            $path = ltrim($path, '/');
                                            $photoUrl = asset('storage/' . $path);
                                        }
                                    }
                                @endphp

                                <div
                                    class="group bg-background-light dark:bg-background-dark rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-300 border border-gray-200 dark:border-gray-700 hover:border-primary-green transform hover:-translate-y-1">
                                    <div
                                        class="relative h-48 overflow-hidden bg-gradient-to-br from-orange-100 to-green-100 dark:from-gray-800 dark:to-gray-700">
                                        <img src="{{ $photoUrl }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                            alt="{{ $menu->name }}"
                                            onerror="this.src='https://via.placeholder.com/400x300/f97316/ffffff?text=Error';">

                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                        </div>

                                        <span
                                            class="absolute top-3 right-3 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm px-3 py-1.5 rounded-xl text-xs font-bold text-primary-orange shadow-lg border border-orange-200 dark:border-orange-800">
                                            {{ ucfirst($menu->umkm->kategori) }}
                                        </span>

                                        <button
                                            class="absolute top-3 left-3 p-2 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-all hover:scale-110 border border-gray-200 dark:border-gray-700">
                                            <span class="material-symbols-outlined text-red-500">favorite_border</span>
                                        </button>
                                    </div>

                                    <div class="p-5">
                                        <a href="{{ route('umkm.show', $menu->umkm->slug) }}">
                                            <h3
                                                class="font-bold text-lg text-gray-900 dark:text-white mb-2 line-clamp-1 group-hover:text-primary-green transition-colors">
                                                {{ $menu->name }}
                                            </h3>
                                        </a>

                                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-3 flex items-center gap-2">
                                            <span class="material-symbols-outlined text-base">store</span>
                                            <span class="truncate">{{ $menu->umkm->nama_usaha }}</span>
                                        </p>

                                        <div
                                            class="flex items-center justify-between pt-3 border-t border-gray-200 dark:border-gray-700">
                                            <div>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Harga</p>
                                                <span class="text-xl font-bold text-primary-green">
                                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                                </span>
                                            </div>
                                            <a href="{{ route('umkm.show', $menu->umkm->slug) }}"
                                                class="p-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl hover:shadow-lg hover:scale-110 transition-all">
                                                <span class="material-symbols-outlined">info</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-2 text-center py-12">
                                    <div
                                        class="w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <span
                                            class="material-symbols-outlined text-4xl text-gray-400">shopping_basket</span>
                                    </div>
                                    <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada rekomendasi produk
                                        saat ini.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Right Sidebar --}}
                <div class="space-y-6">
                    {{-- Profile Card --}}
                    <div
                        class="relative bg-gradient-to-br from-primary-orange via-orange-500 to-orange-600 rounded-2xl p-6 text-white shadow-2xl overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full -ml-12 -mb-12"></div>

                        <div class="relative z-10">
                            <div class="flex items-center gap-4 mb-5">
                                <div
                                    class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-sm overflow-hidden border-2 border-white/30 shadow-xl flex-shrink-0">
                                    <img src="{{ Auth::user()->profile_photo_path ? (Str::startsWith(Auth::user()->profile_photo_path, ['http']) ? Auth::user()->profile_photo_path : asset('storage/' . Auth::user()->profile_photo_path)) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=fff&color=f97316&size=128' }}"
                                        class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-lg truncate">{{ Auth::user()->name }}</h3>
                                    <p class="text-sm text-white/90 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-base">person</span>
                                        Member
                                    </p>
                                </div>
                            </div>

                            <a href="{{ route('profile.edit') }}"
                                class="block w-full py-3 bg-white/20 backdrop-blur-sm rounded-xl text-center font-bold hover:bg-white/30 transition-all shadow-lg border border-white/20 hover:scale-105 transform">
                                <span class="flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-lg">edit</span>
                                    Edit Profil
                                </span>
                            </a>
                        </div>
                    </div>

                    {{-- Quick Actions --}}
                    <div
                        class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-xl border border-gray-100 dark:border-gray-800">
                        <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-orange">bolt</span>
                            Aksi Cepat
                        </h3>
                        <div class="space-y-3">
                            <a href="{{ route('jelajah') }}"
                                class="flex items-center gap-3 p-4 bg-gradient-to-r from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 rounded-xl hover:shadow-lg transition-all group border border-orange-200/50 dark:border-orange-700/30">
                                <div
                                    class="p-2 bg-white dark:bg-orange-900/30 rounded-lg shadow-sm group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-primary-orange text-xl">explore</span>
                                </div>
                                <span class="font-bold text-gray-900 dark:text-white flex-1">Jelajah Produk</span>
                                <span
                                    class="material-symbols-outlined text-gray-400 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </a>

                            <a href="{{ route('jelajah') }}"
                                class="flex items-center gap-3 p-4 bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-xl hover:shadow-lg transition-all group border border-green-200/50 dark:border-green-700/30">
                                <div
                                    class="p-2 bg-white dark:bg-green-900/30 rounded-lg shadow-sm group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-primary-green text-xl">store</span>
                                </div>
                                <span class="font-bold text-gray-900 dark:text-white flex-1">Direktori UMKM</span>
                                <span
                                    class="material-symbols-outlined text-gray-400 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </a>

                            <a href="#"
                                class="flex items-center gap-3 p-4 bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-xl hover:shadow-lg transition-all group border border-blue-200/50 dark:border-blue-700/30">
                                <div
                                    class="p-2 bg-white dark:bg-blue-900/30 rounded-lg shadow-sm group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-blue-600 text-xl">map</span>
                                </div>
                                <span class="font-bold text-gray-900 dark:text-white flex-1">Peta Lokasi</span>
                                <span
                                    class="material-symbols-outlined text-gray-400 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                        </div>
                    </div>

                    {{-- UMKM Favorit --}}
                    <div
                        class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-xl border border-gray-100 dark:border-gray-800">
                        <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-red-500">favorite</span>
                            UMKM Favorit
                        </h3>
                        <div class="space-y-3">
                            @forelse($favoriteUmkms->take(5) as $umkm)
                                @php
                                    $uPhoto = $umkm->primaryPhoto
                                        ? (Str::startsWith($umkm->primaryPhoto->path, ['http']) ? $umkm->primaryPhoto->path : asset('storage/' . $umkm->primaryPhoto->path))
                                        : 'https://ui-avatars.com/api/?name=' .
                                            urlencode($umkm->nama_usaha) .
                                            '&background=random&size=128';
                                @endphp
                                <a href="{{ route('umkm.show', $umkm->slug) }}"
                                    class="flex items-center gap-3 hover:bg-gray-50 dark:hover:bg-gray-800/50 p-3 rounded-xl transition-all group border border-transparent hover:border-gray-200 dark:hover:border-gray-700">
                                    <img src="{{ $uPhoto }}"
                                        class="w-12 h-12 rounded-xl object-cover border-2 border-gray-200 dark:border-gray-700 group-hover:scale-110 transition-transform shadow-sm"
                                        alt="{{ $umkm->nama_usaha }}">
                                    <div class="flex-1 min-w-0">
                                        <div
                                            class="font-bold text-sm text-gray-900 dark:text-white truncate group-hover:text-primary-green transition-colors">
                                            {{ $umkm->nama_usaha }}
                                        </div>
                                        <div
                                            class="text-xs text-gray-500 dark:text-gray-400 capitalize flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs">category</span>
                                            {{ $umkm->kategori }}
                                        </div>
                                    </div>
                                    <span
                                        class="material-symbols-outlined text-gray-400 text-lg group-hover:text-primary-green group-hover:translate-x-1 transition-all">chevron_right</span>
                                </a>
                            @empty
                                <div class="text-center py-8">
                                    <div
                                        class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <span class="material-symbols-outlined text-3xl text-gray-400">store</span>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Belum ada UMKM favorit</p>
                                    <a href="{{ route('jelajah') }}"
                                        class="text-xs text-primary-orange font-bold hover:underline">
                                        Mulai eksplorasi →
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Kategori Populer --}}
                    <div
                        class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-xl border border-gray-100 dark:border-gray-800">
                        <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-purple-600">category</span>
                            Kategori Populer
                        </h3>
                        <div class="space-y-2">
                            <a href="{{ route('jelajah', ['kategori' => 'kuliner']) }}"
                                class="flex items-center justify-between p-3 bg-orange-50 dark:bg-orange-900/20 rounded-xl hover:shadow-md transition-all group border border-orange-100 dark:border-orange-800">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-orange-600">restaurant</span>
                                    <span class="font-semibold text-gray-900 dark:text-white text-sm">Kuliner</span>
                                </div>
                                <span
                                    class="material-symbols-outlined text-gray-400 group-hover:translate-x-1 transition-transform text-sm">arrow_forward</span>
                            </a>

                            <a href="{{ route('jelajah', ['kategori' => 'fashion']) }}"
                                class="flex items-center justify-between p-3 bg-pink-50 dark:bg-pink-900/20 rounded-xl hover:shadow-md transition-all group border border-pink-100 dark:border-pink-800">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-pink-600">checkroom</span>
                                    <span class="font-semibold text-gray-900 dark:text-white text-sm">Fashion</span>
                                </div>
                                <span
                                    class="material-symbols-outlined text-gray-400 group-hover:translate-x-1 transition-transform text-sm">arrow_forward</span>
                            </a>

                            <a href="{{ route('jelajah', ['kategori' => 'kerajinan']) }}"
                                class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/20 rounded-xl hover:shadow-md transition-all group border border-green-100 dark:border-green-800">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-green-600">handyman</span>
                                    <span class="font-semibold text-gray-900 dark:text-white text-sm">Kerajinan</span>
                                </div>
                                <span
                                    class="material-symbols-outlined text-gray-400 group-hover:translate-x-1 transition-transform text-sm">arrow_forward</span>
                            </a>

                            <a href="{{ route('jelajah') }}"
                                class="flex items-center justify-between p-3 bg-blue-50 dark:bg-blue-900/20 rounded-xl hover:shadow-md transition-all group border border-blue-100 dark:border-blue-800">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-blue-600">apps</span>
                                    <span class="font-semibold text-gray-900 dark:text-white text-sm">Lihat Semua</span>
                                </div>
                                <span
                                    class="material-symbols-outlined text-gray-400 group-hover:translate-x-1 transition-transform text-sm">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
        <style>
            @keyframes wave {

                0%,
                100% {
                    transform: rotate(0deg);
                }

                25% {
                    transform: rotate(20deg);
                }

                75% {
                    transform: rotate(-15deg);
                }
            }

            .animate-wave {
                display: inline-block;
                animation: wave 2s ease-in-out infinite;
            }

            .animate-pulse-slow {
                animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }

            @keyframes gradient {

                0%,
                100% {
                    background-position: 0% 50%;
                }

                50% {
                    background-position: 100% 50%;
                }
            }

            .animate-gradient {
                background-size: 200% 200%;
                animation: gradient 3s ease infinite;
            }
        </style>
    @endpush
@endsection
