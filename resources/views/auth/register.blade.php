<x-guest-layout>
    <div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-8 shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 text-center mb-6">{{ __('Register') }}</h2>

        <form id="registerForm" method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full border-gray-300 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300 rounded-md shadow-sm" 
                              type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full border-gray-300 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300 rounded-md shadow-sm" 
                              type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full border-gray-300 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300 rounded-md shadow-sm" 
                              type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300 rounded-md shadow-sm" 
                              type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Register Button -->
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4 bg-indigo-600 hover:bg-indigo-700 text-white">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Mensaje de éxito -->
        <div id="success-message" class="hidden text-center text-green-500 mt-4">
            {{ __('Registration successful! Redirecting...') }}
        </div>
    </div>

    <!-- Script para AJAX con jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#registerForm').on('submit', function(e) {
                e.preventDefault(); // Evita el comportamiento normal del formulario

                $.ajax({
                    url: $(this).attr('action'),  // URL del formulario
                    method: 'POST',
                    data: $(this).serialize(),    // Serializa los datos del formulario
                    success: function(response) {
                        // Mostrar mensaje de éxito
                        $('#success-message').removeClass('hidden');

                        // Redirigir después de un pequeño retraso
                        setTimeout(function() {
                            window.location.href = '/dashboard'; // Redirigir a dashboard
                        }, 2000); // 2 segundos
                    },
                    error: function(xhr) {
                        // Mostrar errores
                        let errors = xhr.responseJSON.errors;
                        if (errors) {
                            alert('Error: ' + JSON.stringify(errors));
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
</x-guest-layout>
