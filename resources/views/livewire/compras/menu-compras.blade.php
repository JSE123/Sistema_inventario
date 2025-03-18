<div class="pt-4 mx-4">
    @if($componente == 'agregarCompras')
        @livewire('compras.create-purshase')
    @elseif($componente == 'menu-compras')
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
        <!-- Contenedor Principal -->
        <div class="min-h-screen flex flex-col">
            
            <!-- Contenido -->
            <div class="container mx-auto p-6">
    
                <!-- Sección de Compras Recientes -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Compras</h2>
                        <button wire:click="cambiarComponente('agregarCompras')" class="bg-green-500 text-white py-3 px-5 rounded hover:bg-green-600">Agregar nueva compra</button>
                    </div>
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border p-3 text-left">#</th>
                                <th class="border p-3 text-left">Proveedor</th>
                                <th class="border p-3 text-left">Total</th>
                                <th class="border p-3 text-left">Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($compras as $compra)
                                <tr class="border">
                                    <td class="p-3">{{$loop->iteration}}</td>
                                    <td class="p-3">{{$compra->supplier->name}}</td>
                                    <td class="p-3">${{number_format($compra->total, 2)}}</td>
                                    <td class="p-3">
                                        {{-- <a href="" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Ver</a> --}}
                                        <button class="bg-blue-500 text-white px-2 py-1 rounded" wire:click="cambiarComponente('detallesCompras', {{$compra->id}})">Ver detalles</button>

                                    </td>
                                </tr>
                            @empty 
                                <tr class="border">
                                    <td class="p-3" colspan="5">No hay compras registradas</td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                    <!-- Controles de paginación -->
                    <div class="mt-4">
                        {{ $compras->links() }}
                    </div>
                </div>
    
            </div>
        </div>
    @elseif($componente == 'detallesCompras')
        <livewire:compras.detalle-compras :compraId="$compraId" />
    @endif
</div>
