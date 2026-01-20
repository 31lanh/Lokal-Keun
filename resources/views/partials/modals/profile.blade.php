@auth
<div x-data="{ open: false }" 
     x-show="open" 
     @open-profile.window="open = true" 
     @keydown.escape.window="open = false"
     class="fixed inset-0 z-[60] overflow-y-auto" 
     aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
    
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="open = false"></div>
    
    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="bg-white dark:bg-gray-800 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="flex flex-col items-center">
                    <div class="size-24 bg-gradient-to-br from-primary-orange to-primary-green rounded-full flex items-center justify-center text-white font-bold text-4xl mb-4 shadow-lg">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ auth()->user()->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">{{ auth()->user()->email }}</p>
                    
                    <div class="w-full space-y-3">
                        <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-100 dark:border-gray-700">
                            <span class="material-symbols-outlined text-gray-500">phone</span>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Nomor Telepon</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ auth()->user()->phone ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-100 dark:border-gray-700">
                            <span class="material-symbols-outlined text-gray-500">location_on</span>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Alamat Utama</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white line-clamp-2">{{ auth()->user()->address ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700/30 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-2">
                <button type="button" @click="open = false; $dispatch('open-edit-profile')" class="inline-flex w-full justify-center rounded-xl bg-primary-orange px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-600 sm:w-auto transition-colors">
                    Edit Profil
                </button>
                <button type="button" @click="open = false" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white dark:bg-gray-800 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 sm:mt-0 sm:w-auto transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endauth