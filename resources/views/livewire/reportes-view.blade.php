<div class="flex h-screen">
    <!-- Sidebar -->
    <livewire:auth.sidebar />

    <!-- Contenido principal -->
    <div class="flex-1 p-6">
        <!-- Pestañas para cambiar entre empresas -->
        <div class="bg-gray-200 p-4 flex space-x-4">
            @foreach ($empresas as $empresa)
                <a href="{{ route('reportes.view', ['empresa_id' => $empresa->id]) }}" 
                   class="px-4 py-2 rounded-lg {{ $empresa_id == $empresa->id ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-800' }}">
                    {{ $empresa->nombre }}
                </a>
            @endforeach
        </div>

        <div class="bg-gray-200 p-4 mt-4">
            <h1 class="text-2xl font-bold">Generación de Reportes</h1>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md mt-4">
            <form wire:submit.prevent="generarReporte">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h2 class="text-xl font-bold mb-4">Tipo de Reporte</h2>
                        <div class="space-y-2">
                            <label class="inline-flex items-center">
                                <input type="radio" wire:model="tipo_reporte" value="balanza" class="form-radio h-5 w-5 text-blue-600">
                                <span class="ml-2 text-gray-700">Balanza General</span>
                            </label>
                            <p class="text-sm text-gray-500 ml-7">Muestra el saldo de todas las cuentas con sus cargos y abonos.</p>
                            
                            <label class="inline-flex items-center mt-4">
                                <input type="radio" wire:model="tipo_reporte" value="diario" class="form-radio h-5 w-5 text-blue-600">
                                <span class="ml-2 text-gray-700">Libro Diario</span>
                            </label>
                            <p class="text-sm text-gray-500 ml-7">Muestra todas las transacciones registradas en el periodo.</p>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-xl font-bold mb-4">Periodo de Reporte</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700">Fecha Inicio</label>
                                <input type="date" wire:model="fecha_inicio" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                            </div>

                            <div>
                                <label class="block text-gray-700">Fecha Fin</label>
                                <input type="date" wire:model="fecha_fin" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Opciones específicas de Balanza General -->
                <div class="mt-6" x-data="{ showOptions: @entangle('tipo_reporte') === 'balanza' }">
                    <div x-show="showOptions">
                        <h2 class="text-xl font-bold mb-4">Opciones de Balanza</h2>
                        <label class="inline-flex items-center">
                            <input type="checkbox" wire:model="mostrar_cuentas_sin_movimientos" class="form-checkbox h-5 w-5 text-blue-600">
                            <span class="ml-2 text-gray-700">Mostrar cuentas sin movimientos</span>
                        </label>
                    </div>
                </div>

                <div class="mt-8 flex justify-center">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-bold shadow-md transition transform hover:scale-105">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            GENERAR REPORTE
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
