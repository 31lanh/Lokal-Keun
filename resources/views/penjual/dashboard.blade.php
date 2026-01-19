@extends('layouts.seller')

@section('content')
    <div class="min-h-screen bg-[#F8F9FA] dark:bg-gray-900 font-sans text-gray-600 pb-20">

        {{-- 1. LOGIC PHP --}}
        @php
            // Ambil Banner (is_primary = true)
            $banner = $umkm->photos->where('is_primary', true)->first();
            $bannerUrl = null;
            
            if ($banner) {
                if ($banner->photo_url) {
                    $cleanUrl = ltrim($banner->photo_url, '/');
                    if (str_starts_with($cleanUrl, 'storage/') || file_exists(public_path($cleanUrl))) {
                        $bannerUrl = asset($cleanUrl);
                    } else {
                        $bannerUrl = asset('storage/' . $banner->photo_path);
                    }
                } else {
                    $bannerUrl = asset('storage/' . $banner->photo_path);
                }
            }
            
            $now = now()->format('H:i');
            $isOpen = $umkm->jam_buka && $umkm->jam_tutup && $now >= $umkm->jam_buka && $now <= $umkm->jam_tutup;
        @endphp

        {{-- 2. HERO SECTION (BANNER) --}}
        <div class="relative w-full h-64 lg:h-80 bg-gray-200 overflow-hidden group">
            @if ($bannerUrl)
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 group-hover:scale-105"
                    style="background-image: url('{{ $bannerUrl }}');">
                </div>
                <div class="absolute inset-0 bg-black/10 group-hover:bg-black/20 transition-colors"></div>
            @else
                <div class="absolute inset-0 bg-gray-300 flex items-center justify-center">
                    <span class="material-symbols-outlined text-gray-400 text-7xl">storefront</span>
                </div>
            @endif

            <a href="{{ route('seller.branding') }}"
                class="absolute top-6 right-6 px-5 py-2.5 bg-white/90 backdrop-blur-sm rounded-full text-gray-700 text-sm font-medium hover:bg-white transition-all shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-base">edit</span> Ubah Sampul
            </a>
        </div>

        {{-- 3. MAIN CONTAINER --}}
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            {{-- HEADER PROFILE --}}
            <div class="flex flex-col md:flex-row items-start md:items-end gap-6 md:gap-8 mb-12">
                
                {{-- Foto Profil (Overlap Banner) --}}
                <div class="relative group shrink-0 -mt-16 md:-mt-20 mx-auto md:mx-0">
                    <div class="w-36 h-36 md:w-48 md:h-48 rounded-3xl border-[6px] border-white dark:border-gray-800 bg-white shadow-md overflow-hidden relative">
                        <img src="{{ auth()->user()->profile_photo_path ? asset('storage/' . auth()->user()->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($umkm->nama_usaha) . '&background=random&size=200' }}"
                            class="w-full h-full object-cover">
                        
                        <a href="{{ route('seller.branding') }}" class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all cursor-pointer">
                            <span class="material-symbols-outlined text-white text-3xl">photo_camera</span>
                        </a>
                    </div>
                </div>

                {{-- Nama & Status (Di bawah banner, area putih) --}}
                <div class="flex-1 w-full text-center md:text-left pt-2 md:pb-4">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-end gap-6">
                        
                        {{-- Kiri: Judul & Info --}}
                        <div>
                            <h1 class="text-3xl md:text-4xl font-semibold text-gray-900 dark:text-white tracking-tight mb-2">
                                {{ $umkm->nama_usaha }}
                            </h1>

                            <p class="text-base text-gray-500 flex items-center justify-center md:justify-start gap-1.5 font-medium mb-4">
                                <span class="material-symbols-outlined text-xl text-gray-400">location_on</span>
                                {{ Str::limit($umkm->alamat, 60) }}
                            </p>
                            
                            {{-- Status Pill di bawah lokasi --}}
                            <div class="flex justify-center md:justify-start">
                                @if ($isOpen)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold uppercase tracking-wider shadow-sm">
                                        <span class="relative flex h-2 w-2">
                                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                          <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                        </span>
                                        Buka
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-50 text-rose-600 border border-rose-200 text-xs font-bold uppercase tracking-wider shadow-sm">
                                        <span class="h-2 w-2 rounded-full bg-rose-400"></span>
                                        Tutup
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Kanan: Action Buttons --}}
                        <div class="flex flex-wrap gap-3 justify-center w-full md:w-auto mt-4 md:mt-0">
                            <a href="{{ route('seller.umkm.edit') }}"
                                class="group px-6 py-2.5 bg-white border-2 border-gray-100 text-gray-600 rounded-xl text-base font-semibold hover:border-orange-200 hover:bg-orange-50 hover:text-primary-orange transition-all shadow-sm hover:shadow-md flex items-center gap-2">
                                <span class="material-symbols-outlined text-xl group-hover:rotate-45 transition-transform duration-300">settings</span>
                                Kelola Toko
                            </a>

                            <a href="{{ route('umkm.show', $umkm->slug) }}" target="_blank"
                                class="group px-6 py-2.5 bg-gray-900 text-white border border-transparent rounded-xl text-base font-semibold hover:bg-gradient-to-r hover:from-primary-orange hover:to-orange-600 hover:shadow-lg hover:shadow-orange-500/30 transition-all flex items-center gap-2 transform hover:-translate-y-0.5">
                                <span class="material-symbols-outlined text-xl group-hover:scale-110 transition-transform">visibility</span>
                                Lihat Toko
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. STATISTIK --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                {{-- Rating --}}
                <div class="bg-yellow-50 dark:bg-yellow-900/20 p-6 rounded-2xl border border-yellow-100 dark:border-yellow-800 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                    <div>
                        <p class="text-sm font-medium text-yellow-700 dark:text-yellow-400 uppercase tracking-wider mb-1">Rating Toko</p>
                        <div class="flex items-baseline gap-2">
                            <span class="text-4xl font-bold text-yellow-900 dark:text-yellow-100">{{ $umkm->rating ?? '0.0' }}</span>
                            <span class="text-base text-yellow-600 dark:text-yellow-300 font-normal">/ 5.0</span>
                        </div>
                    </div>
                    <div class="w-14 h-14 rounded-full bg-white dark:bg-yellow-800 flex items-center justify-center text-yellow-500 shadow-sm ring-4 ring-yellow-50 dark:ring-yellow-900">
                        <span class="material-symbols-outlined text-3xl">star</span>
                    </div>
                </div>

                {{-- Produk --}}
                <div class="bg-orange-50 dark:bg-orange-900/20 p-6 rounded-2xl border border-orange-100 dark:border-orange-800 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                    <div>
                        <p class="text-sm font-medium text-orange-700 dark:text-orange-400 uppercase tracking-wider mb-1">Total Produk</p>
                        <div class="flex items-baseline gap-2">
                            <span class="text-4xl font-bold text-orange-900 dark:text-orange-100">{{ $umkm->menus->count() }}</span>
                            <span class="text-base text-orange-600 dark:text-orange-300 font-normal">Item</span>
                        </div>
                    </div>
                    <div class="w-14 h-14 rounded-full bg-white dark:bg-orange-800 flex items-center justify-center text-orange-500 shadow-sm ring-4 ring-orange-50 dark:ring-orange-900">
                        <span class="material-symbols-outlined text-3xl">inventory_2</span>
                    </div>
                </div>

                {{-- Kunjungan --}}
                <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-2xl border border-blue-100 dark:border-blue-800 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                    <div>
                        <p class="text-sm font-medium text-blue-700 dark:text-blue-400 uppercase tracking-wider mb-1">Kunjungan</p>
                        <div class="flex items-baseline gap-2">
                            <span class="text-4xl font-bold text-blue-900 dark:text-blue-100">24</span>
                            <span class="text-base text-blue-600 dark:text-blue-300 font-normal">Views</span>
                        </div>
                    </div>
                    <div class="w-14 h-14 rounded-full bg-white dark:bg-blue-800 flex items-center justify-center text-blue-500 shadow-sm ring-4 ring-blue-50 dark:ring-blue-900">
                        <span class="material-symbols-outlined text-3xl">monitoring</span>
                    </div>
                </div>
            </div>

            {{-- 5. CONTENT GRID --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- SIDEBAR --}}
                <div class="lg:col-span-4 space-y-8">
                    {{-- About --}}
                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 shadow-sm p-6">
                        <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-5 pb-3 border-b border-gray-50 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-orange">store</span> Informasi Toko
                        </h3>
                        <div class="space-y-5 text-sm">
                            <div>
                                <label class="block text-sm text-gray-400 mb-1">Pemilik</label>
                                <p class="text-base font-medium text-gray-700 dark:text-gray-300">{{ $umkm->nama_pemilik }}</p>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-400 mb-1">Kontak</label>
                                <p class="text-base font-medium text-gray-700 dark:text-gray-300">{{ $umkm->telepon }}</p>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-400 mb-1">Kategori</label>
                                <p class="text-base font-medium text-gray-700 dark:text-gray-300 capitalize">{{ $umkm->kategori }}</p>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-400 mb-1">Jam Operasional</label>
                                @if ($umkm->jam_buka)
                                    <p class="text-base font-medium text-gray-700 dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($umkm->jam_buka)->format('H:i') }} - {{ \Carbon\Carbon::parse($umkm->jam_tutup)->format('H:i') }}
                                    </p>
                                @else
                                    <p class="text-gray-400 italic">Belum diatur</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Gallery Grid (FILTER IS_PRIMARY = FALSE) --}}
                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 shadow-sm p-6">
                        <div class="flex justify-between items-center mb-5">
                            <h3 class="text-base font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary-orange">photo_library</span> Galeri Foto
                            </h3>
                            <a href="{{ route('seller.umkm.edit') }}#gallery-container" class="text-orange-500 text-sm font-medium hover:underline">Edit</a>
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            {{-- FILTER BANNER DI SINI --}}
                            @forelse($umkm->photos->where('is_primary', false)->take(6) as $photo)
                                <div class="aspect-square rounded-xl bg-gray-100 overflow-hidden border border-gray-100">
                                    <img src="{{ $photo->photo_url ? asset(ltrim($photo->photo_url, '/')) : asset('storage/' . $photo->photo_path) }}"
                                         class="w-full h-full object-cover">
                                </div>
                            @empty
                                <div class="col-span-3 py-8 text-center text-gray-400 text-sm border border-dashed rounded-xl bg-gray-50">
                                    Tidak ada foto
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- MAIN CONTENT (Menu List) --}}
                <div class="lg:col-span-8">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 shadow-sm min-h-[500px]">
                        <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                            <div>
                                <h3 class="font-semibold text-gray-900 text-xl flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary-orange">restaurant_menu</span>
                                    Daftar Menu
                                </h3>
                                <p class="text-sm text-gray-400 mt-1">Kelola makanan & minuman</p>
                            </div>
                            <a href="{{ route('seller.umkm.edit') }}#menu-container"
                                class="inline-flex items-center gap-2 bg-primary-orange hover:bg-orange-600 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-all shadow-sm hover:shadow-md hover:-translate-y-0.5">
                                <span class="material-symbols-outlined text-base">add</span> Tambah
                            </a>
                        </div>

                        <div class="p-6">
                            @if ($umkm->menus->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    @foreach ($umkm->menus as $menu)
                                        <div class="group relative flex gap-5 p-5 rounded-2xl border border-gray-100 bg-white hover:border-orange-200 transition-all hover:shadow-lg">
                                            <div class="shrink-0 w-24 h-24 rounded-xl bg-gray-50 overflow-hidden border border-gray-100">
                                                @if ($menu->photo_path)
                                                    <img src="{{ asset(ltrim($menu->photo_path, '/')) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                                        <span class="material-symbols-outlined text-3xl">fastfood</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-1 min-w-0 flex flex-col justify-center">
                                                <div class="flex justify-between items-start">
                                                    <h4 class="text-lg font-medium text-gray-800 truncate pr-6 group-hover:text-primary-orange transition-colors">{{ $menu->name }}</h4>
                                                </div>
                                                <p class="text-sm text-gray-500 line-clamp-1 mt-1 mb-2 font-normal">
                                                    {{ $menu->description ?? 'Tidak ada deskripsi' }}
                                                </p>
                                                <p class="font-semibold text-base text-primary-orange">
                                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                                </p>
                                            </div>
                                            <div class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <a href="{{ route('seller.umkm.edit') }}#menu-container" class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                                    <span class="material-symbols-outlined text-base">edit</span>
                                                </a>
                                                <form action="{{ route('seller.menu.delete', $menu->id) }}" method="POST" onsubmit="return confirm('Hapus menu ini?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                                        <span class="material-symbols-outlined text-base">delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center py-24 text-center">
                                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-6 text-gray-300">
                                        <span class="material-symbols-outlined text-4xl">restaurant</span>
                                    </div>
                                    <h4 class="text-gray-900 font-medium text-lg mb-2">Belum Ada Menu</h4>
                                    <p class="text-gray-400 text-base mb-6">Tambahkan produk pertama Anda sekarang.</p>
                                    <a href="{{ route('seller.umkm.edit') }}#menu-container" class="text-primary-orange font-medium text-base hover:underline">
                                        + Tambah Menu
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection