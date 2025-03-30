<div x-data="{ open: true }" class="relative">
    <!-- Sidebar -->
    <div :class="open ? 'block' : 'hidden'" 
         class="sidebar bg-[#0d1b2a] text-gray-800 overflow-y-auto resize-x overflow-x-hidden md:min-w-[12rem] md:max-w-[20rem] min-w-[8rem] max-w-[20rem] h-full">
        <button @click="open = false" class="bg-[#0d1b2a] text-white px-2 py-1 rounded-full focus:outline-none mb-4">
            ←
        </button>
        <h2 class="text-xl font-bold text-white mb-4 text-center uppercase">Menú</h2> <!-- Título centrado y en mayúsculas -->
        <ul>
            @foreach ($menus as $menu)
                <li class="mb-2">
                    <span class="cursor-pointer font-bold text-white">{{ $menu->nombre }}</span>
                    @if ($menu->children->isNotEmpty())
                        <ul class="ml-4">
                            @foreach ($menu->children as $child)
                                <li class="mt-1">
                                    <a href="{{ $child->ruta }}" class="text-blue-400 hover:underline">{{ $child->nombre }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Botón flotante para mostrar la sidebar cuando está oculta -->
    <button 
        x-show="!open" 
        @click="open = true" 
        class="fixed top-4 left-4 bg-[#0d1b2a] text-white px-3 py-2 rounded-full focus:outline-none z-50">
        → 
    </button>
</div>
