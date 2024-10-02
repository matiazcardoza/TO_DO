<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard de Tareas') }} <!-- Título principal del Dashboard -->
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Formulario de Filtro -->
                    <div class="mb-5">
                        <form action="{{ route('users/tasks') }}" method="GET">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                                <!-- Campo de entrada para filtrar por título -->
                                <input type="text" name="title" class="p-2 border rounded" placeholder="Filtrar por título" value="{{ request('title') }}">
                                <!-- Selector para filtrar por estado -->
                                <select name="status" class="p-2 border rounded">
                                    <option value="">Todos los estados</option>
                                    <option value="pendiente" {{ request('status') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="completada" {{ request('status') == 'completada' ? 'selected' : '' }}>Completada</option>
                                </select>
                                <!-- Campo de entrada para filtrar por fecha de vencimiento -->
                                <input type="date" name="due_date" class="p-2 border rounded" value="{{ request('due_date') }}">
                            </div>
                            <div class="flex justify-center">
                                <!-- Botón para aplicar filtros -->
                                <button class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded hover:bg-indigo-700 transition duration-200">Filtrar</button>
                            </div>
                        </form>
                    </div>

                    <!-- Encabezado de la Lista de Tareas -->
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="text-xl font-semibold">Lista de Tareas</h1>
                        <!-- Botón para agregar una nueva tarea -->
                        <a href="{{ route('users/tasks/create') }}" class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded hover:bg-indigo-700 transition duration-200">Agregar Tarea</a>
                    </div>

                    <hr/>

                    <!-- Mensaje de éxito si existe -->
                    @if (Session::has('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">{{ Session::get('success') }}</strong>
                    </div>
                    @endif

                    <!-- Tabla de Tareas -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-200">
                                <tr>
                                    <!-- Encabezados de las columnas de la tabla -->
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Límite</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prioridad</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de Completado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Iterar sobre las tareas -->
                                @forelse ($tasks as $task)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $task->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $task->description }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $task->status }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $task->due_date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $task->priority }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $task->completed_at ? $task->completed_at->format('d/m/Y H:i') : 'No completada' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <!-- Botón para editar la tarea -->
                                            <a href="{{ route('users/tasks/edit', ['id' => $task->id]) }}" class="bg-blue-500 text-white font-semibold py-1 px-3 rounded hover:bg-blue-600 transition duration-200">Editar</a>
                                            <form action="{{ route('users/tasks/delete', ['id' => $task->id]) }}" method="POST" class="inline-block">
                                                @csrf <!-- Protección CSRF para el formulario de eliminación -->
                                                @method('DELETE') <!-- Método DELETE para la eliminación -->
                                                <!-- Botón para eliminar la tarea -->
                                                <button type="submit" class="bg-red-500 text-white font-semibold py-1 px-3 rounded hover:bg-red-600 transition duration-200">Eliminar</button>
                                            </form>
                                        </div>
                                        <!-- Botón para marcar la tarea como completada -->
                                        @if ($task->status === 'pendiente')
                                        <div class="mt-2">
                                            <form action="{{ route('users/tasks/complete', ['id' => $task->id]) }}" method="POST">
                                                @csrf <!-- Protección CSRF para el formulario de completado -->
                                                @method('PATCH') <!-- Método PATCH para marcar como completada -->
                                                <button type="submit" class="bg-green-500 text-white font-semibold py-1 px-3 rounded hover:bg-green-600 transition duration-200">Marcar como Completada</button>
                                            </form>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <!-- Mensaje si no hay tareas disponibles -->
                                <tr>
                                    <td class="text-center" colspan="8">No hay tareas disponibles.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
