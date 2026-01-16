@extends('layouts.app')

@section('content')
    <!-- Hero Section with Welcome Message -->
    <section
        class="relative min-h-[40vh] flex items-center justify-center overflow-hidden pt-20 pb-12 bg-gradient-to-br from-orange-50 via-white to-green-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-10 right-20 w-64 h-64 bg-primary-orange/10 rounded-full blur-3xl animate-pulse-slow">
            </div>
            <div class="absolute bottom-10 left-20 w-80 h-80 bg-primary-green/10 rounded-full blur-3xl animate-pulse-slow"
                style="animation-delay: 1s;"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center space-y-4">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-surface-dark rounded-full shadow-lg">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Selamat Datang Kembali!</span>
                </div>

                <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 dark:text-white">
                    Halo, <span class="gradient-text">{{ Auth::user()->name }}</span>! 👋
                </h1>

                <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Siap menemukan produk lokal terbaik hari ini?
                </p>
            </div>
        </div>
    </section>

    <!-- Quick Stats Section -->
    <section class="py-8 bg-white dark:bg-surface-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <!-- Stat Card 1 -->
                <div
                    class="bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-2">
                        <span class="material-symbols-outlined text-primary-orange text-3xl">shopping_cart</span>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">12</div>
                    <div class="text-sm text-gray-600 dark:text-gray-300">Pesanan Aktif</div>
                </div>

                <!-- Stat Card 2 -->
                <div
                    class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-2">
                        <span class="material-symbols-outlined text-primary-green text-3xl">favorite</span>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">24</div>
                    <div class="text-sm text-gray-600 dark:text-gray-300">UMKM Favorit</div>
                </div>

                <!-- Stat Card 3 -->
                <div
                    class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-2">
                        <span class="material-symbols-outlined text-blue-600 text-3xl">history</span>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">47</div>
                    <div class="text-sm text-gray-600 dark:text-gray-300">Total Pesanan</div>
                </div>

                <!-- Stat Card 4 -->
                <div
                    class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-2">
                        <span class="material-symbols-outlined text-purple-600 text-3xl">loyalty</span>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">850</div>
                    <div class="text-sm text-gray-600 dark:text-gray-300">Poin Rewards</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Dashboard Content -->
    <section class="py-12 bg-background-light dark:bg-background-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Left Column - Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Recent Orders -->
                    <div class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-lg">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary-orange">receipt_long</span>
                                Pesanan Terbaru
                            </h2>
                            <a href="#" class="text-primary-orange font-semibold hover:underline text-sm">Lihat Semua
                                →</a>
                        </div>

                        <div class="space-y-4">
                            <!-- Order Item 1 -->
                            <div
                                class="flex items-center gap-4 p-4 bg-background-light dark:bg-background-dark rounded-xl hover:shadow-md transition-all">
                                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAH-r_3740txB_8yriQQTGsCciGpxUi8rrtMIJgRVNrAKhwbWpBszv3KnB-gzEBk3uNMmi53gb5SqOyFHC3nplAkYcvTXl4ZhbVkDET9SIqx4Tn8JEtypviaYk3TpaTDgv2eUkVI9Kq28l5hdYYuKOgGs9z5dx1gesJJfE_BZrakAGXJ3S7ccKb5DSsoc7AZwWHqdtpc9JnPPpLFDBrAp5frVj18I_-dai1-Y3G-9kBq1Qdn_kg52HBX8-_x2GYYK2mtb63qAnEjeAB"
                                    alt="Product" class="w-16 h-16 rounded-lg object-cover">
                                <div class="flex-1">
                                    <h3 class="font-bold text-gray-900 dark:text-white">Paket Gudeg Bu Sri</h3>
                                    <p class="text-sm text-gray-500">Dapur Bu Sri • 2 item</p>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-primary-orange">Rp 75.000</div>
                                    <span
                                        class="inline-block px-3 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 text-xs font-semibold rounded-full">Diproses</span>
                                </div>
                            </div>

                            <!-- Order Item 2 -->
                            <div
                                class="flex items-center gap-4 p-4 bg-background-light dark:bg-background-dark rounded-xl hover:shadow-md transition-all">
                                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAvCYL1K2Vb5nl9qmT4MeAovBFSusJK5EmRy9YvgPhPtstRFHvGC7Sty164aF_DzTMnpl0UqflAOS9cgc2P3Vc0UMSzZka5TZAsmXyrmRmLWSlc_g-M3et6vQD5ob83dH6SPiGhEYD0TQJrQP55uhfEbmR8Yo1QyIuD5YpVqpyAkcIzpGgTiBKnoflMLzB_BuISBMwEL1no4UaIa5tmHWyuMfXoBgw8LClF0o1kQvfPpUSJfLi9DpnGjONFXXowaP_QBkJY1FO6-E_N"
                                    alt="Product" class="w-16 h-16 rounded-lg object-cover">
                                <div class="flex-1">
                                    <h3 class="font-bold text-gray-900 dark:text-white">Kemeja Batik Premium</h3>
                                    <p class="text-sm text-gray-500">Batik Modern Jaya • 1 item</p>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-primary-green">Rp 250.000</div>
                                    <span
                                        class="inline-block px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 text-xs font-semibold rounded-full">Dikirim</span>
                                </div>
                            </div>

                            <!-- Order Item 3 -->
                            <div
                                class="flex items-center gap-4 p-4 bg-background-light dark:bg-background-dark rounded-xl hover:shadow-md transition-all">
                                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuClDw98UeX5KmhV1ow2cOiRvODhKEhLV1dEONNeECFOEVXTcHFN34HPUPWYS7HnhuzWVFvmXmhtxvRRi2Jo6dy8C98HFpCpsjeV9S30YU4NJVYgxRna8ZOoCyanyL0L96toVHPScs9gYCAaQpxcOkfMR13x8ZqSaF_3hUNcClKcYbFXnysQxbpjswagwWA-_-jd3-F5dzTYwzeMkgK4OEP-3hCgDsoMoHxpXZwxSiNbJ6Mw3D-PI-rVwYNjJ2W9_HCqj2KM5QRLOipV"
                                    alt="Product" class="w-16 h-16 rounded-lg object-cover">
                                <div class="flex-1">
                                    <h3 class="font-bold text-gray-900 dark:text-white">Keranjang Bambu Set</h3>
                                    <p class="text-sm text-gray-500">Anyaman Bambu Sejahtera • 3 item</p>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-gray-600 dark:text-gray-400">Rp 180.000</div>
                                    <span
                                        class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-xs font-semibold rounded-full">Selesai</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recommended Products -->
                    <div class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-lg">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary-green">recommend</span>
                                Rekomendasi Untukmu
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Product Card 1 -->
                            <div
                                class="group bg-background-light dark:bg-background-dark rounded-xl overflow-hidden hover:shadow-lg transition-all">
                                <div class="relative h-32 overflow-hidden">
                                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAH-r_3740txB_8yriQQTGsCciGpxUi8rrtMIJgRVNrAKhwbWpBszv3KnB-gzEBk3uNMmi53gb5SqOyFHC3nplAkYcvTXl4ZhbVkDET9SIqx4Tn8JEtypviaYk3TpaTDgv2eUkVI9Kq28l5hdYYuKOgGs9z5dx1gesJJfE_BZrakAGXJ3S7ccKb5DSsoc7AZwWHqdtpc9JnPPpLFDBrAp5frVj18I_-dai1-Y3G-9kBq1Qdn_kg52HBX8-_x2GYYK2mtb63qAnEjeAB"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                        alt="Product">
                                </div>
                                <div class="p-4">
                                    <h3 class="font-bold text-gray-900 dark:text-white mb-1">Nasi Liwet Komplit</h3>
                                    <div class="flex items-center justify-between">
                                        <span class="text-primary-orange font-bold">Rp 35.000</span>
                                        <button
                                            class="p-2 bg-orange-light dark:bg-orange-900/30 text-primary-orange rounded-lg hover:scale-110 transition-transform">
                                            <span class="material-symbols-outlined text-xl">add_shopping_cart</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Card 2 -->
                            <div
                                class="group bg-background-light dark:bg-background-dark rounded-xl overflow-hidden hover:shadow-lg transition-all">
                                <div class="relative h-32 overflow-hidden">
                                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAvCYL1K2Vb5nl9qmT4MeAovBFSusJK5EmRy9YvgPhPtstRFHvGC7Sty164aF_DzTMnpl0UqflAOS9cgc2P3Vc0UMSzZka5TZAsmXyrmRmLWSlc_g-M3et6vQD5ob83dH6SPiGhEYD0TQJrQP55uhfEbmR8Yo1QyIuD5YpVqpyAkcIzpGgTiBKnoflMLzB_BuISBMwEL1no4UaIa5tmHWyuMfXoBgw8LClF0o1kQvfPpUSJfLi9DpnGjONFXXowaP_QBkJY1FO6-E_N"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                        alt="Product">
                                </div>
                                <div class="p-4">
                                    <h3 class="font-bold text-gray-900 dark:text-white mb-1">Kaos Batik Casual</h3>
                                    <div class="flex items-center justify-between">
                                        <span class="text-primary-green font-bold">Rp 125.000</span>
                                        <button
                                            class="p-2 bg-green-light dark:bg-green-900/30 text-primary-green rounded-lg hover:scale-110 transition-transform">
                                            <span class="material-symbols-outlined text-xl">add_shopping_cart</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Sidebar -->
                <div class="space-y-6">
                    <!-- Profile Card -->
                    <div class="bg-gradient-to-br from-primary-orange to-orange-dark rounded-2xl p-6 text-white shadow-lg">
                        <div class="flex items-center gap-4 mb-4">
                            <div
                                class="size-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-2xl font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-lg">{{ Auth::user()->name }}</h3>
                                <p class="text-sm text-white/80">Pembeli Premium</p>
                            </div>
                        </div>
                        <a href="#"
                            class="block w-full py-2 bg-white/20 backdrop-blur-sm rounded-lg text-center font-semibold hover:bg-white/30 transition-all">
                            Lihat Profil
                        </a>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-lg">
                        <h3 class="font-bold text-gray-900 dark:text-white mb-4">Aksi Cepat</h3>
                        <div class="space-y-3">
                            <a href="#"
                                class="flex items-center gap-3 p-3 bg-background-light dark:bg-background-dark rounded-lg hover:shadow-md transition-all group">
                                <span
                                    class="material-symbols-outlined text-primary-orange group-hover:scale-110 transition-transform">search</span>
                                <span class="font-semibold text-gray-900 dark:text-white">Cari Produk</span>
                            </a>
                            <a href="#"
                                class="flex items-center gap-3 p-3 bg-background-light dark:bg-background-dark rounded-lg hover:shadow-md transition-all group">
                                <span
                                    class="material-symbols-outlined text-primary-green group-hover:scale-110 transition-transform">store</span>
                                <span class="font-semibold text-gray-900 dark:text-white">Jelajah UMKM</span>
                            </a>
                            <a href="#"
                                class="flex items-center gap-3 p-3 bg-background-light dark:bg-background-dark rounded-lg hover:shadow-md transition-all group">
                                <span
                                    class="material-symbols-outlined text-orange-600 group-hover:scale-110 transition-transform">local_offer</span>
                                <span class="font-semibold text-gray-900 dark:text-white">Promo Hari Ini</span>
                            </a>
                        </div>
                    </div>

                    <!-- Loyalty Card -->
                    <div class="bg-gradient-to-br from-primary-green to-green-dark rounded-2xl p-6 text-white shadow-lg">
                        <div class="flex items-center justify-between mb-3">
                            <span class="material-symbols-outlined text-4xl">loyalty</span>
                            <span class="text-sm font-semibold bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full">Gold
                                Member</span>
                        </div>
                        <h3 class="font-bold text-2xl mb-1">850 Poin</h3>
                        <p class="text-sm text-white/80 mb-4">150 poin lagi jadi Platinum!</p>
                        <div class="w-full bg-white/20 rounded-full h-2 mb-2">
                            <div class="bg-white rounded-full h-2" style="width: 85%"></div>
                        </div>
                        <a href="#" class="text-sm font-semibold hover:underline">Tukar Poin →</a>
                    </div>

                    <!-- Favorite UMKM -->
                    <div class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-lg">
                        <h3 class="font-bold text-gray-900 dark:text-white mb-4">UMKM Favorit</h3>
                        <div class="space-y-3">
                            <a href="#"
                                class="flex items-center gap-3 hover:bg-background-light dark:hover:bg-background-dark p-2 rounded-lg transition-all">
                                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAH-r_3740txB_8yriQQTGsCciGpxUi8rrtMIJgRVNrAKhwbWpBszv3KnB-gzEBk3uNMmi53gb5SqOyFHC3nplAkYcvTXl4ZhbVkDET9SIqx4Tn8JEtypviaYk3TpaTDgv2eUkVI9Kq28l5hdYYuKOgGs9z5dx1gesJJfE_BZrakAGXJ3S7ccKb5DSsoc7AZwWHqdtpc9JnPPpLFDBrAp5frVj18I_-dai1-Y3G-9kBq1Qdn_kg52HBX8-_x2GYYK2mtb63qAnEjeAB"
                                    class="w-10 h-10 rounded-lg object-cover" alt="UMKM">
                                <div class="flex-1">
                                    <div class="font-semibold text-sm text-gray-900 dark:text-white">Dapur Bu Sri</div>
                                    <div class="text-xs text-gray-500">Kuliner</div>
                                </div>
                            </a>
                            <a href="#"
                                class="flex items-center gap-3 hover:bg-background-light dark:hover:bg-background-dark p-2 rounded-lg transition-all">
                                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAvCYL1K2Vb5nl9qmT4MeAovBFSusJK5EmRy9YvgPhPtstRFHvGC7Sty164aF_DzTMnpl0UqflAOS9cgc2P3Vc0UMSzZka5TZAsmXyrmRmLWSlc_g-M3et6vQD5ob83dH6SPiGhEYD0TQJrQP55uhfEbmR8Yo1QyIuD5YpVqpyAkcIzpGgTiBKnoflMLzB_BuISBMwEL1no4UaIa5tmHWyuMfXoBgw8LClF0o1kQvfPpUSJfLi9DpnGjONFXXowaP_QBkJY1FO6-E_N"
                                    class="w-10 h-10 rounded-lg object-cover" alt="UMKM">
                                <div class="flex-1">
                                    <div class="font-semibold text-sm text-gray-900 dark:text-white">Batik Modern Jaya
                                    </div>
                                    <div class="text-xs text-gray-500">Fashion</div>
                                </div>
                            </a>
                            <a href="#"
                                class="flex items-center gap-3 hover:bg-background-light dark:hover:bg-background-dark p-2 rounded-lg transition-all">
                                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuClDw98UeX5KmhV1ow2cOiRvODhKEhLV1dEONNeECFOEVXTcHFN34HPUPWYS7HnhuzWVFvmXmhtxvRRi2Jo6dy8C98HFpCpsjeV9S30YU4NJVYgxRna8ZOoCyanyL0L96toVHPScs9gYCAaQpxcOkfMR13x8ZqSaF_3hUNcClKcYbFXnysQxbpjswagwWA-_-jd3-F5dzTYwzeMkgK4OEP-3hCgDsoMoHxpXZwxSiNbJ6Mw3D-PI-rVwYNjJ2W9_HCqj2KM5QRLOipV"
                                    class="w-10 h-10 rounded-lg object-cover" alt="UMKM">
                                <div class="flex-1">
                                    <div class="font-semibold text-sm text-gray-900 dark:text-white">Anyaman Bambu</div>
                                    <div class="text-xs text-gray-500">Kerajinan</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
