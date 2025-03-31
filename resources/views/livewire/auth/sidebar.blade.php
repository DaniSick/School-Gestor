<div x-data="{ open: true }" class="h-full">
    <!-- Sidebar -->
    <div :class="open ? 'w-64' : 'w-0'" 
         class="fixed left-0 top-0 h-screen bg-[#0d1b2a] text-white overflow-y-auto transition-all duration-300 z-40">
        <div class="p-4 h-full flex flex-col">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold uppercase">Menú</h2>
                <button @click="open = false" class="text-white p-2 rounded-full hover:bg-gray-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <ul class="overflow-y-auto flex-grow">
                @foreach ($menus as $menu)
                    <li class="mb-2" x-data="{ expanded: false }">
                        <div @click="expanded = !expanded" 
                             @mouseenter="expanded = true" 
                             class="cursor-pointer font-bold p-2 rounded hover:bg-gray-700 flex items-center justify-between">
                            <span>{{ $menu->nombre }}</span>
                            @if ($menu->children->isNotEmpty())
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                     :class="expanded ? 'transform rotate-90' : ''" 
                                     class="h-4 w-4 transition-transform duration-300" 
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            @endif
                        </div>
                        @if ($menu->children->isNotEmpty())
                            <ul 
                                x-show="expanded" 
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform -translate-y-2"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 transform translate-y-0"
                                x-transition:leave-end="opacity-0 transform -translate-y-2"
                                @mouseleave="expanded = false"
                                class="ml-4">
                                @foreach ($menu->children as $child)
                                    <li class="mt-1">
                                        <a href="{{ $child->ruta }}" class="text-blue-400 hover:text-blue-300 block py-1 px-2 rounded hover:bg-gray-700 transition duration-150">{{ $child->nombre }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Botón para mostrar la sidebar cuando está oculta -->
    <button 
        x-show="!open" 
        @click="open = true" 
        class="fixed top-4 left-4 bg-[#0d1b2a] text-white p-2 rounded-lg focus:outline-none z-50 hover:bg-gray-700 shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
    
    <!-- Contenido principal con margen cuando la sidebar está abierta -->
    <div :class="open ? 'ml-64' : 'ml-0'" class="transition-all duration-300">
        {{ $slot ?? '' }}
    </div>
</div>
