<header
    class="fixed top-0 z-50 w-full bg-white/80 dark:bg-surface-dark/80 backdrop-blur-lg border-b border-gray-100 dark:border-gray-800 shadow-sm" x-data="{ open: false, mobileOpen: false }">
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
                    $isHome = Request::is('/');
                    $menus = [
                        ['label' => 'Beranda', 'type' => 'anchor', 'target' => '#beranda'],
                        ['label' => 'Jelajah', 'type' => 'route', 'target' => 'jelajah'],
                        ['label' => 'Kategori', 'type' => 'anchor', 'target' => '#kategori'],
                        ['label' => 'Tentang', 'type' => 'anchor', 'target' => '#tentang'],
                        ['label' => 'Gabung Mitra', 'type' => 'anchor', 'target' => '#gabung-mitra'],
                    ];
                @endphp

                @foreach ($menus as $menu)
                    @php
                        if ($menu['type'] === 'route') {
                            $href = route($menu['target']);
                        } else {
                            $href = $isHome ? $menu['target'] : url('/' . $menu['target']);
                        }
                    @endphp
                    <a class="text-sm font-semibold text-gray-700 dark:text-gray-300 hover:text-primary-orange transition-colors relative group"
                        href="{{ $href }}">
                        {{ $menu['label'] }}
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-primary-orange to-primary-green group-hover:w-full transition-all duration-300"></span>
                    </a>
                @endforeach
            </div>

            <div class="hidden md:flex items-center gap-3">
                @auth
                    @if (auth()->user()->role === 'pembeli')
                        <div class="relative">
                            <button @click="open = !open" @click.away="open = false"
                                class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors border border-transparent hover:border-gray-200 dark:hover:border-gray-700">
                                <div
                                    class="size-9 bg-gradient-to-br from-primary-orange to-primary-green rounded-full flex items-center justify-center text-white font-bold text-sm">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <span class="font-semibold text-sm text-gray-700 dark:text-gray-300">
                                    {{ Str::limit(auth()->user()->name, 10) }}
                                </span>
                                <span class="material-symbols-outlined text-gray-500 text-xl transition-transform"
                                    :class="open ? 'rotate-180' : ''">expand_more</span>
                            </button>

                            <div x-show="open" 
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95" 
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100" 
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-64 bg-white dark:bg-surface-dark rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden"
                                style="display: none;">

                                <div class="p-4 bg-gradient-to-br from-orange-50 to-green-50 dark:from-orange-900/20 dark:to-green-900/20 border-b border-gray-200 dark:border-gray-700">
                                    <p class="font-bold text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 truncate">{{ auth()->user()->email }}</p>
                                    
                                    <div class="mt-2 inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide bg-green-100 text-green-700 border border-green-200 dark:bg-green-900/30 dark:text-green-300 dark:border-green-800">
                                        Member Account
                                    </div>
                                </div>

                                <div class="p-2">
                                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-orange-50 dark:hover:bg-orange-900/20 transition-all group/item">
                                        <span class="material-symbols-outlined text-primary-orange group-hover/item:scale-110 transition-transform">person</span>
                                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Profil Saya</span>
                                    </a>
                                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-green-50 dark:hover:bg-green-900/20 transition-all group/item">
                                        <span class="material-symbols-outlined text-primary-green group-hover/item:scale-110 transition-transform">receipt_long</span>
                                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Pesanan Saya</span>
                                    </a>
                                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-all group/item">
                                        <span class="material-symbols-outlined text-red-500 group-hover/item:scale-110 transition-transform">favorite</span>
                                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Favorit</span>
                                    </a>
                                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all group/item">
                                        <span class="material-symbols-outlined text-blue-500 group-hover/item:scale-110 transition-transform">location_on</span>
                                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Alamat</span>
                                    </a>
                                </div>

                                <div class="p-2 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/30 transition-all w-full text-left group/item">
                                            <span class="material-symbols-outlined text-red-500 group-hover/item:scale-110 group-hover/item:rotate-12 transition-all">logout</span>
                                            <span class="text-sm font-bold text-red-500">Keluar</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2.5 text-sm font-bold text-gray-700 dark:text-gray-300 hover:text-primary-orange transition-all rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-primary-orange to-primary-green hover:shadow-lg hover:shadow-orange-500/50 rounded-xl transition-all transform hover:scale-105">
                        Daftar Gratis
                    </a>
                @endauth
            </div>

            <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-colors">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>
</header>