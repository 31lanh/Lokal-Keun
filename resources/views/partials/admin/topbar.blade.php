<header
    class="h-16 bg-white/80 backdrop-blur-md border-b border-gray-200 sticky top-0 z-20 flex items-center justify-between px-4 lg:px-8">
    <div class="flex items-center gap-4">
        <button id="openSidebar" class="md:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
            <span class="material-symbols-outlined">menu</span>
        </button>
        <h1 class="text-xl font-semibold text-gray-800 hidden sm:block">
            @yield('page-title', 'Dashboard Admin')
        </h1>
    </div>
</header>
