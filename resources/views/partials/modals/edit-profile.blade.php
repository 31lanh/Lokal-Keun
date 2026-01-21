@auth
<div x-data="{ open: false }" 
     x-show="open" 
     @open-edit-profile.window="open = true"
     @keydown.escape.window="open = false"
     class="fixed inset-0 z-[60] overflow-y-auto" 
     aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">

    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="open = false"></div>
    
    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            
            {{-- Form Start --}}
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Kita gunakan POST karena di route web.php didefinisikan POST --}}
                
                <div class="bg-white dark:bg-gray-800 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Edit Profil</h3>
                    
                    {{-- Tampilkan Error Validasi jika ada --}}
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-sm">• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="space-y-4">
                        {{-- Nama --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-orange focus:border-transparent">
                        </div>

                        {{-- Email (Readonly) --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                            <input type="email" value="{{ auth()->user()->email }}" class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-500 cursor-not-allowed" readonly>
                        </div>

                        {{-- Whatsapp --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nomor Telepon / WA</label>
                            <input type="tel" name="whatsapp" value="{{ old('whatsapp', auth()->user()->whatsapp) }}" placeholder="08xxxxxxxxxx" class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-orange focus:border-transparent">
                        </div>

                        {{-- Alamat --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat Lengkap</label>
                            <textarea name="address" rows="3" class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-orange focus:border-transparent">{{ old('address', auth()->user()->address) }}</textarea>
                        </div>

                        {{-- Map Link (URL) --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Link Google Maps</label>
                            <input type="url" name="map_link" value="{{ old('map_link', auth()->user()->map_link) }}" placeholder="https://www.google.com/maps/embed?pb=..." class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-orange focus:border-transparent">
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 dark:bg-gray-700/30 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-2">
                    <button type="submit" class="inline-flex w-full justify-center rounded-xl bg-primary-orange px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-600 sm:w-auto transition-colors">
                        Simpan Perubahan
                    </button>
                    <button type="button" @click="open = false; $dispatch('open-profile')" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white dark:bg-gray-800 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 sm:mt-0 sm:w-auto transition-colors">
                        Batal
                    </button>
                </div>
            </form>
            {{-- Form End --}}

        </div>
    </div>
</div>
@endauth