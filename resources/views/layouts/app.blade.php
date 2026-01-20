<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>LokalKeun - Dukung UMKM Lokal</title>

    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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

</body>

</html>
