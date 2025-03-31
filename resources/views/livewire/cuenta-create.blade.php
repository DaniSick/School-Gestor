<div class="flex h-screen">
    <!-- Sidebar -->
    <livewire:auth.sidebar />

    <!-- Contenido principal -->
    <div class="flex-1 p-6">
        <!-- Pestañas para cambiar entre empresas -->
        <div class="bg-gray-200 p-4 flex space-x-4">
            @foreach (\App\Models\Empresa::all() as $empresa)
                <a href="{{ route('cuentas.view', ['empresa_id' => $empresa->id]) }}" 
                   class="px-4 py-2 rounded-lg {{ request()->route('empresa_id') == $empresa->id ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-800' }}">
                    {{ $empresa->nombre }}
                </a>
            @endforeach
        </div>

        <div class="bg-gray-200 p-4 mt-4">
            <h1 class="text-2xl font-bold">Crear Cuenta</h1>
        </div>

        <form wire:submit.prevent="save" class="bg-white p-6 rounded-lg shadow-md">
            <div>
                <label class="block text-gray-700">Empresa</label>
                <select wire:model="empresa_id" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                    <option value="">Selecciona una empresa</option>
                    @foreach (\App\Models\Empresa::doesntHave('cuentas')->get() as $empresa)
                        <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                    @endforeach
                </select>
                @error('empresa_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Crear</button>
                <a href="{{ route('cuentas.view', ['empresa_id' => $empresa_id]) }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
            </div>
        </form>
    </div>
</div>
