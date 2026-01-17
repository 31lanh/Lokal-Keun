@extends('layouts.seller')

@section('content')
    <div class="min-h-screen bg-[#FAFAFA] dark:bg-gray-900 p-6 lg:p-10 pt-28 font-sans text-gray-600">
        
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-10">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <h1 class="text-3xl font-semibold text-gray-800 dark:text-white tracking-tight">
                        Dapur <span class="text-primary-orange">{{ $umkm->nama_usaha ?? 'UMKM Anda' }}</span>
                    </h1>
                    
                    @php
                        $now = now()->format('H:i');
                        $isOpen = $umkm->jam_buka && $umkm->jam_tutup && $now >= $umkm->jam_buka && $now <= $umkm->jam_tutup;
                    @endphp
                    @if($isOpen)
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 border border-green-200 text-[10px] uppercase font-bold tracking-wider">
                            Buka
                        </span>
                    @else
                        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-500 border border-gray-200 text-[10px] uppercase font-bold tracking-wider">
                            Tutup
                        </span>
                    @endif
                </div>
                
                <div class="flex flex-wrap items-center gap-4 text-sm font-medium text-gray-500">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-xl text-orange-400">store</span> 
                        {{ $umkm->kategori ?? '-' }}
                    </div>
                    <div class="w-1 h-1 rounded-full bg-gray-300"></div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-xl text-gray-400">location_on</span>
                        {{ Str::limit($umkm->alamat ?? '-', 35) }}
                    </div>
                </div>
            </div>
            
            <div class="flex gap-3">
                <a href="{{ route('seller.umkm.edit') }}" class="flex items-center gap-2 px-6 py-2.5 bg-white border-2 border-blue-100 text-blue-600 rounded-xl text-sm font-semibold hover:border-blue-200 hover:bg-blue-50 transition-all">
                    <span class="material-symbols-outlined text-lg">edit</span>
                    Edit Profil
                </a>
                <a href="{{ url('/detail') }}" target="_blank" class="flex items-center gap-2 px-6 py-2.5 bg-primary-orange text-white rounded-xl text-sm font-semibold hover:bg-orange-600 shadow-lg shadow-orange-500/20 transition-all hover:-translate-y-0.5">
                    <span class="material-symbols-outlined text-lg">visibility</span>
                    Lihat Toko
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
            
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border-2 border-yellow-100 dark:border-yellow-900/30 hover:border-yellow-300 transition-colors duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-400 uppercase tracking-wide">Rating Toko</p>
                        <div class="mt-2 flex items-baseline gap-2">
                            <h3 class="text-3xl font-semibold text-gray-800 dark:text-white">4.8</h3>
                            <span class="text-yellow-500 material-symbols-outlined text-2xl">star</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Dari 120 Ulasan</p>
                    </div>
                    <div class="p-3 bg-yellow-50 text-yellow-600 rounded-xl">
                        <span class="material-symbols-outlined text-2xl">reviews</span>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border-2 border-orange-100 dark:border-orange-900/30 hover:border-orange-300 transition-colors duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-400 uppercase tracking-wide">Total Menu</p>
                        <div class="mt-2 flex items-baseline gap-2">
                            <h3 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ $umkm->menus->count() ?? 0 }}</h3>
                            <span class="text-sm text-gray-500">Item</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Sedang ditampilkan</p>
                    </div>
                    <div class="p-3 bg-orange-50 text-orange-600 rounded-xl">
                        <span class="material-symbols-outlined text-2xl">restaurant_menu</span>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border-2 border-green-100 dark:border-green-900/30 hover:border-green-300 transition-colors duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-400 uppercase tracking-wide">Interaksi WhatsApp</p>
                        <div class="mt-2 flex items-baseline gap-2">
                            <h3 class="text-3xl font-semibold text-gray-800 dark:text-white">24</h3>
                            <span class="text-sm text-gray-500">Klik</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Dalam 30 hari terakhir</p>
                    </div>
                    <div class="p-3 bg-green-50 text-green-600 rounded-xl">
                        <span class="material-symbols-outlined text-2xl">chat</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1 space-y-8">
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Informasi Detail</h3>
                    
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="shrink-0 w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-500">
                                <span class="material-symbols-outlined text-lg">person</span>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-400 uppercase">Pemilik</p>
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-200 mt-0.5">{{ $umkm->nama_pemilik }}</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="shrink-0 w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center text-purple-500">
                                <span class="material-symbols-outlined text-lg">schedule</span>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-400 uppercase">Jam Operasional</p>
                                @if($umkm->jam_buka)
                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-200 mt-0.5">
                                        {{ \Carbon\Carbon::parse($umkm->jam_buka)->format('H:i') }} - {{ \Carbon\Carbon::parse($umkm->jam_tutup)->format('H:i') }}
                                    </p>
                                @else
                                    <p class="text-sm text-gray-400 italic">Belum diatur</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="shrink-0 w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-green-500">
                                <span class="material-symbols-outlined text-lg">call</span>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-400 uppercase">WhatsApp</p>
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-200 mt-0.5">{{ $umkm->telepon }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Galeri Tempat</h3>
                    <div class="grid grid-cols-2 gap-3">
                        @forelse($umkm->photos as $photo)
                            <div class="aspect-square rounded-xl overflow-hidden border border-gray-100">
                                <img src="{{ $photo->photo_url }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                            </div>
                        @empty
                            <div class="col-span-2 py-8 text-center bg-gray-50 rounded-xl border border-dashed border-gray-300">
                                <p class="text-xs text-gray-400">Belum ada foto</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 flex flex-col h-full">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Daftar Menu</h3>
                        <a href="{{ route('seller.umkm.edit') }}#menu-container" 
                            class="flex items-center gap-1 bg-primary-orange hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-xs font-medium transition-colors shadow-sm">
                            <span class="material-symbols-outlined text-sm">add</span> Tambah Menu
                        </a>
                    </div>

                    <div class="p-6 space-y-4">
                        @forelse($umkm->menus as $menu)
                            <div class="group flex items-start gap-4 p-4 rounded-xl border border-gray-200 bg-white hover:border-orange-200 hover:shadow-[0_4px_20px_-10px_rgba(249,115,22,0.1)] transition-all duration-300">
                                <div class="shrink-0 w-20 h-20 rounded-lg bg-gray-100 overflow-hidden border border-gray-200">
                                    @if($menu->photo_path)
                                        <img src="{{ $menu->photo_path }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                                            <span class="material-symbols-outlined">fastfood</span>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="flex-1 py-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium text-gray-800 text-base group-hover:text-primary-orange transition-colors">{{ $menu->name }}</h4>
                                            <p class="text-xs text-gray-500 mt-1 line-clamp-1 pr-4">{{ $menu->description ?? 'Deskripsi tidak tersedia' }}</p>
                                        </div>
                                        <span class="font-medium text-green-700 bg-green-50 px-3 py-1 rounded-lg text-sm border border-green-100 whitespace-nowrap">
                                            Rp {{ number_format($menu->price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    
                                    <div class="flex gap-3 mt-4 pt-3 border-t border-dashed border-gray-100">
    
                                        <a href="{{ route('seller.umkm.edit') }}#menu-container" 
                                           class="flex items-center gap-1.5 text-xs font-medium text-blue-600 hover:text-blue-700 hover:underline cursor-pointer">
                                            <span class="material-symbols-outlined text-base">edit</span> Edit
                                        </a>
                                    
                                        <span class="text-gray-300">|</span>
                                    
                                        <form action="{{ route('seller.menu.delete', $menu->id) }}" method="POST" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu {{ $menu->name }}?');" 
                                              class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="flex items-center gap-1.5 text-xs font-medium text-red-500 hover:text-red-700 hover:underline bg-transparent border-0 p-0 cursor-pointer">
                                                <span class="material-symbols-outlined text-base">delete</span> Hapus
                                            </button>
                                        </form>
                                    
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="flex flex-col items-center justify-center py-20 text-center bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm border border-gray-100">
                                    <span class="material-symbols-outlined text-3xl text-gray-300">restaurant_menu</span>
                                </div>
                                <p class="text-gray-800 font-medium">Belum ada menu</p>
                                <p class="text-xs text-gray-500 mt-1">Mulai tambahkan menu untuk menarik pelanggan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection