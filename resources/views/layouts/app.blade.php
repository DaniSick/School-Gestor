<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="flex">
        <!-- La sidebar (que maneja su propia visibilidad) -->
        <livewire:auth.sidebar />
        
        <!-- Contenedor principal que se ajustará según la sidebar -->
        <main class="flex-1 min-h-screen overflow-y-auto" :class="{'with-sidebar': $store.sidebar.open}">
            @yield('content')
        </main>
    </div>
    @livewireScripts
</body>
</html>
