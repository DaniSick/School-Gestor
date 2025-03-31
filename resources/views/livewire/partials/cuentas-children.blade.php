@foreach ($children as $child)
    <div class="bg-[#0d1b2a] text-white p-4 rounded-lg shadow-md w-full ml-{{ $level * 4 }} mt-2 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-bold">{{ $child->numero }} - {{ $child->nombre }}</h2>
        </div>
        <div class="flex space-x-4">
            <a href="{{ route('cuentas.edit', ['id' => $child->id]) }}" class="text-green-400 hover:text-green-300" title="Editar">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </a>
            <button wire:click="delete({{ $child->id }})" 
                    class="text-red-400 hover:text-red-300" 
                    title="Eliminar"
                    onclick="return confirm('¿Está seguro de eliminar esta cuenta?')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
        </div>
    </div>
    @if ($child->children->isNotEmpty())
        <div class="mt-4">
            @include('livewire.partials.cuentas-children', ['children' => $child->children, 'level' => $level + 1])
        </div>
    @endif
@endforeach
