<div class="sidebar bg-gray-800 text-white h-screen p-4">
    <ul>
        @foreach ($menus as $menu)
            <li class="mb-2">
                <span class="cursor-pointer font-bold">{{ $menu->nombre }}</span>
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
