@auth
<div x-data="{ open: false }" 
     x-show="open" 
     @open-favorites.window="open = true"
     @keydown.escape.window="open = false"
     class="fixed inset-0 z-[60] overflow-y-auto" 
     aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">

    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="open = false"></div>
    
    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="bg-white dark:bg-gray-800 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">UMKM Favorit Saya</h3>
                    <button @click="open = false" class="text-gray-400 hover:text-gray-500">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                
                <div class="max-h-[60vh] overflow-y-auto custom-scroll">
                    @if(auth()->user()->favorites && auth()->user()->favorites->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach(auth()->user()->favorites as $umkm)
                                <a href="{{ route('umkm.show', $umkm->slug) }}" class="flex gap-3 p-3 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-primary-orange transition-colors group">
                                    <div class="size-16 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                                        <img src="{{ $umkm->primaryPhoto ? asset($umkm->primaryPhoto->photo_url) : 'https://ui-avatars.com/api/?name='.urlencode($umkm->nama_usaha) }}" alt="{{ $umkm->nama_usaha }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-bold text-gray-900 dark:text-white truncate group-hover:text-primary-orange transition-colors">{{ $umkm->nama_usaha }}</h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $umkm->kategori }}</p>
                                        <div class="flex items-center gap-1 mt-1">
                                            <span class="material-symbols-outlined text-yellow-400 text-[14px] fill-current">star</span>
                                            <span class="text-xs font-bold text-gray-700 dark:text-gray-300">{{ $umkm->rating }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="size-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="material-symbols-outlined text-gray-400 text-3xl">favorite</span>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada UMKM yang difavoritkan.</p>
                            <p class="text-xs text-gray-400 mt-1">Jelajahi UMKM dan simpan yang kamu suka!</p>
                            <a href="{{ route('jelajah') }}" @click="open = false" class="inline-block mt-4 px-4 py-2 bg-primary-orange text-white text-sm font-bold rounded-lg hover:bg-orange-600 transition-colors">
                                Mulai Jelajah
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endauth