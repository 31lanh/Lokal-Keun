<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>LokalKeun - Dukung UMKM Lokal</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    {{-- AOS CSS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- Global CSS for Smooth Scroll --}}
    <style>
        html {
            scroll-behavior: smooth;
            /* Memberikan jarak offset agar section tidak tertutup header saat discroll */
            scroll-padding-top: 5.5rem; /* Sesuaikan dengan tinggi header (h-20 = 80px = 5rem + buffer) */
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Alpine JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body
    class="bg-background-light dark:bg-background-dark font-display text-gray-900 dark:text-gray-100 overflow-x-hidden">

    @include('partials.header')
    @include('partials.modals.profile')
    @include('partials.modals.edit-profile')
    @include('partials.modals.favorites')
    @include('partials.modals.address')
    
    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    {{-- AOS JS & Init --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({
            duration: 800,     
            once: false,        // Animasi diulang setiap scroll
            offset: 50,         
            easing: 'ease-in-out', 
            delay: 0,   
        });
    </script>

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