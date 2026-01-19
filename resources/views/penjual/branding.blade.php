@extends('layouts.app')

@section('content')
    <div class="min-h-screen pt-24 pb-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">Branding Toko</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Ubah identitas visual toko Anda agar lebih menarik.</p>
            </div>

            <form action="{{ route('seller.branding.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-8">

                    {{-- CARD 1: BANNER --}}
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary-orange">panorama</span>
                                    Banner / Sampul
                                </h3>
                                <p class="text-xs text-gray-500">Disarankan 1200x400px.</p>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Sisi Kiri: Banner Saat Ini --}}
                                <div>
                                    <label class="block text-xs font-bold text-gray-400 mb-2 uppercase">Banner Saat Ini</label>
                                    <div class="relative w-full h-40 bg-gray-100 rounded-xl overflow-hidden border border-gray-200">
                                        @if($umkm->photos->where('is_primary', true)->first())
                                            <img src="{{ asset(ltrim($umkm->photos->where('is_primary', true)->first()->photo_url, '/')) }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-200">
                                                <span class="text-xs">Belum ada banner</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Sisi Kanan: Preview Upload Baru --}}
                                <div>
                                    <label class="block text-xs font-bold text-primary-orange mb-2 uppercase">Banner Baru (Preview)</label>
                                    <div class="relative w-full h-40 bg-gray-50 rounded-xl overflow-hidden border-2 border-dashed border-primary-orange/50 hover:border-primary-orange cursor-pointer transition-all group"
                                         onclick="document.getElementById('bannerInput').click()">
                                        
                                        {{-- Preview Image --}}
                                        <img id="bannerPreview" class="hidden w-full h-full object-cover">
                                        
                                        {{-- Placeholder --}}
                                        <div id="bannerPlaceholder" class="absolute inset-0 flex flex-col items-center justify-center text-gray-400 group-hover:text-primary-orange transition-colors">
                                            <span class="material-symbols-outlined text-3xl mb-1">cloud_upload</span>
                                            <span class="text-xs font-medium">Klik pilih file</span>
                                        </div>
                                    </div>
                                    {{-- Tombol Batal --}}
                                    <button type="button" id="cancelBannerBtn" class="hidden mt-2 text-xs text-red-500 hover:underline flex items-center gap-1" onclick="cancelUpload('banner')">
                                        <span class="material-symbols-outlined text-sm">close</span> Batal Upload
                                    </button>
                                </div>
                            </div>
                            <input type="file" id="bannerInput" name="banner" class="hidden" accept="image/*" onchange="handleFileSelect(event, 'banner')">
                        </div>
                    </div>

                    {{-- CARD 2: LOGO --}}
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary-orange">account_circle</span>
                                    Logo Toko
                                </h3>
                                <p class="text-xs text-gray-500">Rasio 1:1 (Persegi).</p>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                                {{-- Logo Saat Ini --}}
                                <div class="flex flex-col items-center">
                                    <label class="block text-xs font-bold text-gray-400 mb-2 uppercase">Logo Saat Ini</label>
                                    <div class="w-32 h-32 rounded-full overflow-hidden border border-gray-200 shadow-sm">
                                        <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($umkm->nama_usaha) }}"
                                             class="w-full h-full object-cover">
                                    </div>
                                </div>

                                {{-- Preview Logo Baru --}}
                                <div class="flex flex-col items-center">
                                    <label class="block text-xs font-bold text-primary-orange mb-2 uppercase">Logo Baru</label>
                                    <div class="w-32 h-32 rounded-full overflow-hidden border-2 border-dashed border-primary-orange/50 hover:border-primary-orange cursor-pointer relative group bg-gray-50"
                                         onclick="document.getElementById('logoInput').click()">
                                        
                                        <img id="logoPreview" class="hidden w-full h-full object-cover absolute inset-0 z-10">
                                        
                                        <div id="logoPlaceholder" class="absolute inset-0 flex flex-col items-center justify-center text-gray-400 group-hover:text-primary-orange">
                                            <span class="material-symbols-outlined text-2xl">edit</span>
                                        </div>
                                    </div>
                                    <button type="button" id="cancelLogoBtn" class="hidden mt-2 text-xs text-red-500 hover:underline" onclick="cancelUpload('logo')">
                                        Batal
                                    </button>
                                </div>
                            </div>
                            <input type="file" id="logoInput" name="logo" class="hidden" accept="image/*" onchange="handleFileSelect(event, 'logo')">
                        </div>
                    </div>

                    {{-- TOMBOL SIMPAN --}}
                    <div class="flex justify-end pt-4">
                        <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-primary-orange to-orange-600 hover:shadow-lg hover:shadow-orange-500/30 text-white font-bold rounded-xl transition-all transform hover:-translate-y-1 flex items-center gap-2">
                            <span class="material-symbols-outlined">save</span>
                            Simpan Perubahan
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- Script untuk Preview Image & Reset --}}
    <script>
        function handleFileSelect(event, type) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Tampilkan gambar preview
                    const previewImg = document.getElementById(type + 'Preview');
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('hidden');
                    
                    // Sembunyikan placeholder text
                    const placeholder = document.getElementById(type + 'Placeholder');
                    if(placeholder) placeholder.classList.add('hidden');
                    
                    // Munculkan tombol batal
                    document.getElementById('cancel' + type.charAt(0).toUpperCase() + type.slice(1) + 'Btn').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        function cancelUpload(type) {
            // Reset input file
            document.getElementById(type + 'Input').value = '';
            
            // Sembunyikan preview img
            const previewImg = document.getElementById(type + 'Preview');
            previewImg.classList.add('hidden');
            previewImg.src = '';
            
            // Munculkan kembali placeholder
            const placeholder = document.getElementById(type + 'Placeholder');
            if(placeholder) placeholder.classList.remove('hidden');
            
            // Sembunyikan tombol batal
            document.getElementById('cancel' + type.charAt(0).toUpperCase() + type.slice(1) + 'Btn').classList.add('hidden');
        }
    </script>
@endsection