@extends('layouts.app')

@section('content')
    <div class="min-h-screen pt-24 pb-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">Branding Toko</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Sesuaikan logo dan banner agar toko terlihat lebih
                    profesional dan menarik.</p>
            </div>

            @if (session('success'))
                <div
                    class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl flex items-center gap-2 animate-fade-in">
                    <span class="material-symbols-outlined">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('seller.branding.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-8">

                    {{-- CARD 1: BANNER TOKO --}}
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary-orange">panorama</span>
                                Banner / Sampul Toko
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">Disarankan ukuran 1200x400px. Maksimal 5MB.</p>
                        </div>

                        <div class="p-6">
                            {{-- Preview Area Banner --}}
                            <div class="relative w-full h-48 md:h-64 bg-gray-100 dark:bg-gray-700 rounded-xl overflow-hidden border-2 border-dashed border-gray-300 dark:border-gray-600 group hover:border-primary-orange transition-all cursor-pointer"
                                onclick="document.getElementById('bannerInput').click()">

                                {{-- Image Preview --}}
                                <img id="bannerPreview"
                                    src="{{ $umkm->primaryPhoto ? asset('storage/' . $umkm->primaryPhoto->path) : 'https://via.placeholder.com/1200x400?text=Upload+Banner' }}"
                                    class="w-full h-full object-cover">

                                {{-- Overlay Upload Icon --}}
                                <div
                                    class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-all">
                                    <span class="material-symbols-outlined text-white text-4xl mb-2">cloud_upload</span>
                                    <span class="text-white font-semibold text-sm">Klik untuk ganti banner</span>
                                </div>
                            </div>

                            {{-- Hidden Input --}}
                            <input type="file" id="bannerInput" name="banner" class="hidden" accept="image/*"
                                onchange="previewImage(event, 'bannerPreview')">
                        </div>
                    </div>

                    {{-- CARD 2: LOGO TOKO --}}
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary-orange">account_circle</span>
                                Logo Toko
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">Disarankan rasio 1:1 (Persegi). Maksimal 2MB.</p>
                        </div>

                        <div class="p-6 flex flex-col md:flex-row items-center gap-8">
                            {{-- Preview Area Logo --}}
                            <div class="relative w-32 h-32 flex-shrink-0 group cursor-pointer"
                                onclick="document.getElementById('logoInput').click()">
                                <div
                                    class="w-32 h-32 rounded-full overflow-hidden border-4 border-white dark:border-gray-700 shadow-xl ring-2 ring-gray-100 dark:ring-gray-600 group-hover:ring-primary-orange transition-all">
                                    <img id="logoPreview"
                                        src="{{ $user->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($umkm->nama_usaha) }}"
                                        class="w-full h-full object-cover">
                                </div>
                                <div
                                    class="absolute inset-0 rounded-full bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all">
                                    <span class="material-symbols-outlined text-white">edit</span>
                                </div>
                            </div>

                            <div class="flex-1 text-center md:text-left">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Upload
                                        Logo Baru</label>
                                    <input type="file" id="logoInput" name="logo"
                                        class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-orange-50 file:text-primary-orange
                                    hover:file:bg-orange-100
                                    transition-all"
                                        accept="image/*" onchange="previewImage(event, 'logoPreview')">
                                </div>
                                <p class="text-xs text-gray-500">
                                    Logo ini akan muncul di samping nama toko Anda dan di halaman pencarian. Gunakan logo
                                    yang jelas dan profesional.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Action Button --}}
                    <div class="flex justify-end pt-4">
                        <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-primary-orange to-primary-green hover:shadow-lg hover:shadow-orange-500/30 text-white font-bold rounded-xl transition-all transform hover:-translate-y-1 flex items-center gap-2">
                            <span class="material-symbols-outlined">save</span>
                            Simpan Perubahan
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- Script Preview Gambar --}}
    <script>
        function previewImage(event, previewId) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
