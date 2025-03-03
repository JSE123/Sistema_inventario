<div>
    <!-- Contenedor Principal -->
    <div class="min-h-screen flex flex-col">
        
        <!-- Header -->
        <header class="bg-blue-600 text-white p-4 shadow-md">
            <h1 class="text-2xl font-bold text-center">Dashboard de Compras y Cotizaciones</h1>
        </header>

        <!-- Contenido -->
        <div class="container mx-auto p-6">
            
            <!-- Resumen de Compras y Cotizaciones -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-gray-700">Total de Cotizaciones</h2>
                    <p class="text-3xl font-bold text-blue-500">12</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-gray-700">Cotizaciones Pendientes</h2>
                    <p class="text-3xl font-bold text-yellow-500">5</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-gray-700">Compras Completadas</h2>
                    <p class="text-3xl font-bold text-green-500">8</p>
                </div>
            </div>

            <!-- Sección de Cotizaciones Pendientes -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Cotizaciones Pendientes</h2>
                    {{-- <h2 class="text-2xl font-bold text-gray-700">Gestión de Productos</h2> --}}
                    <a href="{{route('compras.create')}}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        <i class="fas fa-plus"></i> Crear Cotizacion
                    </a>
                </div>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-3 text-left">#</th>
                            <th class="border p-3 text-left">Proveedor</th>
                            <th class="border p-3 text-left">Total</th>
                            <th class="border p-3 text-left">Estado</th>
                            <th class="border p-3 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border">
                            <td class="p-3">1</td>
                            <td class="p-3">Proveedor A</td>
                            <td class="p-3">$1,500.00</td>
                            <td class="p-3 text-yellow-500">Pendiente</td>
                            <td class="p-3 flex space-x-2">
                                <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">✔ Aprobar</button>
                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">✖ Rechazar</button>
                            </td>
                        </tr>
                        <tr class="border">
                            <td class="p-3">2</td>
                            <td class="p-3">Proveedor B</td>
                            <td class="p-3">$850.00</td>
                            <td class="p-3 text-yellow-500">Pendiente</td>
                            <td class="p-3 flex space-x-2">
                                <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">✔ Aprobar</button>
                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">✖ Rechazar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Sección de Compras Recientes -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Últimas Compras</h2>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-3 text-left">#</th>
                            <th class="border p-3 text-left">Proveedor</th>
                            <th class="border p-3 text-left">Total</th>
                            <th class="border p-3 text-left">Estado</th>
                            <th class="border p-3 text-left">Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border">
                            <td class="p-3">1</td>
                            <td class="p-3">Proveedor C</td>
                            <td class="p-3">$2,400.00</td>
                            <td class="p-3 text-green-500">Completada</td>
                            <td class="p-3">
                                <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Ver</button>
                            </td>
                        </tr>
                        <tr class="border">
                            <td class="p-3">2</td>
                            <td class="p-3">Proveedor D</td>
                            <td class="p-3">$1,200.00</td>
                            <td class="p-3 text-green-500">Completada</td>
                            <td class="p-3">
                                <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Ver</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
