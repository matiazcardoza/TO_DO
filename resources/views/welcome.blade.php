<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio - Sistema de Tareas</title>
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        /* Estilo para el canvas */
        canvas {
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1; /* Asegúrate de que esté detrás de todo */
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased">
    <canvas id="backgroundCanvas"></canvas> <!-- Canvas para animación -->
    
    <div class="min-h-screen flex flex-col items-center justify-center">
        <!-- Barra de Navegación -->
        <div class="absolute top-0 right-0 px-6 py-4">
            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-lg font-semibold text-gray-700 dark:text-gray-400 hover:underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-lg font-semibold text-gray-700 dark:text-gray-400 hover:underline">Iniciar sesión</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-lg font-semibold text-gray-700 dark:text-gray-400 hover:underline">Registrarse</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <!-- Contenido principal -->
        <div class="flex flex-col items-center">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-6">Bienvenido al Sistema de Tareas</h1>
            <p class="text-lg text-gray-700 dark:text-gray-300 mb-8">
                Gestiona tus tareas de manera eficiente y organiza tu día a día.
            </p>
            <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-lg transition duration-300">
                Comienza ahora
            </a>
        </div>

        <!-- Información adicional -->
        <div class="mt-16 text-center">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Características</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Gestión de Tareas</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Organiza, filtra y clasifica tus tareas según su prioridad o estado.
                    </p>
                </div>
                <!-- Feature 2 -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Tareas Responsivas</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Accede a tus tareas desde cualquier dispositivo, en cualquier momento.
                    </p>
                </div>
                <!-- Feature 3 -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Colaboración en Tiempo Real</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Comparte tus tareas y trabaja en equipo para cumplir tus objetivos.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Configuración del canvas
        const canvas = document.getElementById("backgroundCanvas");
        const ctx = canvas.getContext("2d");
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        // Clase para las bolitas
        class Ball {
            constructor(x, y, radius, color) {
                this.x = x;
                this.y = y;
                this.radius = radius;
                this.color = color;
                this.speedY = Math.random() * 2 + 1; // Velocidad vertical
                this.speedX = Math.random() * 2 - 1; // Velocidad horizontal
            }

            update() {
                // Actualiza la posición de la bolita
                this.x += this.speedX;
                this.y += this.speedY;

                // Rebote al llegar a los bordes
                if (this.x + this.radius > canvas.width || this.x - this.radius < 0) {
                    this.speedX = -this.speedX;
                }
                if (this.y + this.radius > canvas.height || this.y - this.radius < 0) {
                    this.speedY = -this.speedY;
                }
            }

            draw() {
                ctx.fillStyle = this.color;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        // Generar bolitas
        const balls = [];
        for (let i = 0; i < 100; i++) {
            const radius = Math.random() * 10 + 5; // Radio aleatorio
            const x = Math.random() * (canvas.width - radius * 2) + radius; // Posición X aleatoria
            const y = Math.random() * (canvas.height - radius * 2) + radius; // Posición Y aleatoria
            const color = 'rgba(' + Math.floor(Math.random() * 255) + ',' + Math.floor(Math.random() * 255) + ',' + Math.floor(Math.random() * 255) + ', 0.8)';
            balls.push(new Ball(x, y, radius, color));
        }

        // Animación
        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpiar el canvas
            balls.forEach(ball => {
                ball.update();
                ball.draw();
            });
            requestAnimationFrame(animate); // Continuar animando
        }

        animate(); // Iniciar animación

        // Ajustar el tamaño del canvas al cambiar el tamaño de la ventana
        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });
    </script>
</body>
</html>
