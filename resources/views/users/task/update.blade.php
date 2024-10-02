<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Editar') }} <!-- Título de la página de edición -->
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-semibold">Editar Tarea</h1>
                        <!-- Botón para cancelar la edición y volver a la lista de tareas -->
                        <a href="{{ route('users/tasks') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded transition duration-200">Cancelar</a>
                    </div>
                    <hr/>
                    
                    <!-- Formulario para editar la tarea -->
                    <form action="{{ route('users/tasks/update', $tasks->id) }}" method="POST">
                        @csrf <!-- Protección CSRF -->
                        @method('PUT') <!-- Método PUT para la actualización -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                            <!-- Campo de entrada para el título de la tarea -->
                            <input type="text" name="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Título de la tarea" value="{{ $tasks->title }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                            <!-- Campo de entrada para la descripción de la tarea -->
                            <input name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Descripción de la tarea" value="{{ $tasks->description }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
                            <!-- Selector para el estado de la tarea -->
                            <select name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="pendiente" {{ $tasks->status == 'pendiente' ? 'selected' : ''}}>Pendiente</option>
                                <option value="completada" {{ $tasks->status == 'completada' ? 'selected' : ''}}>Completada</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha Límite</label>
                            <!-- Campo de entrada para la fecha y hora límite de la tarea -->
                            <input type="datetime-local" name="due_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $tasks->due_date }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prioridad</label>
                            <!-- Selector para la prioridad de la tarea -->
                            <select name="priority" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="alta" {{ $tasks->priority == 'alta' ? 'selected' : '' }}>Alta</option>
                                <option value="media" {{ $tasks->priority == 'media' ? 'selected' : '' }}>Media</option>
                                <option value="baja" {{ $tasks->priority == 'baja' ? 'selected' : '' }}>Baja</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <!-- Botón para guardar los cambios realizados en la tarea -->
                            <button class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded transition duration-200">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
