<header
    class="fixed top-0 z-50 w-full bg-white/80 dark:bg-surface-dark/80 backdrop-blur-lg border-b border-gray-100 dark:border-gray-800 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            <a href="{{ url('/') }}" class="flex items-center gap-3 group cursor-pointer">
                <div class="relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-primary-orange to-primary-green rounded-xl blur-lg opacity-50 group-hover:opacity-75 transition-opacity">
                    </div>
                    <div
                        class="relative size-12 bg-gradient-to-br from-primary-orange to-primary-green rounded-xl flex items-center justify-center transform group-hover:scale-105 transition-transform">
                        <span class="material-symbols-outlined text-white text-3xl">store</span>
                    </div>
                </div>
                <div>
                    <h2 class="text-2xl font-bold gradient-text">Lokal-keun</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Belanja Lokal, Berkah Global</p>
                </div>
            </a>

            <div class="hidden md:flex items-center gap-8">
                @php
                    $menus = [
                        'Beranda' => '#beranda',
                        'Kategori' => '#kategori',
                        'Tentang' => '#tentang',
                        'Gabung Mitra' => '#gabung-mitra',
                    ];

                    // Cek apakah user sedang berada di halaman Home ('/')
                    $isHome = Request::is('/');
                @endphp

                @foreach($menus as $label => $anchor)
                    @php
                        // Logika Link:
                        // Jika di Home -> Pakai '#id' saja (biar JS smooth scroll jalan)
                        // Jika BUKAN di Home -> Pakai 'http://website.com/#id' (biar pindah page dulu)
                        $href = $isHome ? $anchor : url('/' . $anchor);
                    @endphp

                    <a class="text-sm font-semibold hover:text-primary-orange transition-colors relative group"
                        href="{{ $href }}">
                        {{ $label }}
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-primary-orange to-primary-green group-hover:w-full transition-all duration-300"></span>
                    </a>
                @endforeach
            </div>

            <div class="hidden md:flex font-bold items-center gap-3">
                <a href="{{ route('login') }}" class="px-5 py-2.5 ..."> Masuk
                </a>
                <button
                    class="px-5 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-primary-orange to-primary-green hover:shadow-lg hover:shadow-orange-500/50 rounded-xl transition-all transform hover:scale-105">
                    Daftar Gratis
                </button>
            </div>

            <button class="md:hidden p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-colors">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>
</header>