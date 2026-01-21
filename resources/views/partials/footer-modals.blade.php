<div x-show="isOpen" 
     style="display: none;"
     class="fixed inset-0 z-[100] flex items-center justify-center px-4 sm:px-6"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">

    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="isOpen = false"></div>

    {{-- Modal Card --}}
    <div class="relative w-full max-w-2xl bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden transform transition-all"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 translate-y-4">

        {{-- Header Modal --}}
        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-gray-700/50">
            {{-- Ambil konten pakai activeKey --}}
            <h3 class="text-xl font-bold text-gray-900 dark:text-white" x-text="modalContent[activeKey]?.title"></h3>
            <button @click="isOpen = false" class="text-gray-400 hover:text-red-500 transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        {{-- Body Modal --}}
        <div class="p-6 max-h-[70vh] overflow-y-auto prose dark:prose-invert max-w-none text-sm leading-relaxed text-gray-600 dark:text-gray-300">
            <div x-html="modalContent[activeKey]?.body"></div>
        </div>

        {{-- Footer Modal --}}
        <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700 flex justify-end">
            <button @click="isOpen = false" class="px-5 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-bold text-sm transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>