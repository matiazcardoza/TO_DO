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
    </style>
    @livewireStyles
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }} <!-- Aquí se incluirá el contenido del login -->
        </div>
    </div>
    @livewireScripts
</body>
</html>
