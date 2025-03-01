<div class="pt-4 mx-4">
    <h2 class="text-2xl font-bold text-gray-700 mb-4">Gestión de Clientes</h2>

    @if(session('success'))
        <div id="success-message"class="bg-green-100 text-green-700 p-2 rounded mb-2">
            {{ session('success') }}
        </div>
    @endif

    <!-- Barra de búsqueda y botón -->
    <div class="flex justify-between items-center mb-4">
        {{-- <form method="GET" action="{{ route('clientes.index') }}" class="flex">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 ml-2">Buscar</button>
        </form> --}}
        <input type="text" wire:model="search" wire:keyup="cambiarValor()" name="busqueda" placeholder="Buscar cliente..." class="w-full p-2 border border-gray-300 rounded">
        <a href="{{ route('clientes.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 ml-2">+ Nuevo Cliente</a>
    </div>

    <!-- Tabla de clientes -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse bg-white rounded-lg shadow-md">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">Nombre</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Teléfono</th>
                    <th class="p-3 text-left">Dirección</th>
                    <th class="p-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clients as $cliente)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="p-3">{{ $cliente->name }}</td>
                        <td class="p-3">{{ $cliente->email }}</td>
                        @if($cliente->phone == null)
                            <td class="p-3">-</td>
                        @else
                            <td class="p-3">{{ $cliente->phone }}</td>
                        @endif
                        @if($cliente->address == null)
                            <td class="p-3">-</td>
                        @else
                            <td class="p-3">{{ $cliente->address }}</td>
                        @endif  
                        <td class="p-3 flex justify-center space-x-2">
                            <button>
                                <a href="{{ route('clientes.edit', $cliente) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Editar</a>

                            </button>
                            <form action="{{ route('clientes.delete', $cliente) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este cliente?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white mt-4 px-3 py-1 rounded hover:bg-red-600">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-3 text-center" colspan="4">No hay clientes</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <!-- Controles de paginación -->
        <div class="mt-4">
            {{ $clients->links() }}
        </div>
    </div>
</div>