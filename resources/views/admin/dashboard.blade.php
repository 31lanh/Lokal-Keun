@extends('layouts.admin')

@section('content')
    {{-- HEADER SECTION --}}
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang, Admin! 👋</h1>
                <p class="text-gray-500 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
            <div class="hidden md:flex items-center gap-3">
                <div
                    class="bg-gradient-to-br from-orange-500 to-red-500 text-white px-6 py-3 rounded-xl shadow-lg shadow-orange-200">
                    <p class="text-xs opacity-90 font-medium">Status Sistem</p>
                    <p class="text-lg font-bold flex items-center gap-2">
                        <span class="w-2 h-2 bg-green-300 rounded-full animate-pulse"></span>
                        Aktif
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- STATS CARDS WITH GRADIENT & ICONS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Total UMKM --}}
        <div
            class="group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:border-blue-200 transition-all duration-300 relative overflow-hidden">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full -mr-16 -mt-16 group-hover:scale-110 transition-transform">
            </div>
            <div class="relative">
                <div class="flex items-center justify-between mb-3">
                    <div
                        class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Total</span>
                </div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">Total UMKM</p>
                <h3 class="text-4xl font-extrabold text-gray-900">{{ $totalUmkm }}</h3>
                <p class="text-xs text-gray-500 mt-2">Terdaftar di platform</p>
            </div>
        </div>

        {{-- Menunggu Validasi --}}
        <div
            class="group bg-gradient-to-br from-orange-50 to-red-50 p-6 rounded-2xl shadow-sm border border-orange-200 hover:shadow-xl hover:border-orange-300 transition-all duration-300 relative overflow-hidden">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-orange-100 rounded-full -mr-16 -mt-16 opacity-50 group-hover:scale-110 transition-transform">
            </div>
            <div class="relative">
                <div class="flex items-center justify-between mb-3">
                    <div
                        class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    @if ($pendingUmkm > 0)
                        <span class="flex h-3 w-3">
                            <span
                                class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-orange-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-orange-500"></span>
                        </span>
                    @endif
                </div>
                <p class="text-xs font-bold text-orange-600 uppercase tracking-wide mb-2">Menunggu Validasi</p>
                <h3 class="text-4xl font-extrabold text-orange-700">{{ $pendingUmkm }}</h3>
                <p class="text-xs text-orange-600 mt-2 font-medium">Perlu persetujuan Anda</p>
            </div>
        </div>

        {{-- Total Pembeli --}}
        <div
            class="group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:border-green-200 transition-all duration-300 relative overflow-hidden">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-green-50 rounded-full -mr-16 -mt-16 group-hover:scale-110 transition-transform">
            </div>
            <div class="relative">
                <div class="flex items-center justify-between mb-3">
                    <div
                        class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-green-600 bg-green-50 px-3 py-1 rounded-full">Aktif</span>
                </div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">Total Pembeli</p>
                <h3 class="text-4xl font-extrabold text-gray-900">{{ $totalUser }}</h3>
                <p class="text-xs text-gray-500 mt-2">Pengguna terdaftar</p>
            </div>
        </div>

        {{-- Total Penjual --}}
        <div
            class="group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:border-purple-200 transition-all duration-300 relative overflow-hidden">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-purple-50 rounded-full -mr-16 -mt-16 group-hover:scale-110 transition-transform">
            </div>
            <div class="relative">
                <div class="flex items-center justify-between mb-3">
                    <div
                        class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-3 py-1 rounded-full">Verified</span>
                </div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">Total Penjual</p>
                <h3 class="text-4xl font-extrabold text-gray-900">{{ $totalSeller }}</h3>
                <p class="text-xs text-gray-500 mt-2">Mitra aktif</p>
            </div>
        </div>
    </div>

    {{-- PENDING APPROVAL LIST WITH ENHANCED DESIGN --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h3 class="font-bold text-gray-900 text-lg flex items-center gap-2">
                        <span class="w-1 h-6 bg-orange-500 rounded-full"></span>
                        Pendaftaran Terbaru (Butuh Validasi)
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">Review dan setujui pendaftaran UMKM baru</p>
                </div>
                <a href="{{ route('admin.umkm.index') }}"
                    class="inline-flex items-center gap-2 text-sm text-orange-600 font-bold hover:text-orange-700 hover:gap-3 transition-all group">
                    Lihat Semua
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Usaha
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Pemilik
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Kategori
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Tanggal
                            Daftar</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($latestUmkms as $umkm)
                        <tr class="hover:bg-orange-50/30 transition-all duration-200 group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-orange-400 to-red-500 rounded-lg flex items-center justify-center text-white font-bold shadow-sm">
                                        {{ strtoupper(substr($umkm->nama_usaha, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p
                                            class="font-semibold text-gray-900 group-hover:text-orange-600 transition-colors">
                                            {{ $umkm->nama_usaha }}</p>
                                        <p class="text-xs text-gray-500">ID: #{{ $umkm->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="text-gray-700">{{ $umkm->nama_pemilik }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-full text-xs font-medium text-blue-700">
                                    {{ $umkm->kategori }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $umkm->created_at->diffForHumans() }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <form action="{{ route('admin.umkm.approve', $umkm->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="inline-flex items-center gap-2 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white px-4 py-2 rounded-lg text-xs font-bold transition-all duration-200 shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Terima
                                        </button>
                                    </form>
                                    <a href="#"
                                        class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-xs font-bold transition-all duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16">
                                <div class="text-center">
                                    <div
                                        class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 font-medium mb-1">Tidak ada pendaftaran baru</p>
                                    <p class="text-sm text-gray-400">Semua pendaftaran telah diproses</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
