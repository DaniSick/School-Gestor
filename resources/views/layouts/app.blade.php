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
<body class="bg-gray-100 text-gray-800 flex">
    <livewire:auth.sidebar /> <!-- Uso correcto del componente -->
    <div class="flex-1 p-6">
        @yield('content') <!-- Contenido dinámico -->
    </div>
    @livewireScripts
</body>
</html>
