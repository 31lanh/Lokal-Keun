@extends('layouts.seller')

@section('content')
<div class="relative flex min-h-screen w-full flex-col overflow-x-hidden font-display">

    {{-- Background Decoration --}}
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 right-10 w-72 h-72 bg-primary-orange/10 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-20 left-10 w-96 h-96 bg-primary-green/10 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
    </div>

    <div class="relative z-10 flex-1 flex justify-center py-16 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col max-w-[1000px] w-full gap-10">

            {{-- Header Text --}}
            <div class="text-center space-y-6 pt-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-orange-light dark:bg-orange-900/30 rounded-full mb-4">
                    <span class="w-2 h-2 bg-primary-orange rounded-full animate-pulse"></span>
                    <span class="text-sm font-bold text-primary-orange uppercase tracking-wider">Daftar Sekarang</span>
                </div>
                <h1 class="text-4xl sm:text-6xl font-extrabold leading-tight">
                    Bergabung dengan <span class="text-primary-orange">Jaringan UMKM</span>
                </h1>
                <p class="text-gray-600 dark:text-slate-400 text-lg max-w-2xl mx-auto leading-relaxed">
                    Isi formulir di bawah ini untuk memperkenalkan produk Anda. <strong>100% Gratis!</strong>
                </p>
            </div>

            <form action="{{ route('seller.daftar.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-8" id="form-daftar">
                @csrf

                {{-- Error Handling --}}
                @if ($errors->any())
                <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-200 px-6 py-4 rounded-xl">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- 1. INFORMASI DASAR --}}
                <div class="group relative bg-white dark:bg-surface-dark rounded-3xl shadow-lg border-2 border-transparent hover:border-primary-orange/20 overflow-hidden">
                    <div class="relative p-6 sm:p-8">
                        <div class="flex items-center gap-4 mb-6 pb-5 border-b border-gray-100 dark:border-gray-700">
                            <div class="p-3 bg-gradient-to-br from-primary-orange to-orange-dark rounded-2xl shadow-lg text-white">
                                <span class="material-symbols-outlined text-2xl">badge</span>
                            </div>
                            <div>
                                <h2 class="text-gray-900 dark:text-white text-2xl font-bold">Informasi Dasar</h2>
                                <p class="text-sm text-gray-500">Identitas usaha Anda</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <label class="flex flex-col gap-2">
                                <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Nama Usaha <span class="text-primary-orange">*</span></span>
                                <input name="nama_usaha" value="{{ old('nama_usaha') }}" class="form-input w-full rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 h-12 px-4 focus:border-primary-orange focus:ring-0" placeholder="Contoh: Keripik Tempe Bu Ani" required />
                            </label>

                            <label class="flex flex-col gap-2">
                                <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Kategori <span class="text-primary-orange">*</span></span>
                                <select name="kategori" class="form-select w-full rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 h-12 px-4 focus:border-primary-orange focus:ring-0" required>
                                    <option disabled selected value="">Pilih Kategori</option>
                                    <option value="kuliner" {{ old('kategori') == 'kuliner' ? 'selected' : '' }}>🍜 Kuliner</option>
                                    <option value="fashion" {{ old('kategori') == 'fashion' ? 'selected' : '' }}>👗 Fashion</option>
                                    <option value="kerajinan" {{ old('kategori') == 'kerajinan' ? 'selected' : '' }}>🎨 Kerajinan</option>
                                    <option value="jasa" {{ old('kategori') == 'jasa' ? 'selected' : '' }}>🛠️ Jasa</option>
                                    <option value="pertanian" {{ old('kategori') == 'pertanian' ? 'selected' : '' }}>🌾 Pertanian</option>
                                </select>
                            </label>

                            <label class="flex flex-col gap-2">
                                <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Nama Pemilik <span class="text-primary-orange">*</span></span>
                                <input name="nama_pemilik" value="{{ old('nama_pemilik', auth()->user()->name) }}" class="form-input w-full rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 h-12 px-4 focus:border-primary-orange focus:ring-0" required />
                            </label>

                            <label class="flex flex-col gap-2">
                                <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Tahun Berdiri</span>
                                <input type="number" name="tahun_berdiri" value="{{ old('tahun_berdiri') }}" class="form-input w-full rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 h-12 px-4 focus:border-primary-orange focus:ring-0" placeholder="2023" />
                            </label>
                        </div>
                    </div>
                </div>

                {{-- 2. TENTANG USAHA --}}
                <div class="group relative bg-white dark:bg-surface-dark rounded-3xl shadow-lg border-2 border-transparent hover:border-primary-green/20 overflow-hidden">
                    <div class="relative p-6 sm:p-8">
                        <div class="flex items-center gap-4 mb-6 pb-5 border-b border-gray-100 dark:border-gray-700">
                            <div class="p-3 bg-gradient-to-br from-primary-green to-green-dark rounded-2xl shadow-lg text-white">
                                <span class="material-symbols-outlined text-2xl">description</span>
                            </div>
                            <div>
                                <h2 class="text-gray-900 dark:text-white text-2xl font-bold">Tentang Usaha</h2>
                                <p class="text-sm text-gray-500">Cerita singkat produk Anda</p>
                            </div>
                        </div>
                        <label class="flex flex-col gap-2">
                            <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Deskripsi Singkat <span class="text-primary-orange">*</span></span>
                            <textarea name="deskripsi" class="form-textarea w-full rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 p-4 focus:border-primary-green focus:ring-0" rows="4" minlength="50" placeholder="Ceritakan keunggulan produk Anda..." required>{{ old('deskripsi') }}</textarea>
                            <p class="text-xs text-gray-500 text-right">Min. 50 karakter</p>
                        </label>
                    </div>
                </div>

                {{-- 3. KONTAK & LOKASI --}}
                <div class="group relative bg-white dark:bg-surface-dark rounded-3xl shadow-lg border-2 border-transparent hover:border-primary-orange/20 overflow-hidden">
                    <div class="relative p-6 sm:p-8">
                        <div class="flex items-center gap-4 mb-6 pb-5 border-b border-gray-100 dark:border-gray-700">
                            <div class="p-3 bg-gradient-to-br from-primary-orange to-orange-dark rounded-2xl shadow-lg text-white">
                                <span class="material-symbols-outlined text-2xl">location_on</span>
                            </div>
                            <div>
                                <h2 class="text-gray-900 dark:text-white text-2xl font-bold">Kontak & Lokasi</h2>
                                <p class="text-sm text-gray-500">Agar mudah dihubungi</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <label class="flex flex-col gap-2">
                                <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">WhatsApp / Telepon <span class="text-primary-orange">*</span></span>
                                <input type="tel" name="telepon" value="{{ old('telepon') }}" class="form-input w-full rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 h-12 px-4 focus:border-primary-orange focus:ring-0" required />
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Email</span>
                                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-input w-full rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 h-12 px-4 focus:border-primary-orange focus:ring-0" />
                            </label>
                        </div>

                        <div class="mb-6">
                            <label class="flex flex-col gap-2">
                                <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Link Google Maps</span>
                                <div class="relative flex items-center">
                                    <span class="absolute left-4 text-blue-500 material-symbols-outlined text-xl">map</span>
                                    <input type="url" name="maps_link" value="{{ old('maps_link') }}" class="form-input w-full pl-12 rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 h-12 focus:border-blue-500 focus:ring-0" placeholder="https://maps.google.com/..." />
                                </div>
                            </label>
                        </div>

                        <label class="flex flex-col gap-2">
                            <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Alamat Lengkap <span class="text-primary-orange">*</span></span>
                            <textarea name="alamat" class="form-textarea w-full rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 p-4 focus:border-primary-orange focus:ring-0" rows="3" required>{{ old('alamat') }}</textarea>
                        </label>
                    </div>
                </div>

                {{-- 4. JAM OPERASIONAL --}}
                <div class="group relative bg-white dark:bg-surface-dark rounded-3xl shadow-lg border-2 border-transparent hover:border-primary-green/20 overflow-hidden">
                    <div class="relative p-6 sm:p-8">
                        <div class="flex items-center gap-4 mb-6 pb-5 border-b border-gray-100 dark:border-gray-700">
                            <div class="p-3 bg-gradient-to-br from-primary-green to-green-dark rounded-2xl shadow-lg text-white">
                                <span class="material-symbols-outlined text-2xl">schedule</span>
                            </div>
                            <div>
                                <h2 class="text-gray-900 dark:text-white text-2xl font-bold">Jam Operasional</h2>
                                <p class="text-sm text-gray-500">Waktu buka toko</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <label class="flex flex-col gap-2">
                                <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Buka</span>
                                <input type="time" name="jam_buka" value="{{ old('jam_buka') }}" class="form-input w-full rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 h-12 px-4 focus:border-primary-green focus:ring-0" />
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Tutup</span>
                                <input type="time" name="jam_tutup" value="{{ old('jam_tutup') }}" class="form-input w-full rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 h-12 px-4 focus:border-primary-green focus:ring-0" />
                            </label>
                        </div>
                    </div>
                </div>

                {{-- 5. DAFTAR MENU --}}
                <div class="group relative bg-white dark:bg-surface-dark rounded-3xl shadow-lg border-2 border-transparent hover:border-red-500/20 overflow-hidden">
                    <div class="relative p-6 sm:p-8">
                        <div class="flex items-center justify-between mb-6 pb-5 border-b border-gray-100 dark:border-gray-700">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-gradient-to-br from-red-500 to-red-700 rounded-2xl shadow-lg text-white">
                                    <span class="material-symbols-outlined text-2xl">restaurant_menu</span>
                                </div>
                                <div>
                                    <h2 class="text-gray-900 dark:text-white text-2xl font-bold">Daftar Menu</h2>
                                    <p class="text-sm text-gray-500">Tambahkan menu pertama Anda</p>
                                </div>
                            </div>
                            <span id="menu-count" class="px-3 py-1 bg-red-50 dark:bg-red-900/20 text-red-600 rounded-full text-xs font-bold border border-red-100 dark:border-red-800">1 Item</span>
                        </div>

                        <div id="menu-container" class="space-y-4">
                            {{-- Item Menu Template (Index 0) --}}
                            <div class="menu-item relative flex flex-col sm:flex-row gap-4 p-4 rounded-xl border-2 border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-slate-800/50">
                                
                                {{-- Upload Foto Menu --}}
                                <div class="shrink-0 w-full sm:w-28">
                                    <label class="block w-full aspect-square rounded-lg border-2 border-dashed border-gray-300 hover:border-red-500 hover:bg-red-50 transition-all cursor-pointer flex flex-col items-center justify-center text-center p-2 relative overflow-hidden">
                                        <input type="file" name="menus[0][photo]" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(this)">
                                        <div class="preview-placeholder flex flex-col items-center gap-1 text-gray-400">
                                            <span class="material-symbols-outlined text-2xl">add_a_photo</span>
                                            <span class="text-[10px] font-medium">Foto</span>
                                        </div>
                                        <img class="preview-img absolute inset-0 w-full h-full object-cover hidden rounded-lg" />
                                    </label>
                                </div>

                                {{-- Input Text Menu --}}
                                <div class="flex-1 space-y-3">
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                        <div class="sm:col-span-2">
                                            <label class="block text-xs font-bold text-gray-500 mb-1">Nama Menu <span class="text-red-500">*</span></label>
                                            <input type="text" name="menus[0][name]" class="w-full h-9 px-3 rounded-lg text-sm border-2 border-gray-200 dark:border-slate-600 bg-white dark:bg-slate-800 focus:border-red-500 focus:ring-0" placeholder="Nasi Goreng" required>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-500 mb-1">Harga <span class="text-red-500">*</span></label>
                                            <div class="relative">
                                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-bold text-gray-400">Rp</span>
                                                <input type="number" name="menus[0][price]" class="w-full h-9 pl-8 pr-3 rounded-lg text-sm border-2 border-gray-200 dark:border-slate-600 bg-white dark:bg-slate-800 focus:border-red-500 focus:ring-0" placeholder="15000" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 mb-1">Deskripsi</label>
                                        <textarea name="menus[0][description]" rows="2" class="w-full p-3 rounded-lg text-sm border-2 border-gray-200 dark:border-slate-600 bg-white dark:bg-slate-800 focus:border-red-500 focus:ring-0 resize-none" placeholder="Deskripsi menu..."></textarea>
                                    </div>
                                </div>

                                {{-- Tombol Hapus (Hidden Default) --}}
                                <button type="button" class="btn-remove-menu hidden absolute -top-2 -right-2 bg-white text-red-500 p-1 rounded-full shadow-md border border-gray-200 hover:scale-110 transition-all z-20">
                                    <span class="material-symbols-outlined text-lg">close</span>
                                </button>
                            </div>
                        </div>

                        <button type="button" id="btn-add-menu" class="mt-4 w-full py-3 border-2 border-dashed border-gray-300 rounded-xl text-gray-500 font-semibold hover:border-red-500 hover:text-red-500 hover:bg-red-50 transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">add_circle</span> Tambah Menu Lainnya
                        </button>
                    </div>
                </div>

                {{-- 6. GALERI FOTO (MULTIPLE & DELETE PREVIEW) --}}
                <div class="group relative bg-white dark:bg-surface-dark rounded-3xl shadow-lg border-2 border-transparent hover:border-primary-orange/20 overflow-hidden">
                    <div class="relative p-6 sm:p-8">
                        <div class="flex items-center gap-4 mb-6 pb-5 border-b border-gray-100 dark:border-gray-700">
                            <div class="p-3 bg-gradient-to-br from-primary-orange to-orange-dark rounded-2xl shadow-lg text-white">
                                <span class="material-symbols-outlined text-2xl">storefront</span>
                            </div>
                            <div>
                                <h2 class="text-gray-900 dark:text-white text-2xl font-bold">Galeri Foto</h2>
                                <p class="text-sm text-gray-500">Upload foto usaha Anda (Bisa pilih banyak)</p>
                            </div>
                        </div>

                        <div class="flex flex-col gap-4">
                            {{-- Input Galeri Multiple --}}
                            <input type="file" name="photos[]" multiple accept="image/*" class="hidden" id="photo-upload-gallery" onchange="previewGallery(this)">
                            
                            <label for="photo-upload-gallery" class="border-2 border-dashed border-primary-orange/30 rounded-2xl p-10 flex flex-col items-center justify-center text-center gap-4 bg-orange-50/50 hover:bg-orange-100/50 hover:border-primary-orange transition-all cursor-pointer group">
                                <div class="size-20 rounded-2xl bg-gradient-to-br from-primary-orange/20 to-orange-dark/20 flex items-center justify-center text-primary-orange shadow-lg group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-4xl">add_photo_alternate</span>
                                </div>
                                <div>
                                    <p class="text-gray-900 dark:text-white font-bold text-lg">Klik untuk unggah banyak foto</p>
                                    <p class="text-gray-500 text-sm">JPG/PNG Maks. 5MB per file</p>
                                </div>
                            </label>

                            {{-- Container Preview --}}
                            <div id="gallery-preview-container" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-2"></div>
                        </div>
                    </div>
                </div>

                {{-- TOMBOL SUBMIT --}}
                <div class="sticky bottom-0 bg-white/95 dark:bg-surface-dark/95 backdrop-blur-xl p-6 -mx-4 sm:mx-0 sm:p-0 sm:bg-transparent sm:backdrop-blur-none sm:relative flex flex-col-reverse sm:flex-row justify-between items-center gap-4 border-t sm:border-t-0 border-gray-200 rounded-t-3xl sm:rounded-none shadow-2xl sm:shadow-none">
                    <div class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-400">
                        <span class="material-symbols-outlined text-primary-green">verified</span>
                        <span class="font-semibold">Setup dalam 5 menit</span>
                    </div>
                    <div class="flex flex-col-reverse sm:flex-row gap-3 w-full sm:w-auto">
                        <a href="{{ route('home') }}" class="w-full sm:w-auto px-8 py-3.5 rounded-xl border-2 border-gray-300 text-gray-900 font-bold hover:bg-gray-50 text-center">Nanti Saja</a>
                        <button type="submit" class="w-full sm:w-auto px-10 py-3.5 bg-gradient-to-r from-primary-orange to-primary-green hover:shadow-2xl text-white font-bold rounded-xl flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">rocket_launch</span> Daftarkan Usaha
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<template id="menu-template">
    <div class="menu-item relative flex flex-col sm:flex-row gap-4 p-4 rounded-xl border-2 border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-slate-800/50 animation-fade-in">
        <input type="hidden" name="menus[INDEX][id]" value="">

        <div class="shrink-0 w-full sm:w-28">
            <label class="block w-full aspect-square rounded-lg border-2 border-dashed border-gray-300 hover:border-red-500 hover:bg-red-50 transition-all cursor-pointer flex flex-col items-center justify-center text-center p-2 relative overflow-hidden">
                <input type="file" name="menus[INDEX][photo]" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(this)">
                <div class="preview-placeholder flex flex-col items-center gap-1 text-gray-400">
                    <span class="material-symbols-outlined text-2xl">add_a_photo</span>
                    <span class="text-[10px] font-medium">Foto</span>
                </div>
                <img class="preview-img absolute inset-0 w-full h-full object-cover hidden rounded-lg" />
            </label>
        </div>
        <div class="flex-1 space-y-3">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 mb-1">Nama Menu</label>
                    <input type="text" name="menus[INDEX][name]" class="w-full h-9 px-3 rounded-lg text-sm border-2 border-gray-200 dark:border-slate-600 bg-white dark:bg-slate-800 focus:border-red-500 focus:ring-0" placeholder="Menu Baru" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1">Harga</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-bold text-gray-400">Rp</span>
                        <input type="number" name="menus[INDEX][price]" class="w-full h-9 pl-8 pr-3 rounded-lg text-sm border-2 border-gray-200 dark:border-slate-600 bg-white dark:bg-slate-800 focus:border-red-500 focus:ring-0" placeholder="0" required>
                    </div>
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-500 mb-1">Deskripsi</label>
                <textarea name="menus[INDEX][description]" rows="2" class="w-full p-3 rounded-lg text-sm border-2 border-gray-200 dark:border-slate-600 bg-white dark:bg-slate-800 focus:border-red-500 focus:ring-0 resize-none" placeholder="Deskripsi menu..."></textarea>
            </div>
        </div>
        <button type="button" class="btn-remove-menu absolute -top-2 -right-2 bg-white text-red-500 p-1 rounded-full shadow-md border border-gray-200 hover:scale-110 transition-all z-20">
            <span class="material-symbols-outlined text-lg">close</span>
        </button>
    </div>
</template>

<script>
    // --------------------------------------------------------
    // A. LOGIC PREVIEW & DATA TRANSFER (FOTO BARU)
    // --------------------------------------------------------
    let dt = new DataTransfer();

    function previewGallery(input) {
        const container = document.getElementById('gallery-preview-container');
        
        for (let file of input.files) {
            if (file.type.match('image.*')) {
                dt.items.add(file);
            }
        }

        input.files = dt.files; // Sinkronisasi input form
        renderGalleryPreview();
    }

    function renderGalleryPreview() {
        const container = document.getElementById('gallery-preview-container');
        container.innerHTML = '';

        Array.from(dt.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative aspect-square rounded-xl overflow-hidden border border-gray-200 shadow-md animate-fade-in group';
                div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/20 transition-colors"></div>
                    <div class="absolute bottom-2 left-2 bg-green-500 text-white text-[10px] px-2 py-0.5 rounded shadow font-bold">New</div>
                    
                    <button type="button" onclick="removeNewFile(${index})" 
                        class="absolute top-2 right-2 bg-white text-red-500 p-1 rounded-full shadow hover:bg-red-50 transition-all cursor-pointer">
                        <span class="material-symbols-outlined text-sm block">close</span>
                    </button>
                `;
                container.appendChild(div);
            }
            reader.readAsDataURL(file);
        });
    }

    function removeNewFile(index) {
        dt.items.remove(index);
        document.getElementById('photo-upload-gallery').files = dt.files;
        renderGalleryPreview();
    }

    // --------------------------------------------------------
    // B. LOGIC MENU (SINGLE IMAGE PREVIEW)
    // --------------------------------------------------------
    function previewImage(input) {
        const parent = input.closest('label');
        const placeholder = parent.querySelector('.preview-placeholder');
        const img = parent.querySelector('.preview-img');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                img.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('menu-container');
        const btnAdd = document.getElementById('btn-add-menu');
        const menuCountBadge = document.getElementById('menu-count');
        const template = document.getElementById('menu-template');
        const emptyMsg = document.getElementById('empty-menu-msg');
        
        let menuIndex = 1;

        function updateUI() {
            const items = container.querySelectorAll('.menu-item');
            menuCountBadge.textContent = items.length + ' Item';
            
            items.forEach(item => {
                const btnRemove = item.querySelector('.btn-remove-menu');
                if (items.length > 1) {
                    btnRemove.classList.remove('hidden');
                } else {
                    btnRemove.classList.add('hidden');
                }
            });
        }

        btnAdd.addEventListener('click', function() {
            if(emptyMsg) emptyMsg.style.display = 'none';
            const clone = template.content.cloneNode(true);
            
            clone.querySelectorAll('[name*="INDEX"]').forEach(el => {
                el.name = el.name.replace('INDEX', menuIndex);
            });

            container.appendChild(clone);
            menuIndex++;
            updateUI();
        });

        container.addEventListener('click', function(e) {
            if (e.target.closest('.btn-remove-menu')) {
                const item = e.target.closest('.menu-item');
                if (container.querySelectorAll('.menu-item').length > 1) {
                    item.remove();
                    updateUI();
                }
            }
        });

        updateUI();
    });
</script>

<style>
    .animation-fade-in {
        animation: fadeIn 0.3s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection