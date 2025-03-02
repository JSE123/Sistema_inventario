@extends('app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md mt-4">
    <h2 class="text-2xl font-bold text-gray-700 mb-4">Editar proveedor</h2>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-2">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('product.update', $product->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Nombre</label>
            <input type="text" name="name" class="w-full p-2 border rounded @error('name') border-red-500 @enderror" value="{{ old('name', $product->name) }}" required>
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Descripción</label>
            <textarea name="description" id="description" class="w-full p-2 border rounded @error('description') border-red-500 @enderror" value="{{ old('description', $product->description) }}">{{$product->description}}</textarea>
            {{-- <input type="text" name="description" class="w-full p-2 border rounded @error('description') border-red-500 @enderror" value="{{ old('description', $product->description) }}"> --}}
            @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Precio</label>
            <input type="number" name="price" class="w-full p-2 border rounded @error('price') border-red-500 @enderror" value="{{ old('price', $product->price) }}" required>
            @error('price') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Costo</label>
            <input type="number" name="costo" class="w-full p-2 border rounded @error('costo') border-red-500 @enderror" value="{{ old('costo', $product->costo) }}" required>
            @error('costo') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Stock Minimo</label>
            <input type="number" name="stock_min" class="w-full p-2 border rounded @error('stock_min') border-red-500 @enderror" value="{{ old('stock_min', $product->stock_min) }}" >
            @error('stock_min') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end">
            <a href="{{ route('productos.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded mr-2 hover:bg-gray-500">Cancelar</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Actualizar</button>
        </div>
    </form>
</div>
@endsection