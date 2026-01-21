@extends('layouts.app')

@section('content')
    {{-- 
        SETUP ALPINE DATA:
        Mengecek session 'active_tab'. Jika ada (dari controller), pakai itu. Jika tidak, default 'about'.
    --}}
    <div x-data="{ 
            activeTab: '{{ session('active_tab', 'about') }}',
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
                <span class="hover:text-primary-orange transition-colors cursor-pointer capitalize">{{ $umkm->kategori }}</span>
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
            </div>

            {{-- NAVIGASI TAB (STICKY & INTERACTIVE) --}}
            <div class="border-t border-gray-100 dark:border-gray-700 sticky top-[80px] bg-white dark:bg-gray-800 z-30 transition-all" id="profil-tabs">
                <div class="flex overflow-x-auto no-scrollbar px-6 gap-8">
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

            {{-- MAIN CONTENT GRID --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start relative mt-8">
                
                {{-- LEFT CONTENT (Dynamic Content based on Tab) --}}
                <div class="lg:col-span-8 min-h-[500px]">

                    {{-- TAB 1: TENTANG --}}
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

                            {{-- Highlight Info --}}
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

                        {{-- Preview Menu (Prioritaskan yg Unggulan) --}}
                        <section class="bg-white dark:bg-gray-800 rounded-2xl p-6 md:p-8 shadow-sm border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary-orange">restaurant_menu</span> Menu Unggulan
                                </h3>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                                @php
                                    $highlightMenus = $umkm->menus->where('is_recommended', true)->take(3);
                                    if ($highlightMenus->count() < 3) {
                                        $remaining = 3 - $highlightMenus->count();
                                        $regularMenus = $umkm->menus->where('is_recommended', false)->take($remaining);
                                        $highlightMenus = $highlightMenus->merge($regularMenus);
                                    }
                                @endphp

                                @forelse($highlightMenus as $menu)
                                    <div class="bg-white dark:bg-gray-900 rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all group relative">
                                        
                                        @if($menu->is_recommended)
                                            <div class="absolute top-0 right-0 bg-yellow-400 text-yellow-900 text-[10px] font-bold px-3 py-1 rounded-bl-xl z-10 shadow-sm flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[14px]">star</span> UNGGULAN
                                            </div>
                                        @endif

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
                                    <button @click="switchTab('gallery')" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-orange-50 text-primary-orange font-bold text-sm hover:bg-orange-100 transition-colors">
                                        Lihat {{ $umkm->photos->count() }} Foto Lengkap
                                        <span class="material-symbols-outlined text-sm">grid_view</span>
                                    </button>
                                </div>
                            @endif
                        </section>
                    </div>

                    {{-- TAB 2: SEMUA MENU --}}
                    <div x-show="activeTab === 'products'" style="display: none;"
                         x-transition:enter="transition ease-out duration-300 transform"
                         x-transition:enter-start="opacity-0 translate-x-10"
                         x-transition:enter-end="opacity-100 translate-x-0">
                        
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 md:p-8 shadow-sm border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100 dark:border-gray-700">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary-orange">restaurant_menu</span> Semua Menu ({{ $umkm->menus->count() }})
                                </h3>
                                <button @click="activeTab = 'about'" class="text-sm text-gray-500 hover:text-primary-orange flex items-center gap-1 font-semibold">
                                    <span class="material-symbols-outlined text-lg">arrow_back</span> Kembali
                                </button>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                                {{-- Urutkan yang unggulan paling atas --}}
                                @foreach($umkm->menus->sortByDesc('is_recommended') as $menu)
                                    <div class="bg-white dark:bg-gray-900 rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all group relative">
                                        
                                        @if($menu->is_recommended)
                                            <div class="absolute top-0 right-0 bg-yellow-400 text-yellow-900 text-[10px] font-bold px-3 py-1 rounded-bl-xl z-10 shadow-sm flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[14px]">star</span> UNGGULAN
                                            </div>
                                        @endif

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

                    {{-- TAB 3: SEMUA GALERI --}}
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
                                    <span class="material-symbols-outlined text-primary-orange">reviews</span> Ulasan ({{ $umkm->total_reviews }})
                                </h3>
                            </div>

                            {{-- Statistik Rating --}}
                            <div class="text-center py-6 border-b border-gray-100 dark:border-gray-700 mb-8">
                                <div class="text-6xl font-extrabold text-gray-900 dark:text-white mb-2">{{ $umkm->rating ?? '0.0' }}</div>
                                <div class="flex justify-center text-amber-400 mb-2 gap-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="material-symbols-outlined filled text-3xl">star{{ $i > ($umkm->rating ?? 0) ? '_border' : '' }}</span>
                                    @endfor
                                </div>
                                <p class="text-gray-500 text-sm">Berdasarkan {{ $umkm->total_reviews }} ulasan</p>
                            </div>

                            {{-- Daftar Ulasan --}}
                            <div class="space-y-6">
                                @forelse($umkm->reviews as $review)
                                    <div class="flex gap-4 items-start">
                                        {{-- Avatar User --}}
                                        <div class="shrink-0">
                                            @if($review->user->profile_photo_path)
                                                 <img src="{{ asset('storage/' . $review->user->profile_photo_path) }}" class="size-10 rounded-full object-cover border border-gray-200">
                                            @else
                                                 <div class="size-10 rounded-full bg-gradient-to-br from-primary-orange to-orange-400 text-white flex items-center justify-center font-bold text-sm">
                                                     {{ substr($review->user->name, 0, 1) }}
                                                 </div>
                                            @endif
                                        </div>

                                        {{-- Konten Ulasan --}}
                                        <div class="flex-1">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h5 class="font-bold text-gray-900 dark:text-white text-sm">{{ $review->user->name }}</h5>
                                                    
                                                    {{-- [PERBAIKAN] TAMPILAN BINTANG SESUAI RATING --}}
                                                    <div class="flex items-center gap-2 mt-1">
                                                        <div class="flex items-center gap-0.5">
                                                            @for($r=1; $r<=5; $r++)
                                                                @if($r <= $review->rating)
                                                                    {{-- Bintang Penuh (Kuning) --}}
                                                                    <span class="material-symbols-outlined text-[16px] text-amber-400 filled">star</span>
                                                                @else
                                                                    {{-- Bintang Kosong (Abu-abu) --}}
                                                                    <span class="material-symbols-outlined text-[16px] text-gray-300">star</span>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <span class="text-xs text-gray-400">• {{ $review->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>

                                                {{-- Tombol Hapus --}}
                                                @if(auth()->id() === $review->user_id)
                                                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Hapus ulasan ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-400 hover:text-red-600 p-1 transition-colors" title="Hapus Ulasan">
                                                            <span class="material-symbols-outlined text-lg">delete</span>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                            
                                            <p class="text-gray-600 dark:text-gray-300 text-sm mt-3 leading-relaxed">
                                                {{ $review->comment }}
                                            </p>
                                        </div>
                                    </div>
                                    <hr class="border-gray-100 dark:border-gray-700 last:hidden">
                                @empty
                                    <div class="text-center py-10">
                                        <div class="size-16 bg-gray-50 dark:bg-gray-700/50 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-300">
                                            <span class="material-symbols-outlined text-3xl">chat_bubble_outline</span>
                                        </div>
                                        <p class="text-gray-500">Belum ada ulasan. Jadilah yang pertama mereview!</p>
                                    </div>
                                @endforelse
                            </div>
                        </section>
                    </div>

                </div>

                {{-- RIGHT SIDEBAR (4 Kolom - Sticky) --}}
                <div class="lg:col-span-4 relative">
                    <div class="sticky top-28 space-y-6 z-10">
                        
                        {{-- 1. CARD INFO PRAKTIS --}}
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                            <h4 class="font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-100 dark:border-gray-700 flex items-center gap-2">
                                <span class="material-symbols-outlined text-blue-500">info</span> Info Praktis
                            </h4>

                            {{-- Jam Buka --}}
                            @php
                                $now = now()->setTimezone('Asia/Jakarta');
                                $currentTime = $now->format('H:i');
                                $isOpen = false;
                                if ($umkm->jam_buka && $umkm->jam_tutup) {
                                    $buka = \Carbon\Carbon::parse($umkm->jam_buka)->format('H:i');
                                    $tutup = \Carbon\Carbon::parse($umkm->jam_tutup)->format('H:i');
                                    if ($tutup < $buka) {
                                        $isOpen = $currentTime >= $buka || $currentTime <= $tutup;
                                    } else {
                                        $isOpen = $currentTime >= $buka && $currentTime <= $tutup;
                                    }
                                }
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

                        {{-- 2. CARD INPUT RATING --}}
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                            <h4 class="font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-100 dark:border-gray-700 flex items-center gap-2">
                                <span class="material-symbols-outlined text-amber-500">rate_review</span> Beri Ulasan
                            </h4>

                            @auth
                                <form action="{{ route('reviews.store', $umkm->id) }}" method="POST" x-data="{ rating: 0, hoverRating: 0 }">
                                    @csrf
                                    
                                    {{-- Input Bintang Interaktif --}}
                                    <div class="flex flex-col items-center mb-4">
                                        <p class="text-sm text-gray-500 mb-2">Bagaimana pengalaman Anda?</p>
                                        <div class="flex gap-1" @mouseleave="hoverRating = 0">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <button type="button" 
                                                        @click="rating = {{ $i }}" 
                                                        @mouseover="hoverRating = {{ $i }}"
                                                        class="focus:outline-none transition-transform hover:scale-110 duration-200">
                                                    <span class="material-symbols-outlined text-3xl"
                                                          :class="(hoverRating >= {{ $i }} || (!hoverRating && rating >= {{ $i }})) ? 'text-amber-400 filled' : 'text-gray-300'">
                                                        star
                                                    </span>
                                                </button>
                                            @endfor
                                        </div>
                                        <input type="hidden" name="rating" :value="rating" required>
                                        
                                        <div class="h-5 mt-1">
                                            <span x-show="rating == 1 || hoverRating == 1" class="text-xs font-bold text-red-500">Sangat Buruk</span>
                                            <span x-show="rating == 2 || hoverRating == 2" class="text-xs font-bold text-orange-500">Buruk</span>
                                            <span x-show="rating == 3 || hoverRating == 3" class="text-xs font-bold text-yellow-500">Cukup</span>
                                            <span x-show="rating == 4 || hoverRating == 4" class="text-xs font-bold text-lime-500">Bagus</span>
                                            <span x-show="rating == 5 || hoverRating == 5" class="text-xs font-bold text-green-600">Sangat Bagus!</span>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="comment" class="sr-only">Komentar</label>
                                        <textarea name="comment" id="comment" rows="3" 
                                                  class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700/50 text-sm focus:border-primary-orange focus:ring-primary-orange placeholder:text-gray-400"
                                                  placeholder="Tulis ulasan Anda di sini... (Opsional)"></textarea>
                                    </div>

                                    <button type="submit" 
                                            :disabled="rating === 0"
                                            :class="rating === 0 ? 'opacity-50 cursor-not-allowed bg-gray-400' : 'bg-primary-orange hover:bg-orange-600 shadow-lg shadow-orange-500/30'"
                                            class="w-full py-2.5 rounded-xl text-white font-bold text-sm transition-all flex items-center justify-center gap-2">
                                        <span class="material-symbols-outlined text-lg">send</span> Kirim Ulasan
                                    </button>
                                </form>
                            @else
                                <div class="text-center py-6">
                                    <div class="size-12 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-400">
                                        <span class="material-symbols-outlined text-2xl">lock</span>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                                        Silakan login untuk memberikan ulasan pada UMKM ini.
                                    </p>
                                    <a href="{{ route('login') }}" class="block w-full py-2.5 rounded-xl border border-primary-orange text-primary-orange font-bold text-sm hover:bg-orange-50 transition-colors">
                                        Login Sekarang
                                    </a>
                                </div>
                            @endauth
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
    
    {{-- PASTIKAN STYLE INI ADA AGAR CLASS 'filled' BERFUNGSI --}}
    <style>
        .material-symbols-outlined.filled {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
@endsection