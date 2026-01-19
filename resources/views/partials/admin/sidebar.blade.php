{{-- ============================================
     FILE 2: resources/views/partials/admin/sidebar.blade.php
     ============================================ --}}
<aside id="sidebar"
    class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-200 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col">

    {{-- Header Sidebar --}}
    <div class="h-16 flex items-center justify-between px-6 border-b border-gray-200 shrink-0">
        <span class="text-2xl font-bold gradient-text">
            LokalKeun
            <span class="text-gray-700 text-sm ml-1">Admin</span>
        </span>
        <button id="closeSidebar" class="md:hidden material-symbols-outlined text-gray-500">close</button>
    </div>

    {{-- Menu Navigasi --}}
    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Menu Utama</p>

        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-orange-50 text-primary-orange' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <span class="material-symbols-outlined text-xl">dashboard</span>
            Dashboard
        </a>

        <a href="{{ route('admin.umkm.index') }}"
            class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('admin.umkm.*') ? 'bg-orange-50 text-primary-orange' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <span class="material-symbols-outlined text-xl">store</span>
            Validasi UMKM
            @if (isset($pendingCount) && $pendingCount > 0)
                <span class="ml-auto bg-red-500 text-white text-[10px] px-2 py-0.5 rounded-full font-bold">
                    {{ $pendingCount }}
                </span>
            @endif
        </a>

        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-6 mb-2">Lainnya</p>

        <a href="{{ route('admin.users.index') }}"
            class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('admin.users.*') ? 'bg-orange-50 text-primary-orange' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <span class="material-symbols-outlined text-xl">group</span>
            Data Pengguna
        </a>
    </nav>

    {{-- Footer Sidebar --}}
    <div class="p-4 border-t border-gray-200 bg-white shrink-0">
        <div class="flex items-center gap-3 mb-3 px-2">
            <div
                class="w-10 h-10 bg-primary-orange text-white rounded-full flex items-center justify-center font-bold shadow-sm">
                {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
            </div>
            <div class="min-w-0 overflow-hidden">
                <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                <p class="text-xs text-gray-500 truncate">Administrator</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center justify-center gap-2 w-full px-4 py-2 text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">
                <span class="material-symbols-outlined text-lg">logout</span>
                Keluar
            </button>
        </form>
    </div>
</aside>
