<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Empresas Registradas</h1>
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
