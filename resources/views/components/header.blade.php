<header class="flex justify-between items-center p-4 bg-gray-800 shadow ">
    <h1 class="text-lg font-bold text-white"><a href="/">Sistema de Inventario</a></h1>
    <!-- Dropdown de usuario -->
    <div x-data="{ open: false }" class="relative">
        <!-- Botón Avatar -->
        <button @click="open = !open" class="flex items-center space-x-2 text-white focus:outline-none">
            <img src="https://ui-avatars.com/api/?name=Usuario" class="w-8 h-8 rounded-full">
            @if(auth()->check())
                <span class="hidden md:inline">{{auth()->user()->name}}</span>
            @else
                <p>No has iniciado sesión.</p>
            @endif
            
            <i class="fas fa-chevron-down"></i>
        </button>
        <!-- Contenido del Dropdown -->
        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50">
            
            <a href="{{ route('profile')}}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">
                <i class="fas fa-user-circle mr-2"></i>
                Perfil
            </a>
             <!-- Formulario para Cerrar Sesión -->
            <form action="{{ route('logout') }}" method="POST" class="block px-4 py-2 text-red-600 hover:bg-red-200">
                @csrf
                @method('POST') 
                <button type="submit" class="w-full text-left">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>
</header>
