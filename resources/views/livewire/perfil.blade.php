@extends('app')

@section('title', 'Inicio')

@section('content')
@if(session('success'))
    <div id="success-message" class="bg-green-500 text-white mx-2 p-4 rounded-lg mb-4">
        {{ session('success') }}
    </div>
@endif
<div>

    
    <!-- Contenedor principal -->
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
        <!-- Título -->
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-6">Edición de Perfil</h2>
        
        <!-- Formulario de edición de perfil -->
        {{-- <form action="{{route('update_profile')}}" method="POST"> --}}
        <form action="" method="POST">
            @csrf
            @method('POST') 
            <div class="grid grid-cols-2 sm:grid-cols-2 gap-6">

                <!-- Nombre del usuario -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Nombre de usuario</label>
                    <input type="text" id="name" name="name" value="{{auth()->user()->name}}" class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:ring-indigo-500" required>
                </div>

                <!-- Nombre de usuario -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Nombre de usuario</label>
                    <input type="text" id="username" name="username" value="{{auth()->user()->username}}" class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:ring-indigo-500" required>
                </div>
                
                <!-- Correo electrónico -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Correo electrónico</label>
                    <input type="email" id="email" name="email" value="{{auth()->user()->email}}" class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:ring-indigo-500" required>
                </div>

                <!-- Contraseña -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Nueva contraseña</label>
                    <input type="password" id="password" name="password" class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:ring-indigo-500">
                </div>
                <!-- Contraseña confirmation -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Repite la nueva contraseña</label>
                    <input type="password" id="password" name="password_confirmation" class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:ring-indigo-500">
                </div>

                <!-- Botón de guardar -->
                <div class="col-span-2 flex justify-end">
                    <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-indigo-700 dark:hover:bg-indigo-800 dark:focus:ring-indigo-600">Guardar Cambios</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Sección de sesiones activas -->
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-6">Sesiones Activas</h2>

        <!-- Tabla de sesiones -->
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-sm text-gray-600 dark:text-gray-300">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                        <th class="px-4 py-2 text-left">Dispositivo</th>
                        <th class="px-4 py-2 text-left">Ubicación</th>
                        <th class="px-4 py-2 text-left">Última actividad</th>
                        <th class="px-4 py-2 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t border-gray-200 dark:border-gray-600">
                        <td class="px-4 py-2">iPhone 12</td>
                        <td class="px-4 py-2">Madrid, España</td>
                        <td class="px-4 py-2">Hace 2 horas</td>
                        <td class="px-4 py-2">
                            <button class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-500">Cerrar sesión</button>
                        </td>
                    </tr>
                    <tr class="border-t border-gray-200 dark:border-gray-600">
                        <td class="px-4 py-2">PC de escritorio</td>
                        <td class="px-4 py-2">Barcelona, España</td>
                        <td class="px-4 py-2">Hace 1 día</td>
                        <td class="px-4 py-2">
                            <button class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-500">Cerrar sesión</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection