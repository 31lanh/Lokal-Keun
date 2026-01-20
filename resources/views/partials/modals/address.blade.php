@auth
<div x-data="{ open: false }" 
     x-show="open" 
     @open-address.window="open = true"
     @keydown.escape.window="open = false"
     class="fixed inset-0 z-[60] overflow-y-auto" 
     aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">

    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="open = false"></div>
    
    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="bg-white dark:bg-gray-800 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Lokasi Saya</h3>
                    <button @click="open = false" class="text-gray-400 hover:text-gray-500">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                
                <div class="space-y-4">
                    <div class="p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-100 dark:border-gray-700">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Alamat Terdaftar</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ auth()->user()->address ?? 'Belum ada alamat yang didaftarkan.' }}</p>
                    </div>

                    <div class="rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-900 relative aspect-video flex items-center justify-center group">
                        @if(auth()->user()->map_image)
                            <img src="{{ asset('storage/' . auth()->user()->map_image) }}" alt="Peta Lokasi" class="w-full h-full object-cover">
                        @if(auth()->user()->map_link)
                            <iframe src="{{ auth()->user()->map_link }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        @else
                            <div class="text-center p-6">
                                <span class="material-symbols-outlined text-gray-400 text-4xl mb-2">map</span>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Gambar peta belum diupload.</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Link peta belum diatur.</p>
                                <button @click="open = false; $dispatch('open-edit-profile')" class="mt-2 text-primary-orange text-xs font-bold hover:underline">
                                    Upload Sekarang
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700/30 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="button" @click="open = false" class="inline-flex w-full justify-center rounded-xl bg-white dark:bg-gray-800 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 sm:mt-0 sm:w-auto transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endauth