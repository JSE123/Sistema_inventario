

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
        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" wire:click="changeComponent('add-sales')">
                <i class="fas fa-plus"></i>Nueva Venta
        </button>
    </div>

    {{-- {{$sales}} --}}

    <!-- Lista de ventas -->
    <div class="bg-white shadow-md rounded p-4">
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
                @if($sales)
                    @foreach($sales as $sale)
                        <tr>
                            <td class="border p-2">1</td>
                            <td class="border p-2">{{$sale->client->name}}</td>
                            <td class="border p-2"></td>
                            <td class="border p-2">${{ number_format($sale->total, 2) }}</td>
                            <td class="border p-2 text-center">
                                <button class="bg-blue-500 text-white px-2 py-1 rounded" wire:click="changeComponent('sales_details', {{$sale->id}})" wire:click="setSaleId('{{$sale->id}}')">Ver</button>
                                <button class="bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <td class="border p-2 text-center" colspan="5">No hay ventas registradas</td>
                @endif    
            </tbody>
        </table>
    </div>
    @elseif($currentComponent == 'add-sales')
        @livewire('ventas.add-sale')
    @elseif($currentComponent == 'sales_details')
        {{-- @livewire('ventas.detalle-venta', ['saleId' => $saleId]) --}}
        <livewire:ventas.detalle-venta :saleId="$selectedSaleId" />
    @endif

</div>
