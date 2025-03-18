</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script src="https://kit.fontawesome.com/68ecc45ca7.js" crossorigin="anonymous"></script> <!-- Iconos FontAwesome -->

    @livewireStyles
</head>
<body>

    <!-- Encabezado -->
    @include('components.header')

    <div class="flex h-screen">
        @include('components.sidebar')
        <div class="flex-grow overflow-y-auto">
            @yield('content')
        </div>
        {{-- @livewire('home') --}}
    </div>

    @livewireScripts
</body>
</html>
