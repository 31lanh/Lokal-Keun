<div x-show="showConfirmModal" style="display: none;"
    class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

    <div class="bg-white dark:bg-gray-800 w-full max-w-md rounded-2xl shadow-2xl p-6 text-center transform transition-all"
        @click.away="showConfirmModal = false"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0">
        
        <div class="size-16 bg-gradient-to-br from-orange-100 to-orange-200 text-primary-orange rounded-full flex items-center justify-center mx-auto mb-4 shadow-inner">
            <span class="material-symbols-outlined text-3xl">storefront</span>
        </div>

        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
            Yakin Ingin Menjadi Mitra?
        </h3>
        <p class="text-gray-600 dark:text-gray-300 text-sm mb-6 leading-relaxed">
            Status akun Anda akan berubah menjadi <strong>Penjual</strong>. Anda akan diarahkan ke halaman pendaftaran untuk melengkapi data usaha.
        </p>

        <form action="{{ route('seller.switch') }}" method="POST" class="flex gap-3 justify-center">
            @csrf
            {{-- Tombol TIDAK --}}
            <button type="button" @click="showConfirmModal = false"
                class="flex-1 px-5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-bold hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                Batal
            </button>

            {{-- Tombol YA --}}
            <button type="submit"
                class="flex-1 px-5 py-2.5 rounded-xl bg-gradient-to-r from-primary-orange to-primary-green text-white font-bold hover:shadow-lg hover:scale-[1.02] transition-all flex items-center justify-center gap-2">
                <span>Ya, Lanjut</span>
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </button>
        </form>
    </div>
</div>