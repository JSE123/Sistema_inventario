
<div class="pt-4">
        @if(session('success'))
            <div class="bg-green-500 text-white p-2 rounded-md mb-4 " id="success-message">
                {{ session('success') }}
            </div>
        @endif
        
        
        <div class="max-w-7xl mx-auto bg-white shadow-md rounded-lg p-6">
            <!-- Encabezado -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-700">Gestión de Productos</h2>
                <a href="{{route('products.create')}}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    <i class="fas fa-plus"></i> Agregar Producto
                </a>
            </div>
            
            <!-- Barra de búsqueda -->
            <div class="mb-4">
                <input type="text" wire:model="search" wire:keyup="cambiarValor()" placeholder="Buscar producto..." class="w-full p-2 border border-gray-300 rounded">
            </div>
            
            <!-- Tabla de Productos -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse bg-white rounded-lg shadow-md">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-3 text-left">#</th>
                            <th class="p-3 text-left">Nombre</th>
                            <th class="p-3 text-left">Categoría</th>
                            <th class="p-3 text-left">Stock</th>
                            <th class="p-3 text-left">Precio</th>
                            <th class="p-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="p-3">{{$loop->iteration}}</td>
                            <td class="p-3">{{$product->name}}</td>
                            <td class="p-3">{{$product->category->category_name}}</td>
                            {{-- <td class="p-3">
                                {{ $product->stock < $product->stock_min ? 'text-red-600 font-bold' : 'text-black' }}">
                                {{$product->stock}}
                            </td> --}}
                            <td class="px-4 py-2 border text-center 
                                {{ $product->stock < $product->stock_min ? 'text-red-600 font-bold' : 'text-black' }}">
                                {{ $product->stock }}
                            </td>
                            <td class="p-3">${{$product->price}}</td>
                            <td class="p-3 flex justify-center space-x-2">
                                <button class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                    <a href="{{ route('products.edit', $product->id) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </button>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                {{-- <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    <i class="fas fa-trash"></i>
                                </button> --}}
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td class="p-3 text-center" colspan="6">No hay productos registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
   
</div>  