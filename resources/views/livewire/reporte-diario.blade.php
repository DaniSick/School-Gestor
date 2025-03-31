<div class="flex h-screen">
    <!-- Sidebar -->
    <livewire:auth.sidebar />

    <!-- Contenido principal -->
    <div class="flex-1 p-6 overflow-y-auto">
        <div class="bg-gray-200 p-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Libro Diario</h1>
            <div class="flex space-x-4">
                <button wire:click="descargarPDF" wire:loading.attr="disabled" class="flex items-center bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 disabled:opacity-50">
                    <div wire:loading wire:target="descargarPDF" class="mr-2">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                    <div wire:loading.remove wire:target="descargarPDF">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                        </svg>
                    </div>
                    Descargar PDF
                </button>
                <a href="{{ route('reportes.view', ['empresa_id' => $empresa_id]) }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Volver</a>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md mt-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <h2 class="text-xl font-semibold">{{ $empresa->nombre }}</h2>
                    <p class="text-gray-600">RFC: {{ $empresa->rfc }}</p>
                </div>
                <div class="text-right">
                    <p class="text-gray-600">Periodo: {{ \Carbon\Carbon::parse($fecha_inicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($fecha_fin)->format('d/m/Y') }}</p>
                    <p class="text-gray-600">Fecha de generación: {{ now()->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>

            <div class="space-y-8">
                @php
                    $totalCargos = 0;
                    $totalAbonos = 0;
                @endphp
                
                @if(count($contenedores) > 0)
                    @foreach ($contenedores as $contenedor)
                        @php
                            $totalCargos += $contenedor->total_cargos;
                            $totalAbonos += $contenedor->total_abonos;
                        @endphp
                        
                        <div class="border rounded-lg overflow-hidden">
                            <div class="p-4 bg-gray-100">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h3 class="font-bold">{{ $contenedor->tipoPoliza->tipo }} - {{ $contenedor->descripcion }}</h3>
                                        <p class="text-gray-600">Fecha: {{ $contenedor->fecha->format('d/m/Y') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-bold">
                                            #{{ $contenedor->id }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="border-b border-gray-300 px-4 py-2 text-left">Cuenta</th>
                                        <th class="border-b border-gray-300 px-4 py-2 text-left">Descripción</th>
                                        <th class="border-b border-gray-300 px-4 py-2 text-right">Cargo</th>
                                        <th class="border-b border-gray-300 px-4 py-2 text-right">Abono</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contenedor->lineasPolizas as $linea)
                                        <tr>
                                            <td class="border-b border-gray-300 px-4 py-2">
                                                {{ $linea->cuenta->numero }} - {{ $linea->cuenta->nombre }}
                                            </td>
                                            <td class="border-b border-gray-300 px-4 py-2">
                                                {{ $linea->descripcion }}
                                            </td>
                                            <td class="border-b border-gray-300 px-4 py-2 text-right">
                                                @if($linea->cargo > 0)
                                                    ${{ number_format($linea->cargo, 2) }}
                                                @endif
                                            </td>
                                            <td class="border-b border-gray-300 px-4 py-2 text-right">
                                                @if($linea->abono > 0)
                                                    ${{ number_format($linea->abono, 2) }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                    <!-- Subtotales por contenedor -->
                                    <tr class="bg-gray-50">
                                        <td colspan="2" class="border-b border-gray-300 px-4 py-2 text-right font-bold">Subtotales:</td>
                                        <td class="border-b border-gray-300 px-4 py-2 text-right font-bold">${{ number_format($contenedor->total_cargos, 2) }}</td>
                                        <td class="border-b border-gray-300 px-4 py-2 text-right font-bold">${{ number_format($contenedor->total_abonos, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                    
                    <!-- Totales generales -->
                    <div class="p-4 bg-blue-50 rounded-lg">
                        <div class="flex justify-between items-center">
                            <h3 class="font-bold text-blue-800">TOTALES GENERALES</h3>
                            <div class="flex space-x-8">
                                <div>
                                    <span class="font-bold">Cargos:</span>
                                    <span class="ml-2">${{ number_format($totalCargos, 2) }}</span>
                                </div>
                                <div>
                                    <span class="font-bold">Abonos:</span>
                                    <span class="ml-2">${{ number_format($totalAbonos, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-gray-400 mb-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="text-xl font-medium text-gray-500">No hay transacciones en el período seleccionado</h3>
                        <p class="text-gray-500 mt-2">Intenta seleccionar un rango de fechas diferente o verifica que existan contenedores de pólizas finalizados.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
