<div class="flex h-screen">
    <!-- Sidebar -->
    <livewire:auth.sidebar />

    <!-- Contenido principal -->
    <div class="flex-1 p-6">
        <div class="bg-gray-200 p-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Detalles del Contenedor de Pólizas</h1>
            <a href="{{ route('contenedores-polizas.view', ['empresa_id' => $contenedor->empresa_id]) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Volver</a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md mt-4">
            <h2 class="text-xl font-bold mb-4">Información General</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600">Empresa:</p>
                    <p class="font-bold">{{ $contenedor->empresa->nombre }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Tipo de Póliza:</p>
                    <p class="font-bold">{{ $contenedor->tipoPoliza->tipo }} - {{ $contenedor->tipoPoliza->descripcion }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Descripción:</p>
                    <p class="font-bold">{{ $contenedor->descripcion }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Fecha:</p>
                    <p class="font-bold">{{ $contenedor->fecha->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Estado:</p>
                    <p class="font-bold {{ $contenedor->finalizado ? 'text-green-500' : 'text-yellow-500' }}">
                        {{ $contenedor->finalizado ? 'Finalizado' : 'Borrador' }}
                    </p>
                </div>
                <div>
                    <p class="text-gray-600">Fecha de Creación:</p>
                    <p class="font-bold">{{ $contenedor->created_at->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md mt-4">
            <h2 class="text-xl font-bold mb-4">Líneas</h2>
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">Cuenta</th>
                        <th class="border border-gray-300 px-4 py-2">Descripción</th>
                        <th class="border border-gray-300 px-4 py-2">Cargo</th>
                        <th class="border border-gray-300 px-4 py-2">Abono</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lineas as $linea)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $linea->cuenta->numero }} - {{ $linea->cuenta->nombre }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $linea->descripcion }}</td>
                            <td class="border border-gray-300 px-4 py-2">${{ number_format($linea->cargo, 2) }}</td>
                            <td class="border border-gray-300 px-4 py-2">${{ number_format($linea->abono, 2) }}</td>
                        </tr>
                    @endforeach

                    <!-- Totales -->
                    <tr class="bg-gray-100">
                        <td colspan="2" class="border border-gray-300 px-4 py-2 text-right font-bold">Totales:</td>
                        <td class="border border-gray-300 px-4 py-2 font-bold">${{ number_format($contenedor->total_cargos, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2 font-bold">${{ number_format($contenedor->total_abonos, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
