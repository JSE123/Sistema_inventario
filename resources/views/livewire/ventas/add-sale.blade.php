
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-700 mb-4">Registrar Venta</h2>

    
    <!-- Alertas -->
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-2" id="alert-message">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-2" id="alert-error">
            {{ session('error') }}
        </div>
    @endif  

    <!-- Cliente y Fecha -->
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-gray-700 font-semibold">Cliente:</label>

            <!-- Mostrar Cliente Seleccionado -->
            @if ($clienteSeleccionado)
                <div class="p-2 bg-gray-100 rounded">
                    Cliente seleccionado: <strong>{{ $clienteSeleccionado['name'] }}</strong>
                </div>
                <button wire:click="resetCliente" class="text-red-500 underline text-sm">Cambiar Cliente</button>
            @else
                <input type="text" class="w-full p-2 border rounded" wire:model="clienteBusqueda" wire:input="buscarCliente" placeholder="Buscar cliente...">
                @if (!empty($clients))
                    <div class="bg-white border rounded mt-1 max-h-40 overflow-y-auto">
                        @foreach ($clients as $cliente)
                            <div wire:click="seleccionarCliente({{ $cliente->id }})" class="p-2 cursor-pointer hover:bg-gray-200">
                                {{ $cliente->name }}
                            </div>
                        @endforeach
                    </div>
                @endif
                <button wire:click="agregarNuevoCliente" class="mt-2 text-blue-500 underline">
                    <a href="{{route('clientes.create')}}">Registrar nuevo cliente</a>
                </button>
            @endif
            {{-- <input type="text" class="w-full p-2 border rounded" wire:model="clienteBusqueda"  wire:input="buscarCliente" placeholder="Buscar cliente...">
            @if (!empty($clients))
                <div class="bg-white border rounded mt-1 max-h-40 overflow-y-auto">
                    @foreach ($clients as $cliente)
                        <div wire:click="seleccionarCliente('{{ $cliente->id }}')" class="p-2 cursor-pointer hover:bg-gray-200">{{ $cliente->name }}</div>
                    @endforeach
                </div>
            @endif --}}
            {{-- <button wire:click="agregarNuevoCliente" class="mt-2 text-blue-500 underline">
                
                <a href="{{route('clientes.create')}}">Registrar nuevo cliente</a>
            </button> --}}
        </div>
        <div>
            <label class="block text-gray-700 font-semibold">Fecha:</label>
            <input type="date" class="w-full p-2 border rounded" wire:model="fecha">
        </div>
    </div>

    <!-- Agregar Productos -->
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold">Producto:</label>
        <input type="text" class="w-full p-2 border rounded" wire:model="productoBusqueda" wire:input="buscarProducto" placeholder="Buscar producto...">
        @if (!empty($products))
            <div class="bg-white border rounded mt-1 max-h-40 overflow-y-auto">
                @foreach ($products as $producto)
                    <div wire:click="seleccionarProducto({{ $producto->id }})" class="p-2 cursor-pointer hover:bg-gray-200">
                        {{ $producto->name }}
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Cantidad y Botón Agregar -->
    <div class="flex space-x-2 mb-4">
        <input type="number" placeholder="Cantidad" class="p-2 border rounded w-20" wire:model="cantidad" min="1" oninput="validity.valid||(value='');">
        <button type="button" wire:click="agregarProducto" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Agregar</button>
    </div>

    <!-- Tabla de Productos Agregados -->
    <div class="overflow-x-auto mb-4">
        <table class="w-full border-collapse bg-white rounded-lg shadow-md">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">Producto</th>
                    <th class="p-3 text-center">Cantidad</th>
                    <th class="p-3 text-center">Precio</th>
                    <th class="p-3 text-center">Total</th>
                    <th class="p-3 text-center">Acción</th>
                </tr>
            </thead>
            <tbody>
                @if(empty($carrito))
                    <tr>
                        <td class="p-3 text-center" colspan="5">No hay productos agregados</td>
                    </tr>
                @else
                    @foreach ($carrito as $index => $producto)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="p-3">{{ $producto['name'] }}</td>
                            <td class="p-3 text-center">{{ $producto['cantidad'] }}</td>
                            <td class="p-3 text-center">${{ $producto['price'] }}</td>
                            <td class="p-3 text-center">${{ $producto['price']*$producto['cantidad'] }}</td>
                            <td class="p-3 text-center">
                                <button wire:click="eliminarProducto({{ $index }})" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">X</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <!-- Total de Venta -->
    <div class="text-right text-xl font-bold text-gray-700 mb-4">
        Total: ${{ array_sum(array_column($carrito, 'total')) }}
    </div>
 <!-- Botón de Registrar -->
 <button  wire:click="registrarVenta" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 w-full">
    <a href="">
        Registrar Venta
    </a>
</button>

</div>