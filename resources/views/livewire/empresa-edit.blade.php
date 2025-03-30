
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Editar Empresa</h1>

    <form wire:submit.prevent="update" class="bg-white p-6 rounded-lg shadow-md">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700">Nombre</label>
                <input type="text" wire:model="nombre" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700">Razón Social</label>
                <input type="text" wire:model="razon_social" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                @error('razon_social') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700">RFC</label>
                <input type="text" wire:model="rfc" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                @error('rfc') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700">Dirección</label>
                <input type="text" wire:model="direccion" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                @error('direccion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700">Teléfono</label>
                <input type="text" wire:model="telefono" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                @error('telefono') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700">Correo</label>
                <input type="email" wire:model="email" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700">Representante Legal</label>
                <input type="text" wire:model="representante_legal" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                @error('representante_legal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700">Fecha de Creación</label>
                <input type="date" wire:model="fecha_creacion" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                @error('fecha_creacion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Actualizar</button>
            <a href="{{ route('empresas.view') }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
        </div>
    </form>
</div>

