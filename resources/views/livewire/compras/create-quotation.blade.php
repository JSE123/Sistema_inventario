@extends('app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-700 mb-4">Crear Cotización</h2>

    <form method="POST" action="">
        @csrf

        <!-- Seleccionar Proveedor -->
        <label class="block text-gray-700 font-semibold">Proveedor:</label>
        <select name="supplier_id" class="w-full p-2 border rounded">
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
            @endforeach
        </select>

        <!-- Seleccionar Productos -->
        <div class="mt-4">
            <label class="block text-gray-700 font-semibold">Productos:</label>
            <div>
                @foreach ($products as $product)
                    <div class="flex items-center space-x-2 mt-2">
                        <input type="checkbox" name="products[{{ $product->id }}][id]" value="{{ $product->id }}">
                        <span>{{ $product->name }} - ${{ $product->price }}</span>
                        <input type="number" name="products[{{ $product->id }}][quantity]" min="1" placeholder="Cantidad" class="p-2 border rounded w-20">
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Botón para Enviar -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mt-4">
            Enviar Cotización
        </button>
    </form>
</div>
@endsection

