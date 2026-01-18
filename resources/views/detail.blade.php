@extends('layouts.app')

@section('content')
    <div class="min-h-screen pt-20 pb-10 bg-gray-50 dark:bg-gray-900">

        <main class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- BREADCRUMB --}}
            <nav class="mb-6">
                <ol
                    class="flex flex-wrap items-center gap-2 text-xs md:text-sm font-medium text-gray-600 dark:text-gray-400">
                    <li><a href="/" class="hover:text-orange-500 transition-colors">Beranda</a></li>
                    <li><span class="material-symbols-outlined text-xs">chevron_right</span></li>
                    <li><a href="#" class="hover:text-orange-500 transition-colors">Kuliner</a></li>
                    <li><span class="material-symbols-outlined text-xs">chevron_right</span></li>
                    <li class="text-gray-900 dark:text-white font-semibold">{{ $umkm->nama_usaha }}</li>
                </ol>
            </nav>

            {{-- LOGIKA GAMBAR --}}
            @php
                // Banner Logic
                $banner = $umkm->photos->where('is_primary', true)->first();
                $bannerUrl = 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1200&h=400&fit=crop';

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
                    } elseif ($banner->photo_path) {
                        $bannerUrl = asset('storage/' . $banner->photo_path);
                    }
                }

                // Logo Logic
                $logoUrl =
                    'https://ui-avatars.com/api/?name=' .
                    urlencode($umkm->nama_usaha) .
                    '&background=FF6B35&color=fff&size=256';
                if ($umkm->user && $umkm->user->profile_photo_path) {
                    if (str_starts_with($umkm->user->profile_photo_path, 'storage/')) {
                        $logoUrl = asset($umkm->user->profile_photo_path);
                    } else {
                        $logoUrl = asset('storage/' . $umkm->user->profile_photo_path);
                    }
                }
            @endphp

            {{-- HEADER SECTION --}}
            <div
                class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg border border-gray-200 dark:border-gray-700 mb-8">

                {{-- Banner Image --}}
                <div class="relative h-48 md:h-60 w-full overflow-hidden">
                    <img src="{{ $bannerUrl }}" alt="{{ $umkm->nama_usaha }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                    {{-- Floating Stats --}}
                    <div class="absolute top-4 right-4 flex gap-2">
                        @if ($umkm->maps_link)
                            <a href="{{ $umkm->maps_link }}" target="_blank"
                                class="px-3 py-1.5 rounded-full bg-white/90 backdrop-blur-sm text-xs font-bold text-gray-800 flex items-center gap-1 hover:bg-white transition-all">
                                <span class="material-symbols-outlined text-sm text-yellow-500 filled">star</span>
                                Rating Gmaps
                            </a>
                        @endif
                        <div
                            class="px-3 py-1.5 rounded-full bg-white/90 backdrop-blur-sm text-xs font-bold text-gray-800 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">visibility</span>
                            2.5K
                        </div>
                    </div>
                </div>

                {{-- Profile Information --}}
                <div class="relative px-6 pb-6">
                    <div class="flex flex-col md:flex-row gap-5 -mt-14 items-start md:items-end">

                        {{-- Logo / Avatar --}}
                        <div class="relative shrink-0">
                            <div
                                class="h-24 w-24 md:h-28 md:w-28 rounded-xl border-4 border-white dark:border-gray-800 bg-white shadow-lg overflow-hidden">
                                <img src="{{ $logoUrl }}" alt="Logo" class="w-full h-full object-cover">
                            </div>
                        </div>

                        {{-- Store Info --}}
                        <div class="flex-1 pb-1 w-full">
                            <div class="flex flex-col md:flex-row md:justify-between md:items-end gap-4">
                                <div>
                                    <h1
                                        class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2 flex items-center gap-2">
                                        {{ $umkm->nama_usaha }}
                                        <span class="material-symbols-outlined text-blue-500 text-lg filled"
                                            title="Terverifikasi">verified</span>
                                    </h1>
                                    <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600 dark:text-gray-300">
                                        <span
                                            class="flex items-center gap-1.5 px-3 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-600 rounded-full font-medium">
                                            <span class="material-symbols-outlined text-base">restaurant</span>
                                            {{ $umkm->kategori }}
                                        </span>
                                        <span class="flex items-center gap-1.5">
                                            <span
                                                class="material-symbols-outlined text-base text-orange-500">location_on</span>
                                            {{ Str::limit($umkm->alamat, 40) }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Action Buttons --}}
                                <div class="flex gap-2 w-full md:w-auto">
                                    <a href="{{ $umkm->whatsapp_link }}" target="_blank"
                                        class="flex-1 md:flex-none h-10 px-5 rounded-lg bg-orange-500 hover:bg-orange-600 text-white text-sm font-bold hover:shadow-lg transition-all flex items-center justify-center gap-2">
                                        <span class="material-symbols-outlined text-lg">call</span>
                                        Hubungi
                                    </a>
                                    <button onclick="shareUMKM()"
                                        class="h-10 w-10 rounded-lg border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-orange-500 transition-all flex items-center justify-center">
                                        <span class="material-symbols-outlined text-lg">share</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TABS --}}
                <div class="px-6 border-t border-gray-200 dark:border-gray-700 overflow-x-auto">
                    <div class="flex gap-6 min-w-max">
                        <a href="#about"
                            class="tab-link relative text-orange-600 py-4 text-sm font-bold flex items-center gap-2 transition-colors">
                            <span class="material-symbols-outlined text-lg">info</span> Tentang
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-orange-500"></span>
                        </a>
                        <a href="#products"
                            class="tab-link relative text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 py-4 text-sm font-bold flex items-center gap-2 transition-colors">
                            <span class="material-symbols-outlined text-lg">restaurant_menu</span> Menu
                        </a>
                        <a href="#gallery"
                            class="tab-link relative text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 py-4 text-sm font-bold flex items-center gap-2 transition-colors">
                            <span class="material-symbols-outlined text-lg">photo_library</span> Galeri
                        </a>
                        <a href="#reviews"
                            class="tab-link relative text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 py-4 text-sm font-bold flex items-center gap-2 transition-colors">
                            <span class="material-symbols-outlined text-lg">reviews</span> Ulasan
                        </a>
                    </div>
                </div>
            </div>

            {{-- MAIN CONTENT GRID --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- LEFT COLUMN --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- 1. ABOUT SECTION --}}
                    <section id="about"
                        class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-orange-100 rounded-lg">
                                <span class="material-symbols-outlined text-orange-600 text-xl">info</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Tentang Kami</h3>
                        </div>

                        <div class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed space-y-3">
                            <p>{{ $umkm->deskripsi }}</p>
                            @if ($umkm->tahun_berdiri)
                                <p class="text-gray-500">Didirikan sejak tahun {{ $umkm->tahun_berdiri }}.</p>
                            @endif
                        </div>

                        <div class="mt-5 flex flex-wrap gap-2">
                            <div
                                class="flex items-center gap-2 px-3 py-2 bg-orange-50 text-orange-600 rounded-lg text-xs font-medium border border-orange-200">
                                <span class="material-symbols-outlined text-base filled">verified</span>
                                Terverifikasi
                            </div>
                        </div>
                    </section>

                    {{-- 2. MENU SECTION --}}
                    <section id="products">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Menu & Produk</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Pilihan terbaik dari kami</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @forelse($umkm->menus as $menu)
                                <div
                                    class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all border border-gray-100 dark:border-gray-700 group">
                                    <div class="relative aspect-[4/3] overflow-hidden">
                                        @if ($menu->photo_path)
                                            <img src="{{ asset(ltrim($menu->photo_path, '/')) }}"
                                                alt="{{ $menu->name }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                                <span class="material-symbols-outlined text-4xl">fastfood</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-4">
                                        <h4 class="font-bold text-gray-900 dark:text-white mb-1 line-clamp-1">
                                            {{ $menu->name }}</h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3 line-clamp-2">
                                            {{ $menu->description ?? 'Tidak ada deskripsi' }}
                                        </p>
                                        <div class="flex items-center justify-between">
                                            <span class="text-orange-600 font-bold">Rp
                                                {{ number_format($menu->price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full py-10 text-center bg-gray-50 rounded-xl">
                                    <span class="material-symbols-outlined text-4xl text-gray-300">restaurant_menu</span>
                                    <p class="text-gray-500 mt-2">Belum ada menu yang ditambahkan.</p>
                                </div>
                            @endforelse
                        </div>
                    </section>

                    {{-- 3. GALLERY SECTION --}}
                    <section id="gallery">
                        <div class="mb-4">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Galeri Foto</h3>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            @forelse($umkm->photos as $index => $photo)
                                <div
                                    class="{{ $index == 0 ? 'md:col-span-2 md:row-span-2' : '' }} rounded-xl overflow-hidden relative group cursor-pointer shadow-sm hover:shadow-md transition-all aspect-square">
                                    <img src="{{ $photo->photo_url ? asset(ltrim($photo->photo_url, '/')) : asset('storage/' . $photo->photo_path) }}"
                                        alt="Gallery"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    <div
                                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <span class="material-symbols-outlined text-white text-3xl">zoom_in</span>
                                    </div>
                                </div>
                            @empty
                                <div
                                    class="col-span-full py-10 text-center bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                                    <span class="material-symbols-outlined text-3xl text-gray-300">image</span>
                                    <p class="text-gray-500 mt-2">Belum ada foto galeri.</p>
                                </div>
                            @endforelse
                        </div>
                    </section>

                    {{-- 4. REVIEWS SECTION --}}
                    <section id="reviews">
                        <div class="mb-4">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Ulasan & Rating</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Berdasarkan data Google Maps</p>
                        </div>

                        <div
                            class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/aa/Google_Maps_icon_%282020%29.svg/1200px-Google_Maps_icon_%282020%29.svg.png"
                                alt="Google Maps" class="w-16 h-16 mx-auto mb-4">

                            <h4 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                                {{ $umkm->rating ?? '0.0' }} / 5.0
                            </h4>

                            <div class="flex justify-center text-amber-400 mb-4 gap-1">
                                @php $rating = $umkm->rating ?? 0; @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $rating)
                                        <span class="material-symbols-outlined filled text-2xl">star</span>
                                    @elseif($i - 0.5 <= $rating)
                                        <span class="material-symbols-outlined filled text-2xl">star_half</span>
                                    @else
                                        <span class="material-symbols-outlined text-gray-300 text-2xl">star</span>
                                    @endif
                                @endfor
                            </div>

                            <p class="text-gray-600 dark:text-gray-300 mb-6 max-w-md mx-auto text-sm">
                                Untuk melihat ulasan terbaru dan rating asli secara real-time, silakan kunjungi halaman
                                Google Maps kami.
                            </p>

                            @if ($umkm->maps_link)
                                <a href="{{ $umkm->maps_link }}" target="_blank"
                                    class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 hover:shadow-lg transition-all">
                                    <span class="material-symbols-outlined text-lg">open_in_new</span>
                                    Lihat Ulasan di Google Maps
                                </a>
                            @else
                                <button disabled
                                    class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-gray-300 text-gray-500 font-bold cursor-not-allowed">
                                    Link Maps Belum Tersedia
                                </button>
                            @endif
                        </div>
                    </section>
                </div>

                {{-- RIGHT COLUMN (SIDEBAR) --}}
                <div class="lg:col-span-1 space-y-6">
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 sticky top-24 space-y-6">

                        {{-- MAPS --}}
                        <div>
                            <h4 class="font-bold text-base text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-red-500">map</span> Lokasi
                            </h4>

                            <div
                                class="aspect-video w-full rounded-lg bg-gray-100 overflow-hidden relative mb-3 shadow-sm border border-gray-200">
                                <iframe width="100%" height="100%" frameborder="0" scrolling="no"
                                    src="https://maps.google.com/maps?q={{ urlencode($umkm->nama_usaha . ' ' . $umkm->alamat) }}&t=&z=15&ie=UTF8&iwloc=&output=embed">
                                </iframe>

                                @if ($umkm->maps_link)
                                    <a href="{{ $umkm->maps_link }}" target="_blank"
                                        class="absolute bottom-2 right-2 z-10">
                                        <div
                                            class="bg-white px-3 py-1.5 rounded-full text-xs font-bold text-orange-600 shadow-md flex items-center gap-1 hover:scale-105 transition-transform">
                                            <span class="material-symbols-outlined text-xs">open_in_new</span>
                                            Buka App
                                        </div>
                                    </a>
                                @endif
                            </div>

                            <p class="text-sm text-gray-600 dark:text-gray-300 flex items-start gap-2">
                                <span
                                    class="material-symbols-outlined text-orange-500 text-base mt-0.5 shrink-0">place</span>
                                <span>{{ $umkm->alamat }}</span>
                            </p>
                        </div>

                        {{-- JAM BUKA --}}
                        <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                            <h4 class="font-bold text-base text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-blue-500">schedule</span> Jam Buka
                            </h4>

                            @php
                                $now = now()->format('H:i');
                                $isOpen =
                                    $umkm->jam_buka &&
                                    $umkm->jam_tutup &&
                                    $now >= $umkm->jam_buka &&
                                    $now <= $umkm->jam_tutup;
                            @endphp

                            @if ($isOpen)
                                <div
                                    class="flex items-center gap-2 mb-3 px-3 py-2 bg-green-50 rounded-lg border border-green-200">
                                    <span class="relative flex h-2.5 w-2.5">
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                                    </span>
                                    <span class="text-sm font-bold text-green-600">Buka Sekarang</span>
                                </div>
                            @else
                                <div
                                    class="flex items-center gap-2 mb-3 px-3 py-2 bg-red-50 rounded-lg border border-red-200">
                                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                                    <span class="text-sm font-bold text-red-600">Tutup</span>
                                </div>
                            @endif

                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-600">Jam Operasional</span>
                                <span class="font-bold text-gray-900">
                                    {{ \Carbon\Carbon::parse($umkm->jam_buka)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($umkm->jam_tutup)->format('H:i') }}
                                </span>
                            </div>
                        </div>

                        {{-- KONTAK --}}
                        <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                            <h4 class="font-bold text-base text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-purple-500">contact_support</span> Kontak
                            </h4>
                            <div class="space-y-3">
                                <a href="tel:{{ $umkm->telepon }}"
                                    class="flex items-center gap-3 p-3 rounded-lg border-2 border-gray-200 hover:border-orange-500 transition-all">
                                    <div
                                        class="w-10 h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center">
                                        <span class="material-symbols-outlined">call</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500">Telepon</span>
                                        <span class="text-sm font-bold text-gray-900">{{ $umkm->telepon }}</span>
                                    </div>
                                </a>
                                @if ($umkm->email)
                                    <a href="mailto:{{ $umkm->email }}"
                                        class="flex items-center gap-3 p-3 rounded-lg border-2 border-gray-200 hover:border-blue-500 transition-all">
                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                                            <span class="material-symbols-outlined">mail</span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-xs text-gray-500">Email</span>
                                            <span
                                                class="text-sm font-bold text-gray-900">{{ Str::limit($umkm->email, 20) }}</span>
                                        </div>
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>

    {{-- SCRIPTS --}}
    <script>
        function shareUMKM() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $umkm->nama_usaha }}',
                    text: 'Lihat profil UMKM ini di LokalKeun!',
                    url: window.location.href
                });
            } else {
                navigator.clipboard.writeText(window.location.href);
                alert('Link berhasil disalin!');
            }
        }

        // Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Tab Active State
        const tabs = document.querySelectorAll('.tab-link');
        const sections = document.querySelectorAll('section[id]');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });

            tabs.forEach(tab => {
                tab.classList.remove('text-orange-600');
                tab.classList.add('text-gray-500');
                const underline = tab.querySelector('span:last-child');
                if (underline) underline.classList.add('hidden');

                if (tab.getAttribute('href') === `#${current}`) {
                    tab.classList.add('text-orange-600');
                    tab.classList.remove('text-gray-500');
                    if (underline) underline.classList.remove('hidden');
                }
            });
        });
    </script>
@endsection
