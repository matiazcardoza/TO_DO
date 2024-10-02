<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agregar Tarea') }} <!-- Título de la sección para agregar una nueva tarea -->
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-semibold">Crear Nueva Tarea</h1>
                        <!-- Enlace para cancelar y regresar a la lista de tareas -->
                        <a href="{{ route('users/tasks') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded transition duration-200">Cancelar</a>
                    </div>
                    <hr/>

                    <!-- Mensaje de error si existe -->
                    @if (session()->has('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        <strong class="font-bold">{{ session('error') }}</strong>
                    </div>
                    @endif
                    
                    <!-- Formulario para agregar una nueva tarea -->
                    <form action="{{ route('users/tasks/save') }}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- Protección CSRF para evitar ataques -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                            <!-- Campo de texto para el título de la tarea -->
                            <input type="text" name="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Título de la tarea" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                            <!-- Área de texto para la descripción de la tarea -->
                            <textarea name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Descripción de la tarea" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
                            <!-- Selector para el estado de la tarea -->
                            <select name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="pendiente">Pendiente</option>
                                <option value="completada">Completada</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha Límite</label>
                            <!-- Campo de entrada para la fecha y hora límite de la tarea -->
                            <input type="datetime-local" name="due_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prioridad</label>
                            <!-- Selector para la prioridad de la tarea -->
                            <select name="priority" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="alta">Alta</option>
                                <option value="media" selected>Media</option>
                                <option value="baja">Baja</option>
                            </select>
                        </div>

                        <!-- Botón para enviar el formulario -->
                        <div class="mb-4">
                            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded transition duration-200">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
