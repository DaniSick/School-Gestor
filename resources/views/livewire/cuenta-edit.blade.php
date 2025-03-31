<div class="flex h-screen">
    <!-- Sidebar -->
    <livewire:auth.sidebar />

    <!-- Contenido principal -->
    <div class="flex-1 p-6">
        <div class="bg-gray-200 p-4">
            <h1 class="text-2xl font-bold">Editar Cuenta</h1>
        </div>

        <form wire:submit.prevent="update" class="bg-white p-6 rounded-lg shadow-md mt-4">
            <div>
                <label class="block text-gray-700">Empresa</label>
                <select wire:model="empresa_id" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring" disabled>
                    <option value="">Selecciona una empresa</option>
                    @foreach (\App\Models\Empresa::all() as $empresa)
                        <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                    @endforeach
                </select>
                @error('empresa_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-gray-700">Número</label>
                    <input type="text" wire:model="numero" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                    @error('numero') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700">Nombre</label>
                    <input type="text" wire:model="nombre" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                    @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-gray-700">Tipo</label>
                    <select wire:model="tipo" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                        <option value="">Selecciona un tipo</option>
                        <option value="acumulativa">Acumulativa</option>
                        <option value="detalle">Detalle</option>
                    </select>
                    @error('tipo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700">Cuenta Padre (Opcional)</label>
                    <select wire:model="parent_id" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                        <option value="">Sin cuenta padre</option>
                        @foreach (\App\Models\Cuenta::where('empresa_id', $empresa_id)->whereNull('parent_id')->where('id', '!=', $cuentaId)->get() as $cuenta)
                            <option value="{{ $cuenta->id }}">{{ $cuenta->numero }} - {{ $cuenta->nombre }}</option>
                        @endforeach
                    </select>
                    @error('parent_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Actualizar</button>
                <a href="{{ route('cuentas.view', ['empresa_id' => $empresa_id]) }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
            </div>
        </form>
    </div>
</div>
