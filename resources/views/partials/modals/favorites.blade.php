@auth
<div x-data="{ open: false }" 
     x-show="open" 
     @open-favorites.window="open = true"
     @keydown.escape.window="open = false"
     class="fixed inset-0 z-[60] overflow-y-auto" 
     aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">

    {{-- Backdrop dengan Blur Effect --}}
    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" 
         x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" 
         x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" 
         @click="open = false"></div>
    
    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        {{-- Modal Container --}}
        <div class="relative transform overflow-hidden rounded-3xl bg-white dark:bg-gray-900 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-gray-100 dark:border-gray-800" 
             x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            
            {{-- Header --}}
            <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between bg-white/80 dark:bg-gray-900/80 backdrop-blur-md sticky top-0 z-20">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <span class="material-symbols-outlined text-red-500 filled animate-pulse-slow">favorite</span>
                        Favorit Saya
                    </h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Daftar UMKM yang Anda simpan</p>
                </div>
                <button @click="open = false" class="group rounded-full p-2 bg-gray-50 dark:bg-gray-800 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all duration-300">
                    <span class="material-symbols-outlined text-xl group-hover:rotate-90 transition-transform duration-300">close</span>
                </button>
            </div>
            
            {{-- Content Area --}}
            <div class="px-6 py-6 max-h-[65vh] overflow-y-auto custom-scroll bg-gray-50/50 dark:bg-gray-900/50">
                @if(auth()->user()->favorites && auth()->user()->favorites->count() > 0)
                    <div class="grid grid-cols-1 gap-4">
                        @foreach(auth()->user()->favorites as $umkm)
                            <div class="group relative flex flex-col sm:flex-row bg-white dark:bg-gray-800 p-3 rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-primary-orange/30 dark:hover:border-primary-orange/30 hover:shadow-lg hover:shadow-orange-500/5 transition-all duration-300">
                                
                                {{-- Image --}}
                                <div class="w-full sm:w-32 h-32 sm:h-auto flex-shrink-0 rounded-xl overflow-hidden bg-gray-100 relative">
                                    <img src="{{ $umkm->primaryPhoto ? asset($umkm->primaryPhoto->photo_url) : 'https://ui-avatars.com/api/?background=random&name='.urlencode($umkm->nama_usaha) }}" 
                                         alt="{{ $umkm->nama_usaha }}" 
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    <div class="absolute top-2 right-2 sm:hidden">
                                         <span class="inline-flex items-center rounded-lg bg-white/90 backdrop-blur-sm px-2 py-1 text-xs font-bold text-primary-orange shadow-sm">
                                            {{ ucfirst($umkm->kategori) }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Details --}}
                                <div class="flex-1 mt-3 sm:mt-0 sm:ml-4 flex flex-col justify-between min-w-0">
                                    <div>
                                        <div class="flex justify-between items-start">
                                            <div class="hidden sm:block mb-1">
                                                <span class="inline-flex items-center rounded-md bg-orange-50 dark:bg-orange-900/20 px-2 py-1 text-[10px] font-bold uppercase tracking-wider text-primary-orange border border-orange-100 dark:border-orange-900/30">
                                                    {{ $umkm->kategori }}
                                                </span>
                                            </div>
                                            {{-- Rating Badge --}}
                                            <div class="flex items-center gap-1 bg-amber-50 dark:bg-amber-900/20 px-2 py-1 rounded-lg border border-amber-100 dark:border-amber-800/30">
                                                <span class="material-symbols-outlined text-amber-500 text-[16px] filled">star</span>
                                                <span class="text-xs font-bold text-gray-700 dark:text-gray-300">{{ $umkm->rating }}</span>
                                            </div>
                                        </div>

                                        <h4 class="text-lg font-bold text-gray-900 dark:text-white truncate group-hover:text-primary-orange transition-colors mt-1">
                                            {{ $umkm->nama_usaha }}
                                        </h4>
                                        
                                        <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-1 mt-1 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px] text-gray-400">location_on</span>
                                            {{ $umkm->alamat }}
                                        </p>
                                    </div>

                                    <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-50 dark:border-gray-700/50">
                                        <span class="text-xs text-gray-400 font-medium">
                                            Ditambahkan {{ $umkm->pivot->created_at->diffForHumans() }}
                                        </span>
                                        <a href="{{ route('umkm.show', $umkm->slug) }}" class="inline-flex items-center gap-1 text-sm font-bold text-primary-orange hover:text-orange-600 transition-colors">
                                            Lihat Detail
                                            <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    {{-- Empty State --}}
                    <div class="flex flex-col items-center justify-center py-16 text-center">
                        <div class="relative mb-6">
                            <div class="absolute inset-0 bg-red-100 dark:bg-red-900/20 rounded-full blur-2xl opacity-60 animate-pulse"></div>
                            <div class="relative size-28 bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-full flex items-center justify-center shadow-xl border border-gray-100 dark:border-gray-700">
                                <span class="material-symbols-outlined text-gray-300 dark:text-gray-600 text-6xl">favorite</span>
                                <div class="absolute -bottom-2 -right-2 bg-white dark:bg-gray-800 rounded-full p-2 shadow-lg border border-gray-100 dark:border-gray-700">
                                    <span class="material-symbols-outlined text-gray-400 text-xl">add</span>
                                </div>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Belum ada Favorit</h3>
                        <p class="text-gray-500 dark:text-gray-400 max-w-xs mx-auto leading-relaxed">
                            Simpan UMKM yang Anda sukai agar mudah ditemukan kembali nanti.
                        </p>
                        <a href="{{ route('jelajah') }}" @click="open = false" class="mt-8 px-8 py-3 bg-gradient-to-r from-primary-orange to-primary-green text-white font-bold rounded-xl shadow-lg shadow-orange-500/20 hover:shadow-orange-500/40 hover:scale-105 transition-all duration-300 flex items-center gap-2">
                            <span class="material-symbols-outlined">explore</span>
                            Mulai Jelajah
                        </a>
                    </div>
                @endif
            </div>
            
            {{-- Footer --}}
            @if(auth()->user()->favorites && auth()->user()->favorites->count() > 0)
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-800 flex justify-between items-center">
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">
                        {{ auth()->user()->favorites->count() }} UMKM Disimpan
                    </span>
                    <button type="button" @click="open = false" class="inline-flex w-full justify-center rounded-xl bg-white dark:bg-gray-800 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 sm:mt-0 sm:w-auto transition-colors">
                        Tutup
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
@endauth