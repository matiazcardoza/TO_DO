<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard de Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-4">
                        {{ __('¡Bienvenido, :name!', ['name' => Auth::user()->name]) }}
                    </h1>
                    <p class="text-lg mb-6">{{ __("Estás conectado.") }}</p>
                    <a href="{{ route('users/tasks') }}" class="inline-block bg-indigo-600 text-white font-semibold py-2 px-4 rounded hover:bg-indigo-700 transition duration-200">
                        {{ __('TAREAS') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
