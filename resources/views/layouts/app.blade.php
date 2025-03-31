<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div x-data="{ sidebarOpen: true }">
        <!-- La sidebar se maneja con su propio Alpine.js state -->
        <livewire:auth.sidebar>
            @yield('content')
        </livewire:auth.sidebar>
    </div>
    @livewireScripts
</body>
</html>
