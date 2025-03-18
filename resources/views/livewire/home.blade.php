@extends('app')


@section('content')
<div class="bg-gray-100">
<!-- Contenido principal -->
<main class="container mx-auto p-4">

    <!-- Sección de tarjetas superiores -->
    <section class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <!-- Tarjeta de clientes -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold mb-2">Clientes</h3>
            <p class="text-gray-700">Total de clientes: <span class="font-bold">{{$clientesCount}}</span></p>
            <a href="{{route('clientes.index')}}" class="text-blue-600 hover:underline">Ver detalles</a>
        </div>

        <!-- Tarjeta de proveedores -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold mb-2">Proveedores</h3>
            <p class="text-gray-700">Total de proveedores: <span class="font-bold">{{$proveedoresCount}}</span></p>
            <a href="{{route('proveedores.index')}}" class="text-blue-600 hover:underline">Ver detalles</a>
        </div>

        <!-- Tarjeta de ventas -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold mb-2">Ventas</h3>
            <p class="text-gray-700">Ventas este mes: <span class="font-bold">{{$totalVentasMesActual}}</span></p>
            <a href="{{route('ventas.index')}}" class="text-blue-600 hover:underline">Ver detalles</a>
        </div>

        <!-- Tarjeta de productos -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold mb-2">Productos</h3>
            <p class="text-gray-700">Total de productos: <span class="font-bold">{{$productsCount}}</span></p>
            <a href="#" class="text-blue-600 hover:underline">Ver detalles</a>
        </div>
    </section>

    <!-- Sección de tabla de ventas -->
    <section class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-2xl font-bold mb-4">Últimas Ventas</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID Venta</th>
                        <th class="py-2 px-4 border-b">Cliente</th>
                        <th class="py-2 px-4 border-b">Fecha</th>
                        <th class="py-2 px-4 border-b">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ventas as $venta)
                        <tr>
                            <td class="py-2 px-4 border-b">{{$venta->id}}</td>
                            <td class="py-2 px-4 border-b">{{$venta->client->name}}</td>
                            <td class="py-2 px-4 border-b">{{$venta->created_at}}</td>
                            <td class="py-2 px-4 border-b">{{$venta->total}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="py-2 px-4 border-b">No hay ventas registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <!-- Sección de productos -->
    <section class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Productos</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID Producto</th>
                        <th class="py-2 px-4 border-b">Nombre</th>
                        <th class="py-2 px-4 border-b">Categoría</th>
                        <th class="py-2 px-4 border-b">Stock</th>
                        <th class="py-2 px-4 border-b">Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td class="py-2 px-4 border-b">{{$product->id}}</td>
                            <td class="py-2 px-4 border-b">{{$product->name}}</td>
                            <td class="py-2 px-4 border-b">{{$product->category->category_name}}</td>
                            <td class="py-2 px-4 border-b">{{$product->stock}}</td>
                            <td class="py-2 px-4 border-b">${{$product->price}}</td>
                        </tr>
                   @empty
                        <tr>
                            <td class="py-2 px-4 border-b text-center" colspan="5">No hay productos registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

</main>

<!-- Pie de página -->
<footer class="bg-blue-600 p-4 text-white mt-6">
    <div class="container mx-auto text-center">
        <p>&copy; 2025 Sistema de Inventario. Todos los derechos reservados.</p>
    </div>
</footer>
    
</div>

@endsection
{{-- 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Barra de navegación -->
    <nav class="bg-blue-600 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Sistema de Inventario</h1>
            <ul class="flex space-x-4">
                <li><a href="#" class="hover:text-gray-300">Inicio</a></li>
                <li><a href="#" class="hover:text-gray-300">Productos</a></li>
                <li><a href="#" class="hover:text-gray-300">Categorías</a></li>
                <li><a href="#" class="hover:text-gray-300">Reportes</a></li>
                <li><a href="#" class="hover:text-gray-300">Configuración</a></li>
            </ul>
        </div>
    </nav>

    

</body>
</html> --}}