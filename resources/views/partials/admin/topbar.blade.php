<header
    class="h-16 bg-white/80 backdrop-blur-md border-b border-gray-200 sticky top-0 z-20 flex items-center justify-between px-4 lg:px-8">
    <div class="flex items-center gap-4">
        <button id="openSidebar" class="md:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
            <span class="material-symbols-outlined">menu</span>
        </button>
        <h1 class="text-lg font-semibold text-gray-800 hidden sm:block">
            @yield('page-title', 'Dashboard Admin')
        </h1>
    </div>

    <div class="flex items-center gap-3">
        {{-- Search Bar --}}
        <div
            class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-gray-100 rounded-lg border border-gray-200 focus-within:border-primary-orange focus-within:ring-1 focus-within:ring-orange-200 transition-all">
            <span class="material-symbols-outlined text-gray-400 text-lg">search</span>
            <input type="text" placeholder="Cari data..."
                class="bg-transparent border-none text-sm w-48 focus:ring-0 p-0 text-gray-700 placeholder-gray-400">
        </div>

        {{-- Notifications --}}
        <button class="relative p-2 text-gray-500 hover:bg-gray-100 rounded-full transition-colors">
            <span class="material-symbols-outlined">notifications</span>
            <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
        </button>

        {{-- Profile (Desktop Only) --}}
        <div
            class="hidden md:flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">
            <div
                class="w-8 h-8 bg-primary-orange text-white rounded-full flex items-center justify-center font-semibold text-sm">
                {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
            </div>
            <span class="text-sm font-medium text-gray-700 hidden lg:block">
                {{ Auth::user()->name ?? 'Admin' }}
            </span>
        </div>
    </div>
</header>
