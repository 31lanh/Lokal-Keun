<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seller Area - LokalKeun</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100">

    @include('partials.header-seller') 

    <main class="pt-24 min-h-screen w-full">
        @yield('content')
    </main>

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