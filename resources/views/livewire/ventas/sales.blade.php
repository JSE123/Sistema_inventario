

<div class="pt-4 mx-4">
    @if($currentComponent == 'sales')
    <!-- Alertas -->
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-2" id="alert-message">
            {{ session('message') }}
        </div>
    @endif
    

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Ventas</h2>
        <div class="flex">

            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" wire:click="changeComponent('add-sales')">
                <i class="fas fa-plus"></i>Nueva venta
            </button>

            <!-- Dropdown de usuario -->
            <div x-data="{ open: false }" class="relative">
                <!-- Botón Avatar -->
                <button @click="open = !open" class="bg-blue-500 rounded ml-3 px-4 py-2 flex items-center space-x-2 text-black focus:outline-none">
                    {{-- <img src="https://ui-avatars.com/api/?name=Usuario" class="w-8 h-8 rounded-full"> --}}
                    <span class="hidden md:inline">Generar informes</span>
                    
                    <i class="fas fa-chevron-down"></i>
                </button>
                <!-- Contenido del Dropdown -->
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50">
                    
                    <a href="{{ route('sales.report.pdf')}}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">
                        Generar informe pdf
                    </a>
                    <a href="{{ route('reportes.ventas.excel')}}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">
                        Generar informe excel
                    </a>
                    
                </div>
            </div>

            {{-- <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                <a href="{{route('sales.report.pdf')}}" ><i class="fas fa-plus"></i>Generar informe</a>
            </button> --}}
        </div>
    </div>

    {{-- {{$sales}} --}}

    <!-- Lista de ventas -->
    <div wire:poll.keep-alive class="bg-white shadow-md rounded p-4">
        <h3 class="text-lg font-semibold mb-4">Historial de Ventas</h3>
        <table class="w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">#</th>
                    <th class="border p-2">Cliente</th>
                    <th class="border p-2">Fecha</th>
                    <th class="border p-2">Total</th>
                    <th class="border p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $sale)
                    <tr>
                        <td class="border p-2">{{$loop->iteration}}</td>
                        <td class="border p-2">{{$sale->client->name}}</td>
                        <td class="border p-2">{{$sale->created_at->format('Y-m-d')}}</td>
                        <td class="border p-2">${{ number_format($sale->total, 2) }}</td>
                        <td class="border p-2 text-center">
                            <button class="bg-blue-500 text-white px-2 py-1 rounded" wire:click="changeComponent('sales_details', {{$sale->id}})" wire:click="setSaleId('{{$sale->id}}')">Ver detalles</button>
                            {{-- <button class="bg-red-500 text-white px-2 py-1 rounded" wire:click="deleteSale('sales_details', {{$sale->id}})" wire:click="setSaleId('{{$sale->id}}')">Eliminar</button> --}}
                        </td>
                    </tr>
                @empty
                    <td class="border p-2 text-center" colspan="5">No hay ventas registradas</td>
                @endforelse    
            </tbody>
        </table>
        <!-- Controles de paginación -->
        <div class="mt-4">
            {{ $sales->links() }}
        </div>

    </div>
    @elseif($currentComponent == 'add-sales')
        @livewire('ventas.add-sale')
    @elseif($currentComponent == 'sales_details')
        <livewire:ventas.detalle-venta :saleId="$selectedSaleId" />
    @endif

</div>
