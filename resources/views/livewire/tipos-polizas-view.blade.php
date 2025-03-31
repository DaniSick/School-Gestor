<div class="flex h-screen">
    <!-- Sidebar -->
    <livewire:auth.sidebar />

    <!-- Contenido principal -->
    <div class="flex-1 p-6">
        <!-- Pestañas para cambiar entre empresas -->
        <div class="bg-gray-200 p-4 flex space-x-4">
            @foreach ($empresas as $empresa)
                <a href="{{ route('tipos-polizas.view', ['empresa_id' => $empresa->id]) }}" 
                   class="px-4 py-2 rounded-lg {{ $empresa_id == $empresa->id ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-800' }}">
                    {{ $empresa->nombre }}
                </a>
            @endforeach

            @if (is_numeric($empresa_id))
                <a href="{{ route('tipos-polizas.create', ['empresa_id' => $empresa_id]) }}" class="flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Crear
                </a>
            @endif
        </div>

        <div class="bg-gray-200 p-4 mt-4">
            <h1 class="text-2xl font-bold">Tipos de Pólizas</h1>
        </div>

        @if (session()->has('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-auto w-full border-collapse border border-gray-300 mt-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Tipo</th>
                    <th class="border border-gray-300 px-4 py-2">Descripción</th>
                    <th class="border border-gray-300 px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tiposPolizas as $tipoPoliza)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $tipoPoliza->tipo }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $tipoPoliza->descripcion }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('tipos-polizas.edit', ['id' => $tipoPoliza->id]) }}" class="text-blue-500 hover:underline">📝</a>
                            <button wire:click="delete({{ $tipoPoliza->id }})" class="text-red-500 hover:underline ml-2">🗑️</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
