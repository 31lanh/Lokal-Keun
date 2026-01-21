@extends('layouts.app')

@section('content')

{{-- CSS Tambahan dari kode asli agar tampilan 100% sama --}}
<style>
    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #FF6B35, #4CAF50); border-radius: 20px; }

    /* Gradient Text & Border */
    .gradient-text {
        background: linear-gradient(135deg, #FF6B35 0%, #4CAF50 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .gradient-border {
        border: 2px solid transparent;
        background: linear-gradient(white, white) padding-box, linear-gradient(135deg, #FF6B35, #4CAF50) border-box;
    }

    /* Card Hover Effect */
    .card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(255, 107, 53, 0.2);
    }
</style>

<form action="{{ route('kategori.detail', ['slug' => $category]) }}" method="GET" x-data="{ showFilters: false }">

<section class="relative pt-32 pb-12 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <div class="absolute top-20 right-10 w-72 h-72 bg-primary-orange/20 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-20 left-10 w-96 h-96 bg-primary-green/20 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-6 mb-12 animate-slide-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-orange-light dark:bg-orange-900/30 rounded-full">
                <span class="w-2 h-2 bg-primary-orange rounded-full animate-pulse"></span>
                <span class="text-sm font-semibold text-primary-orange">{{ $umkms->total() }} UMKM Tersedia</span>
            </div>

            <h1 class="text-5xl md:text-6xl font-extrabold leading-tight">
                Kategori <span class="gradient-text">{{ ucfirst($category) }}</span>
            </h1>

            <p class="text-xl text-gray-600 dark:text-gray-300 leading-relaxed max-w-2xl mx-auto">
                Temukan produk dan jasa lokal terbaik kategori {{ strtolower($category) }} di sekitarmu
            </p>

            <div class="bg-white dark:bg-surface-dark p-2 rounded-2xl shadow-2xl shadow-orange-500/10 max-w-3xl mx-auto">
                <div class="flex flex-col md:flex-row gap-2">
                    <div class="flex-1 flex items-center px-4 py-3 bg-gray-50 dark:bg-gray-800 rounded-xl group">
                        <span class="material-symbols-outlined text-primary-orange mr-3 group-hover:scale-110 transition-transform">search</span>
                        <input name="q" value="{{ request('q') }}" class="bg-transparent border-none w-full text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-0 p-0" placeholder="Cari di kategori {{ strtolower($category) }}..." type="text" />
                        @if(request('q'))
                            <a href="{{ route('kategori.detail', ['slug' => $category]) }}" class="ml-2 text-gray-400 hover:text-red-500 transition-colors" title="Hapus pencarian">
                                <span class="material-symbols-outlined">close</span>
                            </a>
                        @endif
                    </div>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-primary-orange to-primary-green hover:shadow-lg hover:shadow-orange-500/50 text-white font-bold rounded-xl transition-all transform hover:scale-105 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">search</span>
                        <span>Cari</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    <div class="flex flex-col lg:flex-row gap-8">
        <aside class="w-full lg:w-72 flex-shrink-0">
            <div class="lg:hidden mb-4">
                <button type="button" @click="showFilters = !showFilters" class="flex items-center justify-center w-full px-6 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm font-bold text-gray-700 dark:text-gray-200 bg-white dark:bg-surface-dark hover:border-primary-orange transition-all">
                    <span class="material-symbols-outlined mr-2">tune</span>
                    Filter & Urutkan
                </button>
            </div>

            <div class="hidden lg:block space-y-6" :class="showFilters ? 'block' : 'hidden lg:block'">
                
                <div class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-800">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-green">location_on</span>
                        <span>Lokasi</span>
                    </h3>
                    <div class="relative">
                        <span
                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-primary-green">
                            <span class="material-symbols-outlined text-[20px]">pin_drop</span>
                        </span>
                        <select name="location" onchange="this.form.submit()"
                            class="block w-full pl-10 pr-4 py-3 text-base border-gray-200 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-green focus:border-transparent rounded-xl dark:bg-gray-800 dark:text-white font-medium">
                            <option {{ request('location') == 'Semua Lokasi' ? 'selected' : '' }}>Semua Lokasi</option>
                            @foreach (['Aceh', 'Sumatera Utara', 'Sumatera Barat', 'Riau', 'Jambi', 'Sumatera Selatan', 'Bengkulu', 'Lampung', 'Kep. Bangka Belitung', 'Kep. Riau', 'DKI Jakarta', 'Jawa Barat', 'Jawa Tengah', 'DI Yogyakarta', 'Jawa Timur', 'Banten', 'Bali', 'Nusa Tenggara Barat', 'Nusa Tenggara Timur', 'Kalimantan Barat', 'Kalimantan Tengah', 'Kalimantan Selatan', 'Kalimantan Timur', 'Kalimantan Utara', 'Sulawesi Utara', 'Sulawesi Tengah', 'Sulawesi Selatan', 'Sulawesi Tenggara', 'Gorontalo', 'Sulawesi Barat', 'Maluku', 'Maluku Utara', 'Papua', 'Papua Barat', 'Papua Selatan', 'Papua Tengah', 'Papua Pegunungan', 'Papua Barat Daya'] as $provinsi)
                                <option value="{{ $provinsi }}" {{ request('location') == $provinsi ? 'selected' : '' }}>{{ $provinsi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-800">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-amber-500 filled">star</span>
                        <span>Rating</span>
                    </h3>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 cursor-pointer group p-2 rounded-lg hover:bg-amber-50 dark:hover:bg-amber-900/20 transition-all">
                            <input name="rating" value="" type="radio" onchange="this.form.submit()" {{ !request('rating') ? 'checked' : '' }} class="h-5 w-5 border-gray-300 text-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-800" />
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">Semua Rating</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group p-2 rounded-lg hover:bg-amber-50 dark:hover:bg-amber-900/20 transition-all">
                            <input name="rating" value="lt_4" type="radio" onchange="this.form.submit()" {{ request('rating') == 'lt_4' ? 'checked' : '' }} class="h-5 w-5 border-gray-300 text-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-800" />
                            <div class="flex items-center text-amber-400">
                                @for ($i = 0; $i < 3; $i++)
                                    <span class="material-symbols-outlined fill-current text-[18px]">star</span>
                                @endfor
                                <span class="material-symbols-outlined text-[18px] text-gray-300">star</span>
                                <span class="material-symbols-outlined text-[18px] text-gray-300">star</span>
                                <span class="text-sm text-gray-700 dark:text-gray-300 ml-2 font-medium">Rating 1-3</span>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group p-2 rounded-lg hover:bg-amber-50 dark:hover:bg-amber-900/20 transition-all">
                            <input name="rating" value="4" type="radio" onchange="this.form.submit()" {{ request('rating') == '4' ? 'checked' : '' }} class="h-5 w-5 border-gray-300 text-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-800" />
                            <div class="flex items-center text-amber-400">
                                @for ($i = 0; $i < 4; $i++)
                                    <span class="material-symbols-outlined fill-current text-[18px]">star</span>
                                @endfor
                                <span class="material-symbols-outlined text-[18px] text-gray-300">star</span>
                                <span class="text-sm text-gray-700 dark:text-gray-300 ml-2 font-medium">Rating 4+</span>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex-1">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 bg-white dark:bg-surface-dark p-6 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800">
                <div class="flex items-center gap-2">
                    <p class="text-gray-600 dark:text-gray-300 text-base">
                        Menampilkan <span class="font-bold text-primary-orange text-lg">{{ $umkms->count() }}</span> dari
                        <span class="font-bold text-primary-green text-lg">{{ $umkms->total() }}</span> hasil
                    </p>
                </div>
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <label class="text-sm text-gray-500 font-semibold whitespace-nowrap flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">sort</span>
                        Urutkan:
                    </label>
                    <div class="relative w-full sm:w-56">
                        <select name="sort" onchange="this.form.submit()" class="block w-full px-4 py-3 text-sm border-gray-200 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-orange focus:border-transparent rounded-xl bg-gray-50 dark:bg-gray-800 dark:text-white font-medium cursor-pointer">
                            <option {{ request('sort') == 'Paling Relevan' ? 'selected' : '' }}>Paling Relevan</option>
                            <option {{ request('sort') == 'Terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option {{ request('sort') == 'Terlama' ? 'selected' : '' }}>Terlama</option>
                            <option {{ request('sort') == 'Rating Tertinggi' ? 'selected' : '' }}>Rating Tertinggi</option>
                            <option {{ request('sort') == 'Rating Terendah' ? 'selected' : '' }}>Rating Terendah</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                @forelse($umkms as $umkm)
                @php
                    $photo = $umkm->photos->where('is_primary', true)->first() ?? $umkm->photos->first();
                    $photoUrl = $photo ? $photo->photo_url : 'https://via.placeholder.com/400x300?text=No+Image';
                    $minPrice = $umkm->menus->min('price');
                    
                    $isOpen = false;
                    if ($umkm->jam_buka && $umkm->jam_tutup) {
                        $now = now()->format('H:i');
                        $isOpen = $now >= $umkm->jam_buka && $now <= $umkm->jam_tutup;
                    }
                    $isFavorited = auth()->check() && in_array($umkm->id, $favoritedUmkmIds ?? []);
                @endphp
                <div class="group bg-white dark:bg-surface-dark rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 dark:border-gray-800">
                    <div class="relative h-56 overflow-hidden">
                        <div class="absolute top-4 right-4 z-10">
                            <button onclick="toggleFavorite(this, {{ $umkm->id }})" class="p-2.5 rounded-full bg-white/90 backdrop-blur-sm transition-all shadow-lg transform hover:scale-110 {{ $isFavorited ? 'text-red-500' : 'text-gray-400 hover:text-red-500' }}">
                                <span class="material-symbols-outlined text-[22px] {{ $isFavorited ? 'filled' : '' }}">favorite</span>
                            </button>
                        </div>
                        <div class="absolute top-4 left-4 z-10">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold {{ $isOpen ? 'bg-gradient-to-r from-green-400 to-green-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200' }} shadow-lg">
                                @if($isOpen) <span class="w-1.5 h-1.5 bg-white rounded-full mr-2 animate-pulse"></span> @endif
                                {{ $isOpen ? 'Buka' : 'Tutup' }}
                            </span>
                        </div>
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="{{ $photoUrl }}" alt="{{ $umkm->nama_usaha }}" />
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-xs font-bold tracking-wide uppercase text-primary-orange bg-orange-light dark:bg-orange-900/30 px-3 py-1.5 rounded-lg">{{ ucfirst($umkm->kategori) }}</span>
                            
                            {{-- [PERBAIKAN] Menampilkan Rating Dinamis --}}
                            <div class="flex items-center gap-1 bg-amber-50 dark:bg-amber-900/20 px-2.5 py-1.5 rounded-lg">
                                <span class="material-symbols-outlined text-[16px] text-amber-500 filled">star</span>
                                <span class="text-sm font-bold text-amber-600 dark:text-amber-400">
                                    {{ $umkm->rating > 0 ? number_format($umkm->rating, 1) : '-' }}
                                </span>
                                <span class="text-xs text-gray-400">
                                    ({{ $umkm->total_reviews ?? 0 }})
                                </span>
                            </div>

                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-primary-orange transition-colors cursor-pointer line-clamp-1">
                            {{ $umkm->nama_usaha }}
                        </h3>
                        <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm mb-4">
                            <span class="material-symbols-outlined text-[18px] mr-1 text-primary-green">location_on</span>
                            <span class="line-clamp-1">{{ Str::limit($umkm->alamat, 30) }}</span>
                        </div>
                        <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400 font-semibold">Mulai dari <span class="text-primary-orange font-bold">{{ $minPrice ? 'Rp ' . number_format($minPrice, 0, ',', '.') : '-' }}</span></span>
                            <a class="text-sm font-bold text-primary-orange hover:text-orange-dark flex items-center gap-1 group/link"  href="{{ route('umkm.show', $umkm->slug) }}">
                                Lihat Detail
                                <span class="material-symbols-outlined text-[18px] group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 mb-4">
                        <span class="material-symbols-outlined text-3xl text-gray-400">search_off</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Tidak ada UMKM ditemukan</h3>
                    <p class="text-gray-500 dark:text-gray-400">Belum ada UMKM di kategori ini.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-16 flex justify-center">
                {{ $umkms->links() }}
            </div>

        </div>
    </div>
</main>

</form>

{{-- Script AJAX untuk Favorite --}}
<script>
    function toggleFavorite(btn, umkmId) {
        @auth
            // Animasi klik sederhana
            btn.style.transform = "scale(0.8)";
            setTimeout(() => btn.style.transform = "scale(1.1)", 150);

            fetch("{{ url('/favorite') }}/" + umkmId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (response.status === 401) {
                    window.location.href = "{{ route('login') }}";
                    return;
                }
                return response.json();
            })
            .then(data => {
                const icon = btn.querySelector('span');
                if (data.status === 'added') {
                    btn.classList.remove('text-gray-400');
                    btn.classList.add('text-red-500');
                    icon.classList.add('filled');
                } else {
                    btn.classList.add('text-gray-400');
                    btn.classList.remove('text-red-500');
                    icon.classList.remove('filled');
                }
            })
            .catch(error => console.error('Error:', error));
        @else
            window.location.href = "{{ route('login') }}";
        @endauth
    }
</script>

<style>
    .material-symbols-outlined.filled {
        font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
</style>

@endsection