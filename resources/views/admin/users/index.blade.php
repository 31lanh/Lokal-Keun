@extends('layouts.admin')

@section('title', 'Data Pengguna')

@section('content')
    {{-- Header, Pencarian & Filter --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Data Pengguna</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola akun pembeli dan penjual.</p>
        </div>

        <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
            {{-- Form Filter & Search digabung dalam satu form agar query parameter tidak hilang --}}
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-col md:flex-row gap-3 w-full">
                
                {{-- Filter Role --}}
                <div class="relative min-w-[140px]">
                    <select name="role" onchange="this.form.submit()" 
                        class="w-full pl-3 pr-8 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-orange focus:border-transparent text-sm bg-white appearance-none cursor-pointer">
                        <option value="">Semua Role</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="penjual" {{ request('role') == 'penjual' ? 'selected' : '' }}>Penjual</option>
                        <option value="pembeli" {{ request('role') == 'pembeli' ? 'selected' : '' }}>Pembeli</option>
                    </select>
                </div>

                {{-- Filter Sort By --}}
                <div class="relative min-w-[160px]">
                    <select name="sort" onchange="this.form.submit()" 
                        class="w-full pl-3 pr-8 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-orange focus:border-transparent text-sm bg-white appearance-none cursor-pointer">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru Bergabung</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama Bergabung</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                    </select>
                </div>

                {{-- Search Box --}}
                <div class="relative w-full md:w-64">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <span class="material-symbols-outlined text-xl">search</span>
                    </span>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atau email..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-orange focus:border-transparent text-sm transition-all">
                </div>

                {{-- Tombol Reset Filter (Muncul jika ada filter aktif) --}}
                @if(request('q') || request('role') || request('sort'))
                    <a href="{{ route('admin.users.index') }}" 
                       class="flex items-center justify-center px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl transition-colors"
                       title="Reset Filter">
                        <span class="material-symbols-outlined text-xl">restart_alt</span>
                    </a>
                @endif

            </form>
        </div>
    </div>

    {{-- Tabel User --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4">Pengguna</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Status Email</th>
                        <th class="px-6 py-4">Bergabung</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gray-100 overflow-hidden border border-gray-200 shrink-0">
                                        <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random' }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if ($user->role == 'admin')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 border border-purple-200">
                                        Admin
                                    </span>
                                @elseif($user->role == 'penjual')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 border border-orange-200">
                                        Penjual
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                        Pembeli
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($user->email_verified_at)
                                    <span class="text-green-600 flex items-center gap-1 text-xs font-bold">
                                        <span class="material-symbols-outlined text-base">verified</span> Terverifikasi
                                    </span>
                                @else
                                    <span class="text-gray-400 flex items-center gap-1 text-xs">
                                        <span class="material-symbols-outlined text-base">hourglass_empty</span> Belum
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.');">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all shadow-sm hover:shadow-md"
                                            title="Hapus Pengguna">
                                            <span class="material-symbols-outlined text-lg">delete</span>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-gray-400 italic">Akun Anda</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center">
                                    <span class="material-symbols-outlined text-4xl mb-2 text-gray-300">search_off</span>
                                    <p class="text-base font-medium text-gray-500">Tidak ada pengguna ditemukan.</p>
                                    <p class="text-xs text-gray-400 mt-1">Coba ubah kata kunci pencarian atau filter Anda.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($users->hasPages())
            <div class="p-4 border-t border-gray-100 bg-gray-50">
                {{ $users->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection