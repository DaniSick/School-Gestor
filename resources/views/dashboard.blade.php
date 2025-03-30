@extends('layouts.app')

@section('content')
<div class="relative min-h-screen">
    <!-- Botón omnipresente para cerrar sesión -->
    <form method="POST" action="{{ route('logout') }}" class="absolute top-4 right-4 z-50">
        @csrf
        <button type="submit" class="bg-white text-black px-4 py-2 rounded-full hover:bg-red-600 hover:text-white transition-colors flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h13m0 0l-4-4m4 4l-4 4m5-9V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2h9a2 2 0 002-2v-2" />
            </svg>
        </button>
    </form>

    <div class="flex flex-col items-center justify-center min-h-screen">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-800">Bienvenido al Sistema de Contabilidad</h1>
            <h2 class="text-2xl font-semibold text-blue-600 mt-2">EXTRA-COUNT</h2>
        </div>

        <div class="mt-10 max-w-4xl text-gray-700">
            <p class="text-lg">
                Este sistema ha sido desarrollado por un solo ingeniero con el propósito de ofrecer una solución contable más eficiente y moderna en comparación con COI.
            </p>
            <ul class="list-disc list-inside mt-4">
                <li><strong>Eficiencia y rapidez:</strong> Optimización de procesos contables para una gestión más ágil.</li>
                <li><strong>Interfaz intuitiva:</strong> Diseñado para ser fácil de usar, permitiendo una navegación sencilla y clara.</li>
                <li><strong>Automatización y precisión:</strong> Minimiza errores y mejora la organización de la información contable.</li>
            </ul>
            <p class="mt-4">
                Este sistema busca revolucionar la manera en que las personas gestionan su contabilidad, brindando herramientas más accesibles y adaptadas a las necesidades actuales.
            </p>
        </div>
    </div>
</div>
@endsection
