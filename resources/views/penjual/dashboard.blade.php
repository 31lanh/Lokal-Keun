@extends('layouts.seller')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 font-sans text-gray-600 pb-20">

        {{-- 1. BAGIAN BANNER & HEADER --}}
        @php
            $banner = $umkm->photos->where('is_primary', true)->first();

            // Logic URL Banner
            if ($banner) {
                if ($banner->photo_url) {
                    $cleanUrl = ltrim($banner->photo_url, '/');
                    if (str_starts_with($cleanUrl, 'storage/')) {
                        $bannerUrl = asset($cleanUrl);
                    } elseif (file_exists(public_path($cleanUrl))) {
                        $bannerUrl = asset($cleanUrl);
                    } else {
                        $bannerUrl = asset('storage/' . $banner->photo_path);
                    }
                } else {
                    $bannerUrl = asset('storage/' . $banner->photo_path);
                }
            } else {
                // Placeholder cantik berupa gradient jika belum ada banner
                $bannerUrl = null;
            }
        @endphp

        {{-- Banner Container --}}
        <div class="relative w-full h-72 lg:h-80 bg-gray-800 overflow-hidden group">
            @if ($bannerUrl)
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                    style="background-image: url('{{ $bannerUrl }}');">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
            @else
                {{-- Fallback Gradient jika tidak ada banner --}}
                <div class="absolute inset-0 bg-gradient-to-r from-gray-700 to-gray-900"></div>
                <div class="absolute inset-0 flex items-center justify-center opacity-30">
                    <span class="material-symbols-outlined text-9xl text-white">storefront</span>
                </div>
            @endif

            {{-- Tombol Ganti Banner (Pojok Kanan Atas) --}}
            <a href="{{ route('seller.branding') }}"
                class="absolute top-24 right-6 lg:top-28 lg:right-10 z-20 flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full text-white text-xs font-bold hover:bg-white hover:text-gray-900 transition-all shadow-lg">
                <span class="material-symbols-outlined text-sm">edit</span>
                <span>Edit Tampilan</span>
            </a>
        </div>

        {{-- Content Container (Overlapping Banner) --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative -mt-24 z-10">

            {{-- Header Card --}}
            <div
                class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700 p-6 lg:p-8 mb-8">
                <div class="flex flex-col lg:flex-row gap-6 items-start lg:items-end">

                    {{-- Foto Profil (Logo) --}}
                    <div class="relative shrink-0 -mt-16 lg:-mt-20">
                        <div
                            class="w-32 h-32 lg:w-40 lg:h-40 rounded-3xl border-4 border-white dark:border-gray-700 bg-white shadow-lg overflow-hidden relative group">
                            <img src="{{ auth()->user()->profile_photo_path ? asset('storage/' . auth()->user()->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($umkm->nama_usaha) . '&background=random&size=200' }}"
                                alt="Logo" class="w-full h-full object-cover">

                            {{-- Overlay Edit Logo --}}
                            <a href="{{ route('seller.branding') }}"
                                class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                <span class="material-symbols-outlined text-white text-3xl">photo_camera</span>
                            </a>
                        </div>
                    </div>

                    {{-- Info Toko --}}
                    <div class="flex-1 w-full">
                        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-end gap-4">
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                                        {{ $umkm->nama_usaha }}
                                    </h1>
                                    @php
                                        $now = now()->format('H:i');
                                        $isOpen =
                                            $umkm->jam_buka &&
                                            $umkm->jam_tutup &&
                                            $now >= $umkm->jam_buka &&
                                            $now <= $umkm->jam_tutup;
                                    @endphp
                                    @if ($isOpen)
                                        <span
                                            class="px-3 py-1 rounded-full bg-green-100 text-green-700 border border-green-200 text-xs font-bold uppercase tracking-wider flex items-center gap-1">
                                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span> Buka
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 rounded-full bg-gray-100 text-gray-500 border border-gray-200 text-xs font-bold uppercase tracking-wider">
                                            Tutup
                                        </span>
                                    @endif
                                </div>

                                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                                    <div
                                        class="flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <span
                                            class="material-symbols-outlined text-lg text-primary-orange">storefront</span>
                                        <span
                                            class="font-medium text-gray-700 dark:text-gray-200">{{ ucfirst($umkm->kategori) }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-lg">location_on</span>
                                        {{ Str::limit($umkm->alamat, 50) }}
                                    </div>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex gap-3">
                                <a href="{{ route('seller.umkm.edit') }}"
                                    class="flex-1 lg:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-white border-2 border-gray-200 text-gray-700 rounded-xl font-bold hover:border-primary-orange hover:text-primary-orange transition-all shadow-sm">
                                    <span class="material-symbols-outlined text-xl">settings</span>
                                    <span>Kelola</span>
                                </a>
                                <a href="{{ route('umkm.show', $umkm->slug) }}" target="_blank"
                                    class="flex-1 lg:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-gradient-to-r from-primary-orange to-orange-600 text-white rounded-xl font-bold hover:shadow-lg hover:shadow-orange-500/30 hover:-translate-y-0.5 transition-all">
                                    <span class="material-symbols-outlined text-xl">visibility</span>
                                    <span>Lihat Toko</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. STATISTIK CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                {{-- Card Rating --}}
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all relative overflow-hidden group">
                    <div
                        class="absolute top-0 right-0 w-24 h-24 bg-yellow-100 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110">
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-2 text-yellow-600">
                            <span class="material-symbols-outlined text-3xl">star</span>
                            <span class="font-bold uppercase tracking-wider text-xs">Rating</span>
                        </div>
                        <div class="flex items-baseline gap-2">
                            <h3 class="text-4xl font-extrabold text-gray-900 dark:text-white">{{ $umkm->rating ?? '0.0' }}
                            </h3>
                            <span class="text-sm text-gray-500">/ 5.0</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Dari {{ $umkm->total_reviews ?? 0 }} ulasan pelanggan</p>
                    </div>
                </div>

                {{-- Card Menu --}}
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all relative overflow-hidden group">
                    <div
                        class="absolute top-0 right-0 w-24 h-24 bg-orange-100 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110">
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-2 text-orange-600">
                            <span class="material-symbols-outlined text-3xl">restaurant_menu</span>
                            <span class="font-bold uppercase tracking-wider text-xs">Total Menu</span>
                        </div>
                        <div class="flex items-baseline gap-2">
                            <h3 class="text-4xl font-extrabold text-gray-900 dark:text-white">{{ $umkm->menus->count() }}
                            </h3>
                            <span class="text-sm text-gray-500">Item</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Menu aktif ditampilkan di toko</p>
                    </div>
                </div>

                {{-- Card Kunjungan (Dummy) --}}
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all relative overflow-hidden group">
                    <div
                        class="absolute top-0 right-0 w-24 h-24 bg-blue-100 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110">
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-2 text-blue-600">
                            <span class="material-symbols-outlined text-3xl">monitoring</span>
                            <span class="font-bold uppercase tracking-wider text-xs">Kunjungan</span>
                        </div>
                        <div class="flex items-baseline gap-2">
                            <h3 class="text-4xl font-extrabold text-gray-900 dark:text-white">24</h3>
                            <span class="text-sm text-gray-500">Kali</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Total dilihat dalam 30 hari terakhir</p>
                    </div>
                </div>
            </div>

            {{-- 3. GRID UTAMA (DETAIL & MENU) --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- KOLOM KIRI (Info Detail) --}}
                <div class="lg:col-span-1 space-y-8">
                    {{-- Box Info Kontak --}}
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-6">
                        <h3 class="font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-orange">info</span>
                            Detail Informasi
                        </h3>

                        <ul class="space-y-5">
                            <li class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center shrink-0 text-gray-500">
                                    <span class="material-symbols-outlined">person</span>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase">Pemilik</p>
                                    <p class="font-medium text-gray-800 dark:text-gray-200">{{ $umkm->nama_pemilik }}</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center shrink-0 text-gray-500">
                                    <span class="material-symbols-outlined">call</span>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase">WhatsApp / Telepon</p>
                                    <p class="font-medium text-gray-800 dark:text-gray-200">{{ $umkm->telepon }}</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center shrink-0 text-gray-500">
                                    <span class="material-symbols-outlined">schedule</span>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase">Jam Operasional</p>
                                    @if ($umkm->jam_buka)
                                        <p class="font-medium text-gray-800 dark:text-gray-200">
                                            {{ \Carbon\Carbon::parse($umkm->jam_buka)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($umkm->jam_tutup)->format('H:i') }}
                                        </p>
                                    @else
                                        <p class="text-sm text-gray-400 italic">Belum diatur</p>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>

                    {{-- Box Galeri Mini --}}
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary-orange">photo_library</span>
                                Galeri
                            </h3>
                            <a href="{{ route('seller.umkm.edit') }}#gallery-container"
                                class="text-xs font-bold text-primary-orange hover:underline">Kelola</a>
                        </div>

                        <div class="grid grid-cols-3 gap-2">
                            @forelse($umkm->photos->take(6) as $photo)
                                <div
                                    class="aspect-square rounded-lg overflow-hidden border border-gray-100 bg-gray-50 relative group">
                                    <img src="{{ $photo->photo_url ? asset(ltrim($photo->photo_url, '/')) : asset('storage/' . $photo->photo_path) }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                            @empty
                                <div
                                    class="col-span-3 py-8 text-center bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                                    <span
                                        class="material-symbols-outlined text-gray-300 text-3xl mb-1">image_not_supported</span>
                                    <p class="text-xs text-gray-400">Belum ada foto</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN (Daftar Menu) --}}
                <div class="lg:col-span-2">
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm h-full">
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                            <h3 class="font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary-orange">restaurant_menu</span>
                                Daftar Menu
                            </h3>
                            <a href="{{ route('seller.umkm.edit') }}#menu-container"
                                class="inline-flex items-center gap-1 bg-gray-900 hover:bg-gray-800 text-white px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                                <span class="material-symbols-outlined text-sm">add</span> Tambah Menu
                            </a>
                        </div>

                        <div class="p-6">
                            @if ($umkm->menus->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach ($umkm->menus as $menu)
                                        <div
                                            class="group flex items-start gap-4 p-4 rounded-2xl border border-gray-100 bg-white hover:border-orange-200 hover:shadow-lg hover:shadow-orange-500/5 transition-all duration-300 relative">
                                            {{-- Foto Menu --}}
                                            <div
                                                class="shrink-0 w-20 h-20 rounded-xl bg-gray-100 overflow-hidden shadow-inner">
                                                @if ($menu->photo_path)
                                                    <img src="{{ asset(ltrim($menu->photo_path, '/')) }}"
                                                        class="w-full h-full object-cover">
                                                @else
                                                    <div
                                                        class="w-full h-full flex items-center justify-center text-gray-400">
                                                        <span class="material-symbols-outlined text-2xl">fastfood</span>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="flex-1 min-w-0">
                                                <h4
                                                    class="font-bold text-gray-800 truncate group-hover:text-primary-orange transition-colors">
                                                    {{ $menu->name }}</h4>
                                                <p class="text-xs text-gray-500 line-clamp-1 mb-2">
                                                    {{ $menu->description ?? 'Tidak ada deskripsi' }}</p>
                                                <p
                                                    class="font-extrabold text-green-600 bg-green-50 inline-block px-2 py-1 rounded-lg text-sm">
                                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                                </p>
                                            </div>

                                            {{-- Action Menu Hover --}}
                                            <div
                                                class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <a href="{{ route('seller.umkm.edit') }}#menu-container"
                                                    class="p-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-colors"
                                                    title="Edit">
                                                    <span class="material-symbols-outlined text-base">edit</span>
                                                </a>
                                                <form action="{{ route('seller.menu.delete', $menu->id) }}"
                                                    method="POST" onsubmit="return confirm('Hapus menu ini?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        class="p-1.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-colors"
                                                        title="Hapus">
                                                        <span class="material-symbols-outlined text-base">delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center py-16 text-center">
                                    <div class="w-20 h-20 bg-orange-50 rounded-full flex items-center justify-center mb-4">
                                        <span class="material-symbols-outlined text-4xl text-orange-300">restaurant</span>
                                    </div>
                                    <h4 class="text-lg font-bold text-gray-800">Belum Ada Menu</h4>
                                    <p class="text-sm text-gray-500 max-w-xs mx-auto mb-6">Toko Anda masih kosong.
                                        Tambahkan menu andalan Anda sekarang untuk menarik pembeli.</p>
                                    <a href="{{ route('seller.umkm.edit') }}#menu-container"
                                        class="text-primary-orange font-bold hover:underline text-sm">
                                        + Tambah Menu Pertama
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
