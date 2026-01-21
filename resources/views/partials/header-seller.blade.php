<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<nav class="fixed top-0 z-50 w-full bg-white/80 dark:bg-surface-dark/80 backdrop-blur-lg border-b border-gray-100 dark:border-gray-800 shadow-sm" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            
            {{-- LOGO SECTION (Diperbarui agar sama dengan Header) --}}
            <div class="flex-shrink-0 flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group cursor-pointer">
                    {{-- Icon Container (Style disamakan dengan header.blade.php) --}}
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-orange to-primary-green rounded-xl blur-lg opacity-50 group-hover:opacity-75 transition-opacity"></div>
                        <div class="relative size-12 bg-gradient-to-br from-primary-orange to-primary-green rounded-xl flex items-center justify-center transform group-hover:scale-105 transition-transform">
                            {{-- Icon diganti jadi 'store' agar konsisten --}}
                            <span class="material-symbols-outlined text-white text-3xl">store</span>
                        </div>
                    </div>
                    
                    {{-- Text Styling (Style disamakan dengan header.blade.php) --}}
                    <div>
                        <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-primary-orange to-primary-green">LokalKeun</h2>
                        {{-- Subtitle tetap 'Seller Area' tapi style disesuaikan agar konsisten secara visual --}}
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wider">Seller Area</p>
                    </div>
                </a>
            </div>

            {{-- USER PROFILE SECTION (Fungsionalitas Tetap) --}}
            <div class="flex items-center gap-4">
                <div class="relative">
                    <button @click="open = !open" @click.away="open = false" 
                        class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors border border-transparent hover:border-gray-200 dark:hover:border-gray-700">
                        
                        <div class="size-9 bg-gradient-to-br from-primary-orange to-primary-green rounded-full flex items-center justify-center text-white font-bold text-sm">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="hidden md:flex flex-col items-start text-left ml-1">
                            <span class="text-sm font-bold text-gray-700 dark:text-gray-300 leading-tight">
                                {{ Str::limit(auth()->user()->name, 12) }}
                            </span>
                            <span class="text-[10px] text-gray-500 font-medium">Calon Mitra</span>
                        </div>

                        <span class="material-symbols-outlined text-gray-500 text-xl transition-transform duration-300"
                            :class="open ? 'rotate-180' : ''">expand_more</span>
                    </button>

                    {{-- Dropdown --}}
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95" 
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100" 
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-64 bg-white dark:bg-surface-dark rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden z-50"
                         style="display: none;">
                        
                        <div class="p-4 bg-gradient-to-br from-orange-50 to-green-50 dark:from-orange-900/20 dark:to-green-900/20 border-b border-gray-200 dark:border-gray-700">
                            <p class="font-bold text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                            <div class="mt-2 inline-flex px-2 py-0.5 rounded-md bg-primary-orange/10 text-primary-orange text-[10px] font-bold uppercase tracking-wide border border-primary-orange/20">
                                Seller Account
                            </div>
                        </div>

                        <div class="p-2 bg-gray-50 dark:bg-gray-800/50">
                            <form method="POST" action="{{ route('logout') }}" id="logout-form-seller">
                                @csrf
                                <button type="button" onclick="confirmLogout('logout-form-seller')" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/30 transition-all w-full text-left group/item">
                                    <span class="material-symbols-outlined text-red-500 group-hover/item:scale-110 group-hover/item:rotate-12 transition-all">logout</span>
                                    <span class="text-sm font-bold text-red-500">Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    function confirmLogout(formId) {
        Swal.fire({
            title: 'Keluar dari Toko?',
            text: "Sesi Anda akan berakhir.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Keluar',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        })
    }
</script>