<div class="flex h-screen">
    <!-- Sidebar - Volviendo a la versión original sin posicionamiento fijo -->
    <livewire:auth.sidebar />

    <!-- Contenido principal - Sin el margin-left adicional -->
    <div class="flex-1 p-6">
        <!-- Pestañas para cambiar entre empresas -->
        <div class="bg-gray-200 p-4 flex space-x-4">
            @foreach ($empresas as $empresa)
                <a href="{{ route('contenedores-polizas.view', ['empresa_id' => $empresa->id]) }}" 
                   class="px-4 py-2 rounded-lg {{ $empresa_id == $empresa->id ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-800' }}">
                    {{ $empresa->nombre }}
                </a>
            @endforeach

            @if (is_numeric($empresa_id))
                <a href="{{ route('contenedores-polizas.create', ['empresa_id' => $empresa_id]) }}" class="flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Crear
                </a>
            @endif
        </div>

        <div class="bg-gray-200 p-4 mt-4">
            <h1 class="text-2xl font-bold">Contenedores de Pólizas</h1>
        </div>

        @if (session()->has('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <table class="table-auto w-full border-collapse border border-gray-300 mt-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Fecha</th>
                    <th class="border border-gray-300 px-4 py-2">Tipo</th>
                    <th class="border border-gray-300 px-4 py-2">Descripción</th>
                    <th class="border border-gray-300 px-4 py-2">Total Cargos</th>
                    <th class="border border-gray-300 px-4 py-2">Total Abonos</th>
                    <th class="border border-gray-300 px-4 py-2">Estado</th>
                    <th class="border border-gray-300 px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contenedores as $contenedor)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $contenedor->fecha->format('d/m/Y') }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $contenedor->tipoPoliza->tipo }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $contenedor->descripcion }}</td>
                        <td class="border border-gray-300 px-4 py-2">${{ number_format($contenedor->total_cargos, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2">${{ number_format($contenedor->total_abonos, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <span class="{{ $contenedor->finalizado ? 'text-green-500' : 'text-yellow-500' }}">
                                {{ $contenedor->finalizado ? 'Finalizado' : 'Borrador' }}
                            </span>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <div class="flex space-x-2 justify-center">
                                <a href="{{ route('contenedores-polizas.view-details', ['id' => $contenedor->id]) }}" 
                                   class="text-blue-500 hover:text-blue-700" title="Ver detalles">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <a href="{{ route('contenedores-polizas.edit', ['id' => $contenedor->id]) }}" 
                                   class="text-green-500 hover:text-green-700" title="Editar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <button wire:click="delete({{ $contenedor->id }})" 
                                        class="text-red-500 hover:text-red-700" title="Eliminar"
                                        onclick="return confirm('¿Está seguro de eliminar este contenedor de pólizas?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
