<x-guest-layout>
    <div class="max-w-md mx-auto p-8 shadow-lg rounded-lg bg-white dark:bg-gray-800">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 text-center mb-6">{{ __('Iniciar Sesión') }}</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Formulario de Inicio de Sesión -->
        <form id="loginForm" method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Correo Electrónico')" />
                <x-text-input id="email" class="block mt-1 w-full border-gray-300 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300 rounded-md shadow-sm" 
                              type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Contraseña')" />
                <x-text-input id="password" class="block mt-1 w-full border-gray-300 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300 rounded-md shadow-sm" 
                              type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Recordarme') }}</span>
                </label>
            </div>

            <!-- Forgot Password -->
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif

                <x-primary-button class="ml-3 bg-indigo-600 hover:bg-indigo-700 text-white">
                    {{ __('Iniciar sesión') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Mensaje de error -->
        <div id="error-message" class="hidden text-center text-red-500 mt-4">
            {{ __('Error: Credenciales incorrectas.') }}
        </div>

        <!-- Mensaje de éxito -->
        <div id="success-message" class="hidden text-center text-green-500 mt-4">
            {{ __('Inicio de sesión exitoso! Redirigiendo...') }}
        </div>
    </div>

    <!-- Script para AJAX con jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault(); // Evitar que se recargue la página

                $.ajax({
                    url: $(this).attr('action'),  // URL del formulario
                    method: 'POST',
                    data: $(this).serialize(),    // Serializar datos del formulario
                    success: function(response) {
                        // Si el inicio de sesión es exitoso
                        $('#success-message').removeClass('hidden');  // Mostrar mensaje de éxito
                        $('#error-message').addClass('hidden');      // Ocultar mensaje de error

                        // Redirigir después de un pequeño retraso
                        setTimeout(function() {
                            window.location.href = '/dashboard';  // Redirigir al dashboard
                        }, 2000);  // 2 segundos
                    },
                    error: function(xhr) {
                        // Si ocurre un error
                        $('#error-message').removeClass('hidden');  // Mostrar mensaje de error
                        $('#success-message').addClass('hidden');  // Ocultar mensaje de éxito
                    }
                });
            });
        });
    </script>
</x-guest-layout>
