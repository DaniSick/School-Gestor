<div class="flex h-screen">
    <!-- Sidebar -->
    <livewire:auth.sidebar />

    <!-- Contenido principal -->
    <div class="flex-1 p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Empresas Registradas</h1>
            <a href="{{ route('empresas.create') }}" class="flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Crear
            </a>
        </div>
        @if (session()->has('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Nombre</th>
                    <th class="border border-gray-300 px-4 py-2">RFC</th>
                    <th class="border border-gray-300 px-4 py-2">Teléfono</th>
                    <th class="border border-gray-300 px-4 py-2">Correo</th>
                    <th class="border border-gray-300 px-4 py-2">Estatus</th>
                    <th class="border border-gray-300 px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empresas as $empresa)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $empresa->nombre }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $empresa->rfc }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $empresa->telefono }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $empresa->email }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $empresa->estatus ? 'Activo' : 'Inactivo' }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('empresas.edit', $empresa->id) }}" class="text-blue-500 hover:underline">📝</a>
                            <button wire:click="delete({{ $empresa->id }})" class="text-red-500 hover:underline ml-2">🗑️</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
