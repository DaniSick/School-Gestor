<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-800">Bienvenido al Sistema de Contabilidad</h1>
            <h2 class="text-2xl font-semibold text-blue-600 mt-2">EXTRA-COUNT</h2>
            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </div>
</body>
</html>
