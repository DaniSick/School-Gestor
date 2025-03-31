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
            @if (request()->route('empresa_id') && \App\Models\Empresa::find(request()->route('empresa_id')))
                <a href="{{ route('cuentas.create', ['empresa_id' => request()->route('empresa_id')]) }}" class="flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Crear
                </a>
            @endif
        </div>

        <div class="bg-gray-200 p-4 mt-4">
            <h1 class="text-2xl font-bold">Cuentas</h1>
        </div>

        <div class="mt-4 space-y-4">
            @foreach ($cuentas as $cuenta)
                <div class="bg-[#0d1b2a] text-white p-4 rounded-lg shadow-md w-full flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold">{{ $cuenta->numero }} - {{ $cuenta->nombre }}</h2>
                        <!-- Tipo eliminado -->
                    </div>
                    <div class="flex space-x-4">
                        <a href="{{ route('cuentas.edit', ['id' => $cuenta->id]) }}" class="text-blue-400 hover:underline">📝 Editar</a>
                        <button wire:click="delete({{ $cuenta->id }})" class="text-red-400 hover:underline">🗑️ Eliminar</button>
                    </div>
                </div>
                @if ($cuenta->children->isNotEmpty())
                    <div class="mt-4">
                        @include('livewire.partials.cuentas-children', ['children' => $cuenta->children, 'level' => 1])
                    </div>
                @endif
            @endforeach
        </div>

        @if (session()->has('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mt-4">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>
