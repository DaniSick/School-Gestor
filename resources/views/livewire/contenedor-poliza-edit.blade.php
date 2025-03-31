<div class="flex h-screen">
    <!-- Sidebar -->
    <livewire:auth.sidebar />

    <!-- Contenido principal -->
    <div class="flex-1 p-6 overflow-y-auto">
        <div class="bg-gray-200 p-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Editar Contenedor de Pólizas</h1>
            <a href="{{ route('contenedores-polizas.view', ['empresa_id' => $empresa_id]) }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Volver</a>
        </div>

        @if (session()->has('error'))
            <div class="bg-red-100 text-red-800 p-2 rounded mt-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-4">
            <!-- Formulario de datos del contenedor -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4">Datos del Contenedor</h2>
                
                <div class="mb-4">
                    <label class="block text-gray-700">Tipo de Póliza</label>
                    <select wire:model="tipo_poliza_id" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                        <option value="">Seleccione un tipo</option>
                        @foreach ($tiposPolizas as $tipoPoliza)
                            <option value="{{ $tipoPoliza->id }}">{{ $tipoPoliza->tipo }} - {{ $tipoPoliza->descripcion }}</option>
                        @endforeach
                    </select>
                    @error('tipo_poliza_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Descripción</label>
                    <input type="text" wire:model="descripcion" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                    @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Fecha</label>
                    <input type="date" wire:model="fecha" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                    @error('fecha') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Formulario para agregar líneas -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4">Agregar Línea</h2>

                <div class="mb-4">
                    <label class="block text-gray-700">Cuenta</label>
                    <select wire:model="cuenta_id" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                        <option value="">Seleccione una cuenta</option>
                        @foreach ($cuentasDisponibles as $cuenta)
                            <option value="{{ $cuenta->id }}">{{ $cuenta->numero }} - {{ $cuenta->nombre }}</option>
                        @endforeach
                    </select>
                    @error('cuenta_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Descripción</label>
                    <input type="text" wire:model="lineaDescripcion" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                    @error('lineaDescripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700">Cargo</label>
                        <input type="number" step="0.01" wire:model="cargo" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                        @error('cargo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700">Abono</label>
                        <input type="number" step="0.01" wire:model="abono" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                        @error('abono') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <button wire:click="agregarLinea" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Agregar Línea</button>
            </div>
        </div>

        <!-- Tabla de líneas -->
        <div class="bg-white p-6 rounded-lg shadow-md mt-6">
            <h2 class="text-xl font-bold mb-4">Líneas del Contenedor</h2>

            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">Cuenta</th>
                        <th class="border border-gray-300 px-4 py-2">Descripción</th>
                        <th class="border border-gray-300 px-4 py-2">Cargo</th>
                        <th class="border border-gray-300 px-4 py-2">Abono</th>
                        <th class="border border-gray-300 px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lineas as $index => $linea)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $linea['cuenta_numero'] }} - {{ $linea['cuenta_nombre'] }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <input type="text" wire:model="lineas.{{ $index }}.descripcion" class="w-full px-2 py-1 border rounded focus:outline-none focus:ring">
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <input type="number" step="0.01" wire:model="lineas.{{ $index }}.cargo" class="w-full px-2 py-1 border rounded focus:outline-none focus:ring">
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <input type="number" step="0.01" wire:model="lineas.{{ $index }}.abono" class="w-full px-2 py-1 border rounded focus:outline-none focus:ring">
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <div class="flex space-x-2">
                                    <button wire:click="actualizarLinea({{ $index }})" class="text-blue-500 hover:text-blue-700" title="Guardar cambios">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                        </svg>
                                    </button>
                                    <button wire:click="quitarLinea({{ $index }})" 
                                            class="text-red-500 hover:text-red-700" 
                                            title="Eliminar línea">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="border border-gray-300 px-4 py-2 text-center">No hay líneas agregadas</td>
                        </tr>
                    @endforelse

                    <!-- Totales -->
                    <tr class="bg-gray-100">
                        <td colspan="2" class="border border-gray-300 px-4 py-2 text-right font-bold">Totales:</td>
                        <td class="border border-gray-300 px-4 py-2 font-bold">${{ number_format($totalCargos, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2 font-bold">${{ number_format($totalAbonos, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2"></td>
                    </tr>

                    <!-- Diferencia -->
                    <tr class="{{ $totalCargos == $totalAbonos ? 'bg-green-100' : 'bg-red-100' }}">
                        <td colspan="2" class="border border-gray-300 px-4 py-2 text-right font-bold">Diferencia:</td>
                        <td colspan="2" class="border border-gray-300 px-4 py-2 text-center font-bold">
                            ${{ number_format(abs($totalCargos - $totalAbonos), 2) }}
                            @if ($totalCargos == $totalAbonos)
                                <span class="text-green-600">(Balanceado)</span>
                            @else
                                <span class="text-red-600">(Desbalanceado)</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- BOTONES DE ACCIÓN -->
        <div class="mt-8 mb-16 flex justify-center space-x-4">
            <a href="{{ route('contenedores-polizas.view', ['empresa_id' => $empresa_id]) }}" 
               class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition transform">
                Cancelar
            </a>
            
            <button 
                wire:click="actualizarContenedor" 
                class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 font-bold shadow-md transition transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
                {{ $lineas->isEmpty() || $totalCargos != $totalAbonos ? 'disabled' : '' }}
            >
                <div class="flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    ACTUALIZAR CONTENEDOR
                </div>
            </button>
        </div>
    </div>
</div>
