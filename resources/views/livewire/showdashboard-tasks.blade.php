<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard de Tareas') }}
        </h2>
    </x-slot>

    <x-home>

        <div class="px-6 py-4">
            <div class="flex space-x-4 mb-4">
                <!-- Campo de entrada para filtrar por título -->
                <label for="title-estatus" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título
                    Estado</label>
                <input type="text" name="title" class="p-2 border rounded w-full"
                    placeholder="Filtrar por título y estado" wire:model="search">
                <!-- Campo de entrada para filtrar por fecha de vencimiento -->
                <label for="title-estatus" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha
                    límite</label>
                <input type="date" name="due_date" class="p-2 border rounded w-full" wire:model="datesearch">
                <div class="w-auto px-1 py-3">
                    @livewire('create-tasks')
                </div>
            </div>
        </div>
        @if ($tasks->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-200">
                    <tr>
                        <!-- Encabezados de las columnas de la tabla -->
                        <th class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="order('title')">
                            <div class="flex items-center justify-between">
                                <span>Título</span>
                                @if ($sort == 'title')

                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt ml-2"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt ml-2"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort ml-2"></i>
                                @endif

                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Descripción</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha
                            Límite</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Prioridad</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha
                            de Completado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Iterar sobre las tareas -->
                    @forelse ($tasks as $task)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $task->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $task->description }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $task->status }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $task->due_date }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $task->priority }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $task->completed_at ? $task->completed_at->format('d/m/Y H:i') : 'No completada' }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <div class="flex space-x-2">
                                    <!-- Botón para editar la tarea -->
                                    @livewire('update-tasks', ['task' => $task], key($task->id))
                                    <form wire:submit.prevent="deleteTask({{ $task->id }})" class="inline-block">
                                        @csrf <!-- Protección CSRF para el formulario de eliminación -->
                                        @method('DELETE') <!-- Método DELETE para la eliminación -->

                                        <!-- Botón para eliminar la tarea -->
                                        <button type="button"
                                            onclick="if(confirm('¿Estás seguro de que deseas eliminar esta tarea?')) { this.closest('form').submit(); }"
                                            class="bg-red-500 text-white font-semibold py-1 px-3 rounded hover:bg-red-600 transition duration-200">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                                <!-- Botón para marcar la tarea como completada -->
                                @if ($task->status === 'pendiente')
                                    <div class="mt-2">
                                        <button type="button"
                                            onclick="if(confirm('¿Estás seguro de que deseas marcar esta tarea como completada?')) { @this.completeTask({{ $task->id }}); }"
                                            class="bg-green-500 text-white font-semibold py-1 px-3 rounded hover:bg-green-600 transition duration-200">
                                            Marcar como Completada
                                        </button>
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
        @else
            <div class="px-6 py-4">
                No existe ni un registro coincidente
            </div>
        @endif

        <div class="px-6 py-3">
            {{ $tasks->links() }}
        </div>
    </x-home>

</div>
