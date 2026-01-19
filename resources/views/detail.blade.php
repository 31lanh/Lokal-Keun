@extends('layouts.app')

@section('content')
    {{-- 
        SETUP ALPINE DATA:
        activeTab: Menentukan konten mana yang tampil ('about', 'products', 'gallery', 'reviews')
    --}}
    <div x-data="{ 
            activeTab: 'about',
            switchTab(tabName) {
                this.activeTab = tabName;
                document.getElementById('profil-tabs').scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
         }" 
         class="min-h-screen pt-24 pb-10 bg-gray-50 dark:bg-gray-900 font-display">

        <main class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- BREADCRUMB --}}
            <nav class="mb-6 flex items-center text-sm text-gray-500 dark:text-gray-400 overflow-x-auto whitespace-nowrap pb-2">
                <a href="/" class="hover:text-primary-orange transition-colors">Beranda</a>
                <span class="mx-2 material-symbols-outlined text-xs">chevron_right</span>
                <span class="hover:text-primary-orange transition-colors cursor-pointer">{{ $umkm->kategori }}</span>
                <span class="mx-2 material-symbols-outlined text-xs">chevron_right</span>
                <span class="font-semibold text-gray-900 dark:text-white">{{ $umkm->nama_usaha }}</span>
            </nav>

            @php
                // Setup Gambar Banner & Logo
                $banner = $umkm->photos->where('is_primary', true)->first();
                $bannerUrl = 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=1200&h=400&fit=crop'; 

                if ($banner) {
                    if ($banner->photo_url) {
                        $cleanUrl = ltrim($banner->photo_url, '/');
                        $bannerUrl = str_starts_with($cleanUrl, 'storage/') ? asset($cleanUrl) : asset('storage/' . $banner->photo_path);
                    }
                }

                $logoUrl = 'https://ui-avatars.com/api/?name=' . urlencode($umkm->nama_usaha) . '&background=FF6B35&color=fff&size=256';
                if ($umkm->user && $umkm->user->profile_photo_path) {
                    $cleanLogo = ltrim($umkm->user->profile_photo_path, '/');
                    $logoUrl = str_starts_with($cleanLogo, 'storage/') ? asset($cleanLogo) : asset('storage/' . $umkm->user->profile_photo_path);
                }
            @endphp

            {{-- 1. HEADER PROFIL --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700 mb-8">
                <div class="relative h-48 md:h-72 w-full bg-gray-200">
                    <img src="{{ $bannerUrl }}" alt="Banner" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                </div>

                <div class="px-6 pb-6 relative">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="-mt-12 md:-mt-16 shrink-0 relative z-10 mx-auto md:mx-0">
                            <div class="size-28 md:size-32 rounded-2xl border-[5px] border-white dark:border-gray-800 bg-white shadow-md overflow-hidden">
                                <img src="{{ $logoUrl }}" alt="Logo" class="w-full h-full object-cover">
                            </div>
                        </div>

                        <div class="flex-1 text-center md:text-left pt-2 md:pt-4">
                            <div class="flex flex-col md:flex-row md:justify-between gap-4">
                                <div>
                                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2 flex items-center justify-center md:justify-start gap-2">
                                        {{ $umkm->nama_usaha }}
                                        <span class="material-symbols-outlined text-blue-500 text-xl filled" title="Terverifikasi">verified</span>
                                    </h1>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center justify-center md:justify-start gap-1">
                                        <span class="material-symbols-outlined text-sm">location_on</span>
                                        {{ Str::limit($umkm->alamat, 60) }}
                                    </p>
                                </div>

                                <div class="flex gap-3 justify-center md:justify-end">
                                    <button onclick="shareUMKM()" class="px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold text-sm transition-all flex items-center gap-2">
                                        <span class="material-symbols-outlined text-lg">share</span> Share
                                    </button>
                                    <a href="{{ $umkm->whatsapp_link ?? '#' }}" target="_blank" class="px-6 py-2 rounded-xl bg-primary-orange hover:bg-orange-600 text-white font-bold text-sm transition-all shadow-lg shadow-orange-500/30 flex items-center gap-2">
                                        <span class="material-symbols-outlined text-lg">chat</span> Hubungi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- NAVIGASI TAB (STICKY & INTERACTIVE) --}}
                <div class="border-t border-gray-100 dark:border-gray-700 sticky top-[80px] bg-white dark:bg-gray-800 z-30 transition-all" id="profil-tabs">
                    <div class="flex overflow-x-auto no-scrollbar px-6 gap-8">
                        {{-- Button Tab menggunakan Alpine @click --}}
                        <button @click="activeTab = 'about'" 
                                :class="activeTab === 'about' ? 'text-primary-orange border-primary-orange' : 'text-gray-500 hover:text-gray-900 border-transparent'"
                                class="py-4 text-sm font-bold border-b-2 transition-colors whitespace-nowrap">
                            Tentang
                        </button>
                        <button @click="activeTab = 'products'" 
                                :class="activeTab === 'products' ? 'text-primary-orange border-primary-orange' : 'text-gray-500 hover:text-gray-900 border-transparent'"
                                class="py-4 text-sm font-bold border-b-2 transition-colors whitespace-nowrap">
                            Menu
                        </button>
                        <button @click="activeTab = 'gallery'" 
                                :class="activeTab === 'gallery' ? 'text-primary-orange border-primary-orange' : 'text-gray-500 hover:text-gray-900 border-transparent'"
                                class="py-4 text-sm font-bold border-b-2 transition-colors whitespace-nowrap">
                            Galeri
                        </button>
                        <button @click="activeTab = 'reviews'" 
                                :class="activeTab === 'reviews' ? 'text-primary-orange border-primary-orange' : 'text-gray-500 hover:text-gray-900 border-transparent'"
                                class="py-4 text-sm font-bold border-b-2 transition-colors whitespace-nowrap">
                            Ulasan
                        </button>
                    </div>
                </div>
            </div>

            {{-- MAIN CONTENT GRID --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start relative">
                
                {{-- LEFT CONTENT (Dynamic Content based on Tab) --}}
                <div class="lg:col-span-8 min-h-[500px]">

                    {{-- TAB 1: TENTANG (Berisi Deskripsi + Preview Menu + Preview Galeri) --}}
                    <div x-show="activeTab === 'about'" 
                         x-transition:enter="transition ease-out duration-300 transform"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="space-y-8">
                        
                        {{-- Deskripsi & Highlight --}}
                        <section class="bg-white dark:bg-gray-800 rounded-2xl p-6 md:p-8 shadow-sm border border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2 border-b border-gray-100 dark:border-gray-700 pb-3">
                                <span class="material-symbols-outlined text-primary-orange">storefront</span> Tentang Toko
                            </h3>
                            <div class="prose dark:prose-invert max-w-none text-sm leading-relaxed text-gray-600 dark:text-gray-300 break-words mb-6">
                                <p class="whitespace-pre-line">{{ $umkm->deskripsi }}</p>
                            </div>

                            {{-- Highlight Info (IMPROVED DESIGN) --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="flex items-center gap-4 p-4 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100/50 dark:from-blue-900/20 dark:to-blue-800/10 border border-blue-100 dark:border-blue-800 hover:shadow-md transition-shadow">
                                    <div class="size-12 rounded-full bg-blue-500 text-white flex items-center justify-center shrink-0 shadow-lg shadow-blue-500/30">
                                        <span class="material-symbols-outlined">history_edu</span>
                                    </div>
                                    <div>
                                        <p class="text-xs text-blue-600 dark:text-blue-300 font-bold uppercase tracking-wider mb-0.5">Berdiri Sejak</p>
                                        <p class="text-xl font-extrabold text-gray-900 dark:text-white">{{ $umkm->tahun_berdiri ?? '-' }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4 p-4 rounded-xl bg-gradient-to-br from-orange-50 to-orange-100/50 dark:from-orange-900/20 dark:to-orange-800/10 border border-orange-100 dark:border-orange-800 hover:shadow-md transition-shadow">
                                    <div class="size-12 rounded-full bg-primary-orange text-white flex items-center justify-center shrink-0 shadow-lg shadow-orange-500/30">
                                        <span class="material-symbols-outlined">category</span>
                                    </div>
                                    <div>
                                        <p class="text-xs text-orange-600 dark:text-orange-300 font-bold uppercase tracking-wider mb-0.5">Kategori</p>
                                        <p class="text-xl font-extrabold text-gray-900 dark:text-white capitalize">{{ $umkm->kategori }}</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        {{-- Preview Menu (Limit 3) --}}
                        <section class="bg-white dark:bg-gray-800 rounded-2xl p-6 md:p-8 shadow-sm border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary-orange">restaurant_menu</span> Menu Unggulan
                                </h3>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                                @forelse($umkm->menus->take(3) as $menu)
                                    <div class="bg-white dark:bg-gray-900 rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all group">
                                        <div class="aspect-[4/3] bg-gray-100 relative overflow-hidden">
                                            @if ($menu->photo_path)
                                                <img src="{{ asset(ltrim($menu->photo_path, '/')) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-gray-300"><span class="material-symbols-outlined text-4xl">fastfood</span></div>
                                            @endif
                                        </div>
                                        <div class="p-4">
                                            <h4 class="font-bold text-gray-900 dark:text-white line-clamp-1 text-sm">{{ $menu->name }}</h4>
                                            <p class="text-primary-orange font-bold text-sm mt-1">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-span-full py-8 text-center text-gray-400 bg-gray-50 rounded-xl border border-dashed border-gray-200">Belum ada menu.</div>
                                @endforelse
                            </div>
                            @if($umkm->menus->count() > 3)
                                <div class="mt-6 text-center border-t border-gray-100 dark:border-gray-700 pt-4">
                                    {{-- Tombol Switch Tab --}}
                                    <button @click="switchTab('products')" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-orange-50 text-primary-orange font-bold text-sm hover:bg-orange-100 transition-colors">
                                        Lihat {{ $umkm->menus->count() }} Menu Lengkap
                                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                    </button>
                                </div>
                            @endif
                        </section>

                        {{-- Preview Gallery (Limit 4) --}}
                        <section class="bg-white dark:bg-gray-800 rounded-2xl p-6 md:p-8 shadow-sm border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary-orange">photo_library</span> Galeri
                                </h3>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @forelse($umkm->photos->take(4) as $photo)
                                    <div class="aspect-square rounded-xl overflow-hidden relative group shadow-sm border border-gray-200">
                                        <img src="{{ $photo->photo_url ? asset(ltrim($photo->photo_url, '/')) : asset('storage/' . $photo->photo_path) }}" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    </div>
                                @empty
                                    <div class="col-span-full py-8 text-center text-gray-400 bg-gray-50 rounded-xl border border-dashed border-gray-200">Belum ada foto.</div>
                                @endforelse
                            </div>
                            @if($umkm->photos->count() > 4)
                                <div class="mt-6 text-center border-t border-gray-100 dark:border-gray-700 pt-4">
                                    {{-- Tombol Switch Tab --}}
                                    <button @click="switchTab('gallery')" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-orange-50 text-primary-orange font-bold text-sm hover:bg-orange-100 transition-colors">
                                        Lihat {{ $umkm->photos->count() }} Foto Lengkap
                                        <span class="material-symbols-outlined text-sm">grid_view</span>
                                    </button>
                                </div>
                            @endif
                        </section>
                    </div>

                    {{-- TAB 2: SEMUA MENU (Full Page Slide Effect) --}}
                    <div x-show="activeTab === 'products'" style="display: none;"
                         x-transition:enter="transition ease-out duration-300 transform"
                         x-transition:enter-start="opacity-0 translate-x-10"
                         x-transition:enter-end="opacity-100 translate-x-0">
                        
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 md:p-8 shadow-sm border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100 dark:border-gray-700">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary-orange">restaurant_menu</span> Semua Menu ({{ $umkm->menus->count() }})
                                </h3>
                                {{-- Tombol Back to About --}}
                                <button @click="activeTab = 'about'" class="text-sm text-gray-500 hover:text-primary-orange flex items-center gap-1 font-semibold">
                                    <span class="material-symbols-outlined text-lg">arrow_back</span> Kembali
                                </button>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                                @foreach($umkm->menus as $menu)
                                    <div class="bg-white dark:bg-gray-900 rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all group">
                                        <div class="aspect-[4/3] bg-gray-100 relative overflow-hidden">
                                            @if ($menu->photo_path)
                                                <img src="{{ asset(ltrim($menu->photo_path, '/')) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-gray-300"><span class="material-symbols-outlined text-4xl">fastfood</span></div>
                                            @endif
                                        </div>
                                        <div class="p-4">
                                            <h4 class="font-bold text-gray-900 dark:text-white line-clamp-1 text-sm">{{ $menu->name }}</h4>
                                            <p class="text-primary-orange font-bold text-sm mt-1">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                                            <p class="text-xs text-gray-500 mt-2 line-clamp-2">{{ $menu->description }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- TAB 3: SEMUA GALERI (Full Page Slide Effect) --}}
                    <div x-show="activeTab === 'gallery'" style="display: none;"
                         x-transition:enter="transition ease-out duration-300 transform"
                         x-transition:enter-start="opacity-0 translate-x-10"
                         x-transition:enter-end="opacity-100 translate-x-0">
                        
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 md:p-8 shadow-sm border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100 dark:border-gray-700">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary-orange">photo_library</span> Semua Foto ({{ $umkm->photos->count() }})
                                </h3>
                                <button @click="activeTab = 'about'" class="text-sm text-gray-500 hover:text-primary-orange flex items-center gap-1 font-semibold">
                                    <span class="material-symbols-outlined text-lg">arrow_back</span> Kembali
                                </button>
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach($umkm->photos as $photo)
                                    <div class="aspect-square rounded-xl overflow-hidden relative group shadow-sm border border-gray-200 hover:scale-[1.02] transition-transform cursor-pointer">
                                        <img src="{{ $photo->photo_url ? asset(ltrim($photo->photo_url, '/')) : asset('storage/' . $photo->photo_path) }}" 
                                             class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- TAB 4: ULASAN --}}
                    <div x-show="activeTab === 'reviews'" style="display: none;"
                         x-transition:enter="transition ease-out duration-300 transform"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0">
                        <section class="bg-white dark:bg-gray-800 rounded-2xl p-6 md:p-8 shadow-sm border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between mb-6 pb-3 border-b border-gray-100 dark:border-gray-700">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary-orange">reviews</span> Ulasan & Rating
                                </h3>
                            </div>
                            <div class="text-center py-10">
                                <div class="text-6xl font-extrabold text-gray-900 dark:text-white mb-2">{{ $umkm->rating ?? '0.0' }}</div>
                                <div class="flex justify-center text-amber-400 mb-6 gap-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="material-symbols-outlined filled text-3xl">star{{ $i > ($umkm->rating ?? 0) ? '_border' : '' }}</span>
                                    @endfor
                                </div>
                                @if ($umkm->maps_link)
                                    <a href="{{ $umkm->maps_link }}" target="_blank" class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-blue-600 text-white font-bold text-sm hover:bg-blue-700 shadow-lg hover:shadow-blue-500/30 transition-all">
                                        <span class="material-symbols-outlined">open_in_new</span>
                                        Lihat Ulasan di Google Maps
                                    </a>
                                @else
                                    <p class="text-gray-400 text-sm italic">Link Google Maps belum tersedia.</p>
                                @endif
                            </div>
                        </section>
                    </div>

                </div>

{{-- RIGHT SIDEBAR (4 Kolom - Sticky) --}}
                <div class="lg:col-span-4 relative">
                    {{-- 
                        LOGIKA STICKY:
                        1. sticky: Mengaktifkan fitur sticky positioning.
                        2. top-28: Jarak dari atas browser (sekitar 112px) supaya tidak ketutup Header.
                        3. z-10: Memastikan posisinya di atas elemen dekoratif lain jika ada.
                    --}}
                    <div class="sticky top-28 space-y-6 z-10">
                        
                        {{-- Card Info Praktis --}}
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                            <h4 class="font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-100 dark:border-gray-700 flex items-center gap-2">
                                <span class="material-symbols-outlined text-blue-500">info</span> Info Praktis
                            </h4>

                            {{-- Jam Buka --}}
                            @php
                                $now = now()->format('H:i');
                                $isOpen = $umkm->jam_buka && $umkm->jam_tutup && $now >= $umkm->jam_buka && $now <= $umkm->jam_tutup;
                            @endphp
                            <div class="mb-6">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm text-gray-500 font-medium">Status Saat Ini</span>
                                    @if($isOpen)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-green-100 text-green-700 text-xs font-bold border border-green-200">
                                            <span class="size-2 rounded-full bg-green-500 animate-pulse"></span> Buka
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-red-100 text-red-700 text-xs font-bold border border-red-200">
                                            <span class="size-2 rounded-full bg-red-500"></span> Tutup
                                        </span>
                                    @endif
                                </div>
                                <div class="p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-100 dark:border-gray-600 flex justify-between items-center">
                                    <span class="text-sm text-gray-600 dark:text-gray-300">Jam Operasional</span>
                                    <span class="font-mono text-sm font-bold text-gray-900 dark:text-white">
                                        {{ \Carbon\Carbon::parse($umkm->jam_buka)->format('H:i') }} - {{ \Carbon\Carbon::parse($umkm->jam_tutup)->format('H:i') }}
                                    </span>
                                </div>
                            </div>

                            {{-- Lokasi & Maps --}}
                            <div>
                                <span class="text-sm text-gray-500 font-medium mb-2 block">Lokasi</span>
                                <div class="aspect-video w-full rounded-xl bg-gray-100 overflow-hidden relative mb-3 border border-gray-200">
                                    <iframe width="100%" height="100%" frameborder="0" scrolling="no" style="filter: grayscale(0.2);"
                                        src="https://maps.google.com/maps?q={{ urlencode($umkm->nama_usaha . ' ' . $umkm->alamat) }}&t=&z=15&ie=UTF8&iwloc=&output=embed">
                                    </iframe>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-300 leading-snug mb-4">{{ $umkm->alamat }}</p>
                                
                                @if ($umkm->maps_link)
                                    <a href="{{ $umkm->maps_link }}" target="_blank" class="block w-full py-2.5 text-center rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-bold transition-colors border border-gray-200">
                                        Buka di Google Maps
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </main>
    </div>

    <script>
        function shareUMKM() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $umkm->nama_usaha }}',
                    text: 'Cek profil UMKM ini di LokalKeun!',
                    url: window.location.href
                });
            } else {
                navigator.clipboard.writeText(window.location.href);
                alert('Link profil berhasil disalin!');
            }
        }
    </script>
@endsection