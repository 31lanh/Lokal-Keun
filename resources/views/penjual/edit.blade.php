@extends('layouts.seller')

@section('content')
<div class="relative flex min-h-screen w-full flex-col overflow-x-hidden font-display">

    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 right-10 w-72 h-72 bg-primary-orange/10 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-20 left-10 w-96 h-96 bg-primary-green/10 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
    </div>

    <div class="relative z-10 flex-1 flex justify-center pb-20 pt-6 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col max-w-[1000px] w-full gap-8">

            <div class="text-center space-y-3 pt-2">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-blue-50 dark:bg-blue-900/30 rounded-full mb-1">
                    <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                    <span class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-wider">Mode Edit</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight text-gray-900 dark:text-white">
                    Edit Profil <span class="text-primary-orange">{{ $umkm->nama_usaha }}</span>
                </h1>
                <p class="text-gray-600 dark:text-slate-400 text-base max-w-2xl mx-auto">
                    Perbarui informasi toko, menu, dan galeri foto Anda.
                </p>
            </div>

            <form action="{{ route('seller.umkm.update') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-8" id="form-edit">
                @csrf
                @method('PUT')

                @if ($errors->any())
                <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-200 px-6 py-4 rounded-xl">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="group relative bg-white dark:bg-surface-dark rounded-3xl shadow-lg border-2 border-transparent hover:border-primary-orange/20 overflow-hidden transition-all">
                    <div class="relative p-6 sm:p-8">
                        <div class="flex items-center gap-4 mb-6 pb-5 border-b border-gray-100 dark:border-gray-700">
                            <div class="p-3 bg-gradient-to-br from-primary-orange to-orange-dark rounded-2xl shadow-lg text-white">
                                <span class="material-symbols-outlined text-2xl">badge</span>
                            </div>
                            <div>
                                <h2 class="text-gray-900 dark:text-white text-2xl font-bold">Informasi Dasar</h2>
                                <p class="text-sm text-gray-500">Identitas utama usaha</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <label class="flex flex-col gap-2">
                                <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Nama Usaha <span class="text-primary-orange">*</span></span>
                                <input name="nama_usaha" value="{{ old('nama_usaha', $umkm->nama_usaha) }}" class="form-input w-full rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 h-12 px-4 focus:border-primary-orange focus:ring-0" required />
                            </label>

                            <label class="flex flex-col gap-2">
                                <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Kategori <span class="text-primary-orange">*</span></span>
                                <select name="kategori" class="form-select w-full rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 h-12 px-4 focus:border-primary-orange focus:ring-0" required>
                                    @foreach(['kuliner' => '🍜 Kuliner', 'fashion' => '👗 Fashion', 'kerajinan' => '🎨 Kerajinan', 'jasa' => '🛠️ Jasa', 'pertanian' => '🌾 Pertanian'] as $key => $label)
                                        <option value="{{ $key }}" {{ old('kategori', $umkm->kategori) == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </label>

                            <label class="flex flex-col gap-2">
                                <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Nama Pemilik <span class="text-primary-orange">*</span></span>
                                <input name="nama_pemilik" value="{{ old('nama_pemilik', $umkm->nama_pemilik) }}" class="form-input w-full rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 h-12 px-4 focus:border-primary-orange focus:ring-0" required />
                            </label>

                            <label class="flex flex-col gap-2">
                                <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Tahun Berdiri</span>
                                <input type="number" name="tahun_berdiri" value="{{ old('tahun_berdiri', $umkm->tahun_berdiri) }}" class="form-input w-full rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 h-12 px-4 focus:border-primary-orange focus:ring-0" />
                            </label>
                        </div>
                    </div>
                </div>

                <div class="group relative bg-white dark:bg-surface-dark rounded-3xl shadow-lg border-2 border-transparent hover:border-primary-green/20 overflow-hidden transition-all">
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
                            <textarea name="deskripsi" class="form-textarea w-full rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 p-4 focus:border-primary-green focus:ring-0" rows="4" minlength="50" required>{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
                            <p class="text-xs text-gray-500 text-right">Min. 50 karakter</p>
                        </label>
                    </div>
                </div>

                <div class="group relative bg-white dark:bg-surface-dark rounded-3xl shadow-lg border-2 border-transparent hover:border-primary-orange/20 overflow-hidden transition-all">
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
                                <input type="tel" name="telepon" value="{{ old('telepon', $umkm->telepon) }}" class="form-input w-full rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 h-12 px-4 focus:border-primary-orange focus:ring-0" required />
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Email</span>
                                <input type="email" name="email" value="{{ old('email', $umkm->email) }}" class="form-input w-full rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 h-12 px-4 focus:border-primary-orange focus:ring-0" />
                            </label>
                        </div>

                        <div class="mb-6">
                            <label class="flex flex-col gap-2">
                                <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Link Google Maps</span>
                                <div class="relative flex items-center">
                                    <span class="absolute left-4 text-blue-500 material-symbols-outlined text-xl">map</span>
                                    <input type="url" name="maps_link" value="{{ old('maps_link', $umkm->maps_link) }}" class="form-input w-full pl-12 rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 h-12 focus:border-blue-500 focus:ring-0" />
                                </div>
                            </label>
                        </div>

                        <label class="flex flex-col gap-2">
                            <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Alamat Lengkap <span class="text-primary-orange">*</span></span>
                            <textarea name="alamat" class="form-textarea w-full rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 p-4 focus:border-primary-orange focus:ring-0" rows="3" required>{{ old('alamat', $umkm->alamat) }}</textarea>
                        </label>
                    </div>
                </div>

                <div class="group relative bg-white dark:bg-surface-dark rounded-3xl shadow-lg border-2 border-transparent hover:border-primary-green/20 overflow-hidden transition-all">
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
                                <input type="time" name="jam_buka" value="{{ old('jam_buka', $umkm->jam_buka) }}" class="form-input w-full rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 h-12 px-4 focus:border-primary-green focus:ring-0" />
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-gray-900 dark:text-slate-200 text-sm font-bold">Tutup</span>
                                <input type="time" name="jam_tutup" value="{{ old('jam_tutup', $umkm->jam_tutup) }}" class="form-input w-full rounded-xl border-2 border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 h-12 px-4 focus:border-primary-green focus:ring-0" />
                            </label>
                        </div>
                    </div>
                </div>

                <div class="group relative bg-white dark:bg-surface-dark rounded-3xl shadow-lg border-2 border-transparent hover:border-red-500/20 overflow-hidden transition-all">
                    <div class="relative p-6 sm:p-8">
                        <div class="flex items-center justify-between mb-6 pb-5 border-b border-gray-100 dark:border-gray-700">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-gradient-to-br from-red-500 to-red-700 rounded-2xl shadow-lg text-white">
                                    <span class="material-symbols-outlined text-2xl">restaurant_menu</span>
                                </div>
                                <div>
                                    <h2 class="text-gray-900 dark:text-white text-2xl font-bold">Edit Menu</h2>
                                    <p class="text-sm text-gray-500">Kelola menu toko Anda</p>
                                </div>
                            </div>
                            <span id="menu-count" class="px-3 py-1 bg-red-50 dark:bg-red-900/20 text-red-600 rounded-full text-xs font-bold border border-red-100 dark:border-red-800">
                                {{ $umkm->menus->count() }} Item
                            </span>
                        </div>

                        <div id="menu-container" class="space-y-4">
                            @forelse($umkm->menus as $index => $menu)
                                <div class="menu-item relative flex flex-col sm:flex-row gap-4 p-4 rounded-xl border-2 border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-slate-800/50">
                                    <input type="hidden" name="menus[{{ $index }}][id]" value="{{ $menu->id }}">

                                    <div class="shrink-0 w-full sm:w-28">
                                        <label class="block w-full aspect-square rounded-lg border-2 border-dashed border-gray-300 hover:border-red-500 hover:bg-red-50 transition-all cursor-pointer flex flex-col items-center justify-center text-center p-2 relative overflow-hidden">
                                            <input type="file" name="menus[{{ $index }}][photo]" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(this)">
                                            
                                            @if($menu->photo_path)
                                                <div class="preview-placeholder hidden flex-col items-center gap-1 text-gray-400">
                                                    <span class="material-symbols-outlined text-2xl">add_a_photo</span>
                                                    <span class="text-[10px] font-medium">Foto</span>
                                                </div>
                                                <img src="{{ $menu->photo_path }}" class="preview-img absolute inset-0 w-full h-full object-cover rounded-lg" />
                                            @else
                                                <div class="preview-placeholder flex flex-col items-center gap-1 text-gray-400">
                                                    <span class="material-symbols-outlined text-2xl">add_a_photo</span>
                                                    <span class="text-[10px] font-medium">Foto</span>
                                                </div>
                                                <img class="preview-img absolute inset-0 w-full h-full object-cover hidden rounded-lg" />
                                            @endif
                                        </label>
                                    </div>

                                    <div class="flex-1 space-y-3">
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                            <div class="sm:col-span-2">
                                                <label class="block text-xs font-bold text-gray-500 mb-1">Nama Menu</label>
                                                <input type="text" name="menus[{{ $index }}][name]" value="{{ $menu->name }}" class="w-full h-9 px-3 rounded-lg text-sm border-2 border-gray-200 dark:border-slate-600 bg-white dark:bg-slate-800 focus:border-red-500 focus:ring-0" placeholder="Nasi Goreng" required>
                                            </div>
                                            <div>
                                                <label class="block text-xs font-bold text-gray-500 mb-1">Harga</label>
                                                <div class="relative">
                                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-bold text-gray-400">Rp</span>
                                                    <input type="number" name="menus[{{ $index }}][price]" value="{{ $menu->price }}" class="w-full h-9 pl-8 pr-3 rounded-lg text-sm border-2 border-gray-200 dark:border-slate-600 bg-white dark:bg-slate-800 focus:border-red-500 focus:ring-0" placeholder="15000" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-500 mb-1">Deskripsi</label>
                                            <textarea name="menus[{{ $index }}][description]" rows="2" class="w-full p-3 rounded-lg text-sm border-2 border-gray-200 dark:border-slate-600 bg-white dark:bg-slate-800 focus:border-red-500 focus:ring-0 resize-none" placeholder="Deskripsi menu...">{{ $menu->description }}</textarea>
                                        </div>
                                    </div>

                                    <button type="button" class="btn-remove-menu absolute -top-2 -right-2 bg-white text-red-500 p-1 rounded-full shadow-md border border-gray-200 hover:scale-110 transition-all z-20">
                                        <span class="material-symbols-outlined text-lg">close</span>
                                    </button>
                                </div>
                            @empty
                                <p class="text-center text-gray-400 py-4 italic" id="empty-menu-msg">Belum ada menu.</p>
                            @endforelse
                        </div>

                        <button type="button" id="btn-add-menu"
                            class="flex items-center gap-1 bg-primary-orange hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-xs font-medium transition-colors shadow-sm">
                            <span class="material-symbols-outlined text-sm">add</span> Tambah Menu
                        </button>
                    </div>
                </div>

                <div class="group relative bg-white dark:bg-surface-dark rounded-3xl shadow-lg border-2 border-transparent hover:border-primary-orange/20 overflow-hidden transition-all">
                    <div class="relative p-6 sm:p-8">
                        <div class="flex items-center gap-4 mb-6 pb-5 border-b border-gray-100 dark:border-gray-700">
                            <div class="p-3 bg-gradient-to-br from-primary-orange to-orange-dark rounded-2xl shadow-lg text-white">
                                <span class="material-symbols-outlined text-2xl">storefront</span>
                            </div>
                            <div>
                                <h2 class="text-gray-900 dark:text-white text-2xl font-bold">Galeri Foto</h2>
                                <p class="text-sm text-gray-500">Kelola foto tempat usaha</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
                            @foreach($umkm->photos as $photo)
                                <div class="relative aspect-square rounded-xl overflow-hidden border border-gray-200 group">
                                    <img src="{{ $photo->photo_url }}" class="w-full h-full object-cover">
                                    <a href="{{ route('seller.photo.delete', $photo->id) }}" 
                                       onclick="return confirm('Hapus foto ini?')"
                                       class="absolute top-2 right-2 bg-white text-red-500 p-1.5 rounded-full shadow hover:bg-red-50 transition-all opacity-0 group-hover:opacity-100">
                                        <span class="material-symbols-outlined text-lg block">delete</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex flex-col gap-4">
                            <p class="text-sm font-bold text-gray-900 dark:text-white">Tambah Foto Baru</p>
                            <input type="file" name="photos[]" multiple accept="image/*" class="hidden" id="photo-upload-gallery" onchange="previewGallery(this)">
                            <label for="photo-upload-gallery" class="border-2 border-dashed border-primary-orange/30 rounded-2xl p-10 flex flex-col items-center justify-center text-center gap-4 bg-orange-50/50 hover:bg-orange-100/50 hover:border-primary-orange transition-all cursor-pointer">
                                <div class="size-20 rounded-2xl bg-gradient-to-br from-primary-orange/20 to-orange-dark/20 flex items-center justify-center text-primary-orange shadow-lg">
                                    <span class="material-symbols-outlined text-4xl">add_a_photo</span>
                                </div>
                                <div>
                                    <p class="text-gray-900 dark:text-white font-bold text-lg">Klik untuk unggah foto</p>
                                    <p class="text-gray-500 text-sm">JPG/PNG Maks. 5MB</p>
                                </div>
                            </label>
                            <div id="gallery-preview-container" class="grid grid-cols-3 sm:grid-cols-4 gap-2 mt-2"></div>
                        </div>
                    </div>
                </div>

                <div class="sticky bottom-0 bg-white/95 dark:bg-surface-dark/95 backdrop-blur-xl p-6 -mx-4 sm:mx-0 sm:p-0 sm:bg-transparent sm:backdrop-blur-none sm:relative flex flex-col-reverse sm:flex-row justify-between items-center gap-4 border-t sm:border-t-0 border-gray-200 rounded-t-3xl sm:rounded-none shadow-2xl sm:shadow-none z-40">
                    <div class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-400">
                        <a href="{{ route('seller.dashboard') }}" class="font-bold text-gray-500 hover:text-primary-orange transition-colors">Batal & Kembali</a>
                    </div>
                    <div class="w-full sm:w-auto">
                        <button type="submit" class="w-full sm:w-auto px-10 py-3.5 bg-gradient-to-r from-primary-orange to-primary-green hover:shadow-2xl text-white font-bold rounded-xl flex items-center justify-center gap-2 transform hover:scale-105 transition-all">
                            <span class="material-symbols-outlined">save</span> Simpan Perubahan
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
    // 1. Preview Single Image
    function previewImage(input) {
        const parent = input.closest('label');
        const placeholder = parent.querySelector('.preview-placeholder');
        const img = parent.querySelector('.preview-img');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                img.classList.remove('hidden');
                if(placeholder) placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            // Reset preview jika batal pilih file
            img.src = '';
            img.classList.add('hidden');
            if(placeholder) placeholder.classList.remove('hidden');
        }
    }

    // 2. Preview Gallery
    function previewGallery(input) {
        const container = document.getElementById('gallery-preview-container');
        container.innerHTML = '';
        if (input.files) {
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative aspect-square rounded-lg overflow-hidden border border-gray-200';
                    div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                    container.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        }
    }

    // 3. Logic Tambah/Hapus Menu
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('menu-container');
        const btnAdd = document.getElementById('btn-add-menu');
        const menuCountBadge = document.getElementById('menu-count');
        const template = document.getElementById('menu-template');
        const emptyMsg = document.getElementById('empty-menu-msg');
        
        // Start index dari count menu yang ada + 100 (biar aman)
        let menuIndex = {{ $umkm->menus->count() }} + 100; 

        function updateUI() {
            const items = container.querySelectorAll('.menu-item');
            menuCountBadge.textContent = items.length + ' Item';
        }

        // Add Menu
        btnAdd.addEventListener('click', function() {
            if(emptyMsg) emptyMsg.style.display = 'none';

            // Ambil content dari template
            const clone = template.content.cloneNode(true);
            
            // Replace INDEX dengan angka unik
            clone.querySelectorAll('[name*="INDEX"]').forEach(el => {
                el.name = el.name.replace('INDEX', menuIndex);
            });

            container.appendChild(clone);
            menuIndex++;
            updateUI();
        });

        // Remove Menu
        container.addEventListener('click', function(e) {
            if (e.target.closest('.btn-remove-menu')) {
                const item = e.target.closest('.menu-item');
                item.remove();
                updateUI();
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