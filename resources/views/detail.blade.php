@extends('layouts.app')

@section('content')

<div class="min-h-screen pt-24 pb-10 bg-background-light dark:bg-background-dark">
    
    <main class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <nav class="mb-4">
            <ol class="flex flex-wrap items-center gap-2 text-xs md:text-sm font-medium text-gray-500 dark:text-gray-400">
                <li><a href="#" class="hover:text-primary-orange transition-colors">Beranda</a></li>
                <li><span class="material-symbols-outlined text-xs pt-1">chevron_right</span></li>
                <li><a href="#" class="hover:text-primary-orange transition-colors">Kuliner</a></li>
                <li><span class="material-symbols-outlined text-xs pt-1">chevron_right</span></li>
                <li class="text-white font-semibold">Kopi Kenangan Senja</li>
            </ol>
        </nav>

        <div class="relative w-full rounded-xl overflow-hidden bg-white dark:bg-surface-dark shadow-md border border-gray-200 dark:border-gray-800 mb-6">
            <div class="h-48 w-full bg-gray-200 relative">
                <img src="https://images.unsplash.com/photo-1511920170033-f8396924c348?w=1200&h=400&fit=crop" alt="Coffee Shop" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
            </div>

            <div class="relative px-5 pb-5">
                <div class="flex flex-col md:flex-row gap-5 -mt-12 items-start md:items-end">
                    <div class="relative h-24 w-24 rounded-full border-4 border-white dark:border-surface-dark bg-white shadow-lg overflow-hidden shrink-0">
                        <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=200&h=200&fit=crop" alt="Logo" class="w-full h-full object-cover">
                    </div>

                    <div class="flex-1 pb-1 w-full">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-end gap-4">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">Kopi Kenangan Senja</h1>
                                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs md:text-sm text-gray-600 dark:text-gray-300">
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-base text-primary-orange">restaurant</span>
                                        Kafe & Resto
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-base text-primary-orange">location_on</span>
                                        Bandung
                                    </span>
                                    <span class="flex items-center gap-1 text-amber-500 font-semibold">
                                        <span class="material-symbols-outlined text-base fill-current">star</span>
                                        4.8
                                        <span class="text-gray-500 dark:text-gray-400 font-normal">(120 Ulasan)</span>
                                    </span>
                                </div>
                            </div>

                            <div class="flex gap-2 w-full md:w-auto mt-2 md:mt-0">
                                <button class="flex-1 md:flex-none h-9 px-4 rounded-lg bg-gradient-to-r from-primary-orange to-primary-green text-white text-xs font-bold hover:shadow-md transition-all flex items-center justify-center gap-1.5">
                                    <span class="material-symbols-outlined text-lg">call</span>
                                    Hubungi
                                </button>
                                <button class="flex-1 md:flex-none h-9 px-4 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 text-xs font-semibold hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors flex items-center justify-center gap-1.5">
                                    <span class="material-symbols-outlined text-lg">favorite</span>
                                    Favorit
                                </button>
                                <button onclick="shareUMKM()" class="h-9 w-9 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors flex items-center justify-center">
                                    <span class="material-symbols-outlined text-lg">share</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-5 border-t border-gray-200 dark:border-gray-700 overflow-x-auto">
                <div class="flex gap-6 min-w-max">
                    <a href="#about" class="tab-link border-b-2 border-primary-orange text-primary-orange py-3 px-1 text-xs md:text-sm font-bold flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-lg">info</span> Tentang
                    </a>
                    <a href="#products" class="tab-link border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 py-3 px-1 text-xs md:text-sm font-bold flex items-center gap-1.5 transition-colors">
                        <span class="material-symbols-outlined text-lg">restaurant_menu</span> Menu
                    </a>
                    <a href="#gallery" class="tab-link border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 py-3 px-1 text-xs md:text-sm font-bold flex items-center gap-1.5 transition-colors">
                        <span class="material-symbols-outlined text-lg">photo_library</span> Galeri
                    </a>
                    <a href="#reviews" class="tab-link border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 py-3 px-1 text-xs md:text-sm font-bold flex items-center gap-1.5 transition-colors">
                        <span class="material-symbols-outlined text-lg">reviews</span> Ulasan
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 space-y-6">
                
                <section id="about" class="bg-white dark:bg-surface-dark rounded-xl p-5 shadow-sm border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-orange">info</span>
                        Tentang Kami
                    </h3>
                    <div class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                        <p class="mb-3">
                            Kopi Kenangan Senja hadir sebagai tempat pelarian dari hiruk pikuk kota. Didirikan pada tahun 2018, kami berkomitmen menyajikan kopi lokal terbaik dari petani Jawa Barat.
                        </p>
                        <p>
                            Selain kopi, kami juga menyediakan berbagai aneka makanan ringan dan camilan tradisional yang dikemas secara modern.
                        </p>
                    </div>

                    <div class="mt-4 flex flex-wrap gap-2">
                        <div class="flex items-center gap-1.5 px-2.5 py-1 bg-orange-50 dark:bg-orange-900/20 text-primary-orange rounded-full text-xs font-medium">
                            <span class="material-symbols-outlined text-sm">verified</span> Terverifikasi
                        </div>
                        <div class="flex items-center gap-1.5 px-2.5 py-1 bg-green-50 dark:bg-green-900/20 text-primary-green rounded-full text-xs font-medium">
                            <span class="material-symbols-outlined text-sm">eco</span> Ramah Lingkungan
                        </div>
                    </div>
                </section>

                <section id="products">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Menu Populer</h3>
                        <a href="#" class="text-primary-orange text-xs font-bold hover:underline">Lihat Semua</a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                        @include('partials.product-card', [
                            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA9_EqBMIBuyJHkTO6bVppMk5YjOdGMcQk61aYLRHV4DAd2mESkiogbxiYpXLOeEvpbF7iR5cZjiYLwI95v_KTNhZLAt54JW3h5WxyWNakHleUJvhz4DFnwHvm286iIcU4zdttfI1oeqW-yyfG_ZEwXoIXx4JF7ghRyKIBKL4P4Obhzc-hz0WHiNoVx_UFTD_e4RSzRr-VjGu0jHn6LJBZkJ5vdMEvcv10OtbLFV9Z_HTxSds8Sr6AYZ242dr2QCPRIeQuafPS74JB6',
                            'title' => 'Cappucino Senja',
                            'price' => 'Rp 28.000',
                            'description' => 'Campuran espresso robusta dengan susu segar.'
                        ])

                        @include('partials.product-card', [
                            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBKBDs49xCDWnYRUnM2SA70tGzewIeXbFGNdEtodbzN33p4qwTrPVVr_MI249ilpIzFU2kOUoYQvUJDlfYsYqHW9SJ5fTzSIWq2ZDxB9bYbkquKGbOwbhrOwq7bHDrAq-0Ta7cu4a0NaJIQWEftTGhbs_bPMnkdjj-a2AYaK3XmhkZ3f6R4sohP6UhhM6yvzIrNWbel_5bU-8aBzfkk32AkX_SphshVcNChxzBIJFkq8qJefU66SHRtio3Wj5j6FT41vdVSasA3ywML',
                            'title' => 'Matcha Latte',
                            'price' => 'Rp 32.000',
                            'description' => 'Bubuk matcha premium Jepang dengan susu.'
                        ])

                        @include('partials.product-card', [
                            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDbOBZ6NfqmfFZVU-M0Eag14a7f6-TZQiN3yn7gmvF21LD3Pm2_Cc98iQRKxqQ471DvYQNX0oC9jt-OpaTpymp42YeRl8gr8_vU-1Wq1OGun8LLW5_yRffWmzWXCrDoEnm5pepnv5s8cXCmJ8ePTbek8R43t4PBU5ajYWnwgTtpGRgrHTgCkDQeetiQtRkN7-km7JXGOPAMgciQWk-HiGAScMhVNi-95tQ8WWvvqWjmtvRkwwLm21ni3tLFxzZUKK22zBis5hg8kuUi',
                            'title' => 'Croissant Butter',
                            'price' => 'Rp 22.000',
                            'description' => 'Pastry renyah dengan butter berkualitas.'
                        ])
                    </div>
                </section>

                <section id="gallery">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Galeri Foto</h3>
                        <a href="#" class="text-primary-orange text-xs font-bold hover:underline">Lihat Semua</a>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                        <div class="md:col-span-2 md:row-span-2 rounded-lg overflow-hidden relative group cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=600&h=600&fit=crop" alt="Interior" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="rounded-lg overflow-hidden relative group aspect-square cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=300&h=300&fit=crop" alt="Coffee" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="rounded-lg overflow-hidden relative group aspect-square cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1545665225-b23b99e4d45e?w=300&h=300&fit=crop" alt="Barista" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="rounded-lg overflow-hidden relative group aspect-square cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=300&h=300&fit=crop" alt="Cake" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="rounded-lg overflow-hidden relative group aspect-square cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=300&h=300&fit=crop" alt="Cake" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                    </div>
                </section>

                <section id="reviews">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Ulasan Pelanggan</h3>
                    </div>
                    <div class="bg-white dark:bg-surface-dark rounded-xl p-5 shadow-sm border border-gray-200 dark:border-gray-700">
                        <div class="flex items-center gap-6 border-b border-gray-100 dark:border-gray-800 pb-5 mb-5">
                            <div class="text-center">
                                <span class="text-4xl font-bold text-gray-900 dark:text-white">4.8</span>
                                <div class="flex text-amber-500 text-xs my-1">
                                    @for($i=0; $i<5; $i++) <span class="material-symbols-outlined fill-current text-sm">star</span> @endfor
                                </div>
                                <span class="text-xs text-gray-500">120 Ulasan</span>
                            </div>
                            <div class="flex-1 space-y-1.5">
                                <div class="flex items-center gap-2"><span class="text-xs font-semibold w-2">5</span><div class="flex-1 h-1.5 bg-gray-100 rounded-full"><div class="h-full bg-primary-orange w-[85%] rounded-full"></div></div></div>
                                <div class="flex items-center gap-2"><span class="text-xs font-semibold w-2">4</span><div class="flex-1 h-1.5 bg-gray-100 rounded-full"><div class="h-full bg-primary-orange w-[10%] rounded-full"></div></div></div>
                                <div class="flex items-center gap-2"><span class="text-xs font-semibold w-2">3</span><div class="flex-1 h-1.5 bg-gray-100 rounded-full"><div class="h-full bg-primary-orange w-[3%] rounded-full"></div></div></div>
                            </div>
                        </div>
                        
                        <div class="space-y-5">
                            <div class="flex gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-xs font-bold shrink-0">SN</div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-bold text-sm text-gray-900 dark:text-white">Siti Nurhaliza</h4>
                                        <span class="text-xs text-gray-400">2 hari lalu</span>
                                    </div>
                                    <div class="flex text-amber-500 text-xs mb-1">
                                        @for($i=0; $i<5; $i++) <span class="material-symbols-outlined fill-current text-sm">star</span> @endfor
                                    </div>
                                    <p class="text-xs text-gray-600 dark:text-gray-300">Tempatnya nyaman banget buat ngerjain tugas. Kopinya enak.</p>
                                </div>
                            </div>
                            
                            <div class="flex gap-3">
                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-xs font-bold shrink-0">BS</div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-bold text-sm text-gray-900 dark:text-white">Budi Santoso</h4>
                                        <span class="text-xs text-gray-400">1 minggu lalu</span>
                                    </div>
                                    <div class="flex text-amber-500 text-xs mb-1">
                                        @for($i=0; $i<4; $i++) <span class="material-symbols-outlined fill-current text-sm">star</span> @endfor
                                        <span class="material-symbols-outlined text-gray-300 text-sm">star</span>
                                    </div>
                                    <p class="text-xs text-gray-600 dark:text-gray-300">Makanannya enak tapi agak lama nunggunya.</p>
                                </div>
                            </div>
                        </div>

                        <button class="w-full mt-5 py-2 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 text-xs font-bold hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            Lihat Semua Ulasan
                        </button>
                    </div>
                </section>
            </div>

            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white dark:bg-surface-dark rounded-xl p-5 shadow-sm border border-gray-200 dark:border-gray-700 sticky top-24 space-y-5">
                    <div>
                        <h4 class="font-bold text-sm text-gray-900 dark:text-white mb-2 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-base text-primary-orange">map</span> Lokasi
                        </h4>
                        <div class="aspect-video w-full rounded-lg bg-gray-100 overflow-hidden relative mb-2 group cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?w=600&h=400&fit=crop" alt="Map" class="w-full h-full object-cover group-hover:opacity-90 transition-opacity">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="bg-white/95 px-2.5 py-1 rounded-full text-[10px] font-bold text-primary-orange shadow-sm">Lihat Peta</span>
                            </div>
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-300">Jl. Braga No. 12, Bandung, Jawa Barat</p>
                    </div>

                    <div>
                        <h4 class="font-bold text-sm text-gray-900 dark:text-white mb-2 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-base text-primary-orange">schedule</span> Jam Buka
                        </h4>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                            </span>
                            <span class="text-xs font-semibold text-green-600">Buka • Tutup 22:00</span>
                        </div>
                        <ul class="space-y-1.5 text-xs text-gray-600 dark:text-gray-300">
                            <li class="flex justify-between"><span>Senin - Jumat</span><span class="font-medium">08:00 - 22:00</span></li>
                            <li class="flex justify-between"><span>Sabtu - Minggu</span><span class="font-medium">09:00 - 23:00</span></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-bold text-sm text-gray-900 dark:text-white mb-2 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-base text-primary-orange">contact_support</span> Kontak
                        </h4>
                        <div class="space-y-2">
                            <a href="#" class="flex items-center gap-3 p-2.5 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all group">
                                <div class="w-7 h-7 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                    <span class="material-symbols-outlined text-sm">chat</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[10px] text-gray-500">WhatsApp</span>
                                    <span class="text-xs font-semibold text-gray-900 dark:text-white group-hover:text-primary-orange">+62 812-3456-7890</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    function shareUMKM() {
        if (navigator.share) {
            navigator.share({ title: 'Kopi Kenangan Senja', url: window.location.href });
        } else {
            navigator.clipboard.writeText(window.location.href);
            alert('Link disalin!');
        }
    }
</script>

@endsection