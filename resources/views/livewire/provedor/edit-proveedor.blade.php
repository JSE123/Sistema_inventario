@extends('app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md mt-4">
    <h2 class="text-2xl font-bold text-gray-700 mb-4">Editar proveedor</h2>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-2">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('proveedores.update', $proveedor->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Nombre</label>
            <input type="text" name="name" class="w-full p-2 border rounded @error('name') border-red-500 @enderror" value="{{ old('name', $proveedor->name) }}" required>
            @error('nombre') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Correo Electrónico</label>
            <input type="email" name="email" class="w-full p-2 border rounded @error('email') border-red-500 @enderror" value="{{ old('email', $proveedor->email) }}" required>
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Dirección</label>
            <input type="text" name="address" class="w-full p-2 border rounded @error('address') border-red-500 @enderror" value="{{ old('address', $proveedor->address) }}" >
            @error('direccion') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end">
            <a href="{{ route('proveedores.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded mr-2 hover:bg-gray-500">Cancelar</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Actualizar</button>
        </div>
    </form>
</div>
@endsection
