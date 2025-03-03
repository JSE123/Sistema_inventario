<div class="text-white">

    <!-- Sidebar con Alpine.js -->
    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false"
    class="h-screen bg-gray-800 transition-all duration-300"
    :class="open ? 'w-48' : 'w-16'">
    
    <ul class=" space-y-2">
        <li class="flex items-center space-x-4 p-3 hover:bg-gray-700 cursor-pointer">
            <i class="fas fa-home text-xl"></i>
            <span x-show="open" class="transition-opacity duration-300 opacity-100">Inicio</span>
        </li>
        <li class="flex items-center space-x-4 p-3 hover:bg-gray-700 cursor-pointer">
            <a href="{{ route('productos.index') }}" class="flex items-center space-x-4 w-full">
                <i class="fas fa-chart-bar text-xl"></i>
                <span x-show="open" class="transition-opacity duration-300 opacity-100">Productos</span>
            </a>
        </li>
        <li class="flex items-center space-x-4 p-3 hover:bg-gray-700 cursor-pointer">
            <i class="fas fa-box text-xl"></i>
            <span x-show="open" class="transition-opacity duration-300 opacity-100">Inventario</span>
        </li>
        <li class="flex items-center space-x-4 p-3 hover:bg-gray-700 cursor-pointer">
            <a href="{{ route('ventas.index') }}" class="flex items-center space-x-4 w-full">
                <i class="fas fa-chart-bar text-xl"></i>
                <span x-show="open" class="transition-opacity duration-300 opacity-100">Ventas</span>
            </a>
        </li>
        <li class="flex items-center space-x-4 p-3 hover:bg-gray-700 cursor-pointer">
            <a href="{{route('clientes.index')}}" class="flex items-center space-x-4 w-full">
                <i class="fa-solid fa-users"></i>
                <span x-show="open" class="transition-opacity duration-300 opacity-100">Clientes</span>
            </a>
        </li>
        <li class="flex items-center space-x-4 p-3 hover:bg-gray-700 cursor-pointer">
            {{-- <i class="fas fa-cog text-xl"></i> --}}
            
            <a href="{{route('proveedores.index')}}" class="flex items-center space-x-4 w-full">
                <i class="fa-solid fa-truck"></i>
                <span x-show="open" class="transition-opacity duration-300 opacity-100">Proveedores</span>
            </a>
        </li>
        <li class="flex items-center space-x-4 p-3 hover:bg-gray-700 cursor-pointer">
            <a href="{{route('compras.index')}}" class="flex items-center space-x-4 w-full">
                <i class="fa-solid fa-store"></i>
                <span x-show="open" class="transition-opacity duration-300 opacity-100">Compras</span>
            </a>
        </li>
        <li class="flex items-center space-x-4 p-3 hover:bg-gray-700 cursor-pointer">
            <i class="fas fa-cog text-xl"></i>
            <span x-show="open" class="transition-opacity duration-300 opacity-100">Configuración</span>
        </li>
    </ul>

    </div>
</div>


