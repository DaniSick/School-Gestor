@foreach ($children as $child)
    <div class="bg-[#0d1b2a] text-white p-4 rounded-lg shadow-md w-full ml-{{ $level * 4 }} mt-2 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-bold">{{ $child->numero }} - {{ $child->nombre }}</h2>
        </div>
        <div class="flex space-x-4">
            <a href="{{ route('cuentas.edit', ['id' => $child->id]) }}" class="text-blue-400 hover:underline">📝 Editar</a>
            <button wire:click="delete({{ $child->id }})" class="text-red-400 hover:underline">🗑️ Eliminar</button>
        </div>
    </div>
    @if ($child->children->isNotEmpty())
        <div class="mt-4">
            @include('livewire.partials.cuentas-children', ['children' => $child->children, 'level' => $level + 1])
        </div>
    @endif
@endforeach
