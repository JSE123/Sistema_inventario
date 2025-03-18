
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-700 mb-4">Registrar compra de productos</h2>

    
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
            <label class="block text-gray-700 font-semibold">Proveedor:</label>

            <!-- Mostrar Cliente Seleccionado -->
            @if ($proveedorSeleccionado)
                <div class="p-2 bg-gray-100 rounded">
                    Proveedor seleccionado: <strong>{{ $proveedorSeleccionado['name'] }}</strong>
                </div>
                <button wire:click="resetCliente" class="text-red-500 underline text-sm">Cambiar Proveedor</button>
            @else
                <input type="text" class="w-full p-2 border rounded" wire:model="proveedorBusqueda" wire:input="buscarProveedor" placeholder="Buscar proveedor...">
                @if (!empty($proveedores))
                    <div class="bg-white border rounded mt-1 max-h-40 overflow-y-auto">
                        @foreach ($proveedores as $proveedor)
                            <div wire:click="seleccionarProveedor({{ $proveedor->id }})" class="p-2 cursor-pointer hover:bg-gray-200">
                                {{ $proveedor->name }}
                            </div>
                        @endforeach
                    </div>
                @endif
                <button wire:click="" class="mt-2 text-blue-500 underline">
                    <a href="{{route('proveedores.create')}}">Registrar nuevo proveedor</a>
                </button>
            @endif
        </div>
        <div>
            <label class="block text-gray-700 font-semibold">Fecha:</label>
            <input type="date" class="w-full p-2 border rounded" wire:model="fecha">
        </div>
    </div>

    <!-- Agregar Productos -->
    <div class="mb-4">

        @if($productoSeleccionado)
            <label class="block text-gray-700 font-semibold">Producto:</label>

            <div class="p-2 bg-gray-100 rounded">
                Producto seleccionado: <strong>{{ $productoSeleccionado['name'] }}</strong>
            </div>
            <button wire:click="resetProduct" class="text-red-500 underline text-sm">Cambiar Producto</button>
        @else
            <label class="block text-gray-700 font-semibold">Producto:</label>
            <input type="text" class="w-full p-2 border rounded" wire:model="productoBusqueda" wire:input="buscarProducto" placeholder="Buscar producto...">
            @if (!empty($products))
                <div class="bg-white border rounded mt-1 max-h-40 overflow-y-auto">
                    @forelse ($products as $producto)
                        <div wire:click="seleccionarProducto({{ $producto->id }})" class="p-2 cursor-pointer hover:bg-gray-200">
                            {{ $producto->name }}
                        </div>
                    @empty
                        <div class="p-2 text-center">No se encontraron productos</div>
                    @endforelse
                    {{-- @foreach ($products as $producto)
                        <div wire:click="seleccionarProducto({{ $producto->id }})" class="p-2 cursor-pointer hover:bg-gray-200">
                            {{ $producto->name }}
                        </div>
                    @endforeach --}}
                </div>
            @endif
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
                @forelse ($cart as $index => $producto)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="p-3">{{ $producto['name'] }}</td>
                        <td class="p-3 text-center">{{ $producto['cantidad'] }}</td>
                        <td class="p-3 text-center">${{ $producto['price'] }}</td>
                        <td class="p-3 text-center">${{ $producto['price']*$producto['cantidad'] }}</td>
                        <td class="p-3 text-center">
                            <button wire:click="eliminarProducto({{ $index }})" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">X</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-3 text-center" colspan="5">No hay productos agregados</td>
                    </tr>

                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Total de Venta -->
    <div class="text-right text-xl font-bold text-gray-700 mb-4">
        Total: ${{ array_sum(array_column($cart, 'total')) }}
    </div>
 <!-- Botón de Registrar -->
 <button  wire:click="store" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 w-full">
    <a href="">
        Registrar Compra
    </a>
</button>

</div>