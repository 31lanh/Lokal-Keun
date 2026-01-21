<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') - LokalKeun</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    @stack('styles')
</head>

<body class="bg-gray-50 font-sans antialiased">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        @include('partials.admin.sidebar')

        {{-- Overlay Mobile --}}
        @include('partials.admin.overlay')

        {{-- Main Content Wrapper --}}
        <div class="flex-1 flex flex-col min-h-screen md:pl-64 transition-all duration-300">

            {{-- Topbar --}}
            @include('partials.admin.topbar')

            {{-- Main Content --}}
            <main class="flex-1 p-6 lg:p-8 overflow-x-hidden">
                {{-- Alerts --}}
                @if (session('success'))
                    <div
                        class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-200 flex items-center gap-3 shadow-sm animate-fade-in">
                        <span class="material-symbols-outlined">check_circle</span>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div
                        class="mb-6 p-4 bg-red-50 text-red-700 rounded-xl border border-red-200 flex items-center gap-3 shadow-sm animate-fade-in">
                        <span class="material-symbols-outlined">error</span>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                {{-- Page Content --}}
                @yield('content')
            </main>

            {{-- Footer --}}
            @include('partials.admin.footer')
        </div>

    </div>

    {{-- Scripts --}}
    @include('partials.admin.scripts')
    @stack('scripts')

    {{-- Global Loading Overlay --}}
    <div id="loading-overlay" class="fixed inset-0 z-50 flex items-center justify-center bg-white/10 backdrop-blur-md hidden transition-opacity duration-300">
        <div class="w-16 h-16 border-[6px] border-gray-200/20 border-t-primary-orange border-b-primary-green rounded-full animate-spin"></div>
    </div>

    <script>
        // Tampilkan loading overlay saat halaman akan di-refresh atau navigasi (Global)
        window.addEventListener('beforeunload', function() {
            const overlay = document.getElementById('loading-overlay');
            if (overlay) overlay.classList.remove('hidden');
        });
    </script>

</body>

</html>
