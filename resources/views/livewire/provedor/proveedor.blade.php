
<div class="pt-4 mx-4">
    <h2 class="text-2xl font-bold text-gray-700 mb-4">Gestión de proveedores</h2>

    @if(session('success'))
        <div id="success-message"class="bg-green-100 text-green-700 p-2 rounded mb-2">
            {{ session('success') }}
        </div>
    @endif

    <!-- Barra de búsqueda y botón -->
    <div class="flex justify-between items-center mb-4">
        {{-- <form method="GET" action="" class="flex">
            {{-- <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 ml-2">Buscar</button> 
        </form> --}}
        <input type="text" wire:model.debounce.300ms="search" wire:keyup="cambiarValor" name="search" placeholder="Buscar proveedor..." class="w-full p-2 border border-gray-300 rounded">
        {{-- <button class="bg-blue-500 text-white mx-2 px-4 py-2 rounded" wire:click="cambiarValor()">Buscar</button> --}}
        <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 ml-2"> 
            <a href="{{ route('proveedores.create') }}">+ Nuevo proveedor</a>
        </button>
        
    </div>
    {{-- <input type="text"> --}}

    
    <!-- Tabla de proveedores-->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse bg-white rounded-lg shadow-md">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border p-2">#</th>
                    <th class="p-3 text-left">Nombre</th>
                    <th class="p-3 text-left">Contacto</th>
                    <th class="p-3 text-left">Dirección</th>
                    <th class="p-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- @if($proveedores) --}}


                    {{-- @foreach ($proveedores as $proveedor) --}}
                    @forelse($proveedores as $proveedor)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="border p-2">{{ $loop->iteration }}</td>
                        <td class="p-3">{{ $proveedor->name }}</td>
                        <td class="p-3">{{ $proveedor->email }}</td>
                        <td class="p-3">{{ $proveedor->address }}</td>
                        <td class="p-3 flex justify-center space-x-2">
                            <button>
                                <a href="{{ route('proveedores.edit', $proveedor) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Editar</a>
                                
                            </button>
                            <form action="{{ route('proveedores.delete', $proveedor) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este proveedor?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white mt-4 px-3 py-1 rounded hover:bg-red-600">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-3 text-center" colspan="4">No hay proveedores</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <!-- Controles de paginación -->
        <div class="mt-4">
            {{ $proveedores->links() }}
        </div>
    </div>
</div>