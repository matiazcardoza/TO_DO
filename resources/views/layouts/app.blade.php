<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Estilo para el fondo */
        body {
            background-image: url('{{ asset('images/fondo.jpg') }}'); /* Cambia esta ruta a la de tu imagen */
            background-size: cover; /* Para cubrir toda la pantalla */
            background-repeat: no-repeat; /* No repetir la imagen */
            background-position: center; /* Centrar la imagen */
            min-height: 100vh; /* Asegúrate de que el body cubra toda la pantalla */
        }
    
        /* Estilos para el fondo animado */
        .bg-animated {
            position: absolute; /* Cambiar a absolute si quieres que el fondo se mueva al hacer scroll */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(270deg, rgba(167, 192, 229, 0.5), rgba(246, 213, 224, 0.5)); /* Añadir transparencia */
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
            z-index: 0; /* Asegúrate de que el fondo animado esté detrás de todo */
        }
    
        /* Navegación */
        nav {
            position: relative; /* Asegúrate de que el nav esté en una posición que permita el uso de z-index */
            z-index: 10; /* Asegúrate de que el nav esté por encima del fondo */
        }
    
        /* Animación para los elementos de la página */
        .fade-in {
            animation: fadeIn 0.6s ease-in forwards;
        }
    
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen">
        <div class="bg-animated"></div> <!-- Fondo animado -->

        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow z-10"> <!-- Agregando z-index para que esté por encima -->
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 fade-in">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="fade-in z-10 relative"> <!-- Agregar z-index para asegurarse de que el contenido esté por encima -->
            {{ $slot }}
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
