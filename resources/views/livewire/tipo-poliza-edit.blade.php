<div class="flex h-screen">
    <!-- Sidebar -->
    <livewire:auth.sidebar />

    <!-- Contenido principal -->
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold mb-4">Editar Tipo de Póliza</h1>

        <form wire:submit.prevent="update" class="bg-white p-6 rounded-lg shadow-md">
            <div>
                <label class="block text-gray-700">Tipo</label>
                <input type="text" wire:model="tipo" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                @error('tipo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <label class="block text-gray-700">Descripción</label>
                <textarea wire:model="descripcion" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring"></textarea>
                @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Actualizar</button>
                <a href="{{ route('tipos-polizas.view', ['empresa_id' => $empresa_id]) }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
            </div>
        </form>
    </div>
</div>
