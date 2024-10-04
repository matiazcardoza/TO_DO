<div>
    <!-- Botón para abrir el modal -->
    <button type="button" class="btn btn-primary whitespace-nowrap" wire:click="toggleModal">Agregar Tarea</button>

    @if ($showAlert)
        <div class="fixed top-0 right-0 mt-4 mr-4 w-1/3 bg-green-500 text-white p-4 rounded-md shadow-md z-50">
            Tarea creada exitosamente.
            <button class="ml-4 text-white" wire:click="$set('showAlert', false)">Cerrar</button>
        </div>
    @endif

    <!-- Modal -->
    @if ($open)
        <x-create>
            <form wire:submit.prevent="save"> <!-- Cambiado para prevenir el envío normal del formulario -->
                <div class="mb-4">
                    <label for="title"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                    <input type="text" wire:model="title" name="title"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Título de la tarea">
                    @error('title')
                        <!-- Mensaje de error para el título -->
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                    <textarea wire:model="description" name="description"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Descripción de la tarea"></textarea>
                    @error('description')
                        <!-- Mensaje de error para la descripción -->
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
                    <select wire:model="status" name="status"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Selecciona un estado</option>
                        <!-- Añade un valor vacío para obligar a elegir -->
                        <option value="pendiente">Pendiente</option>
                        <option value="completada">Completada</option>
                    </select>
                    @error('status')
                        <!-- Mensaje de error para el estado -->
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha
                        Límite</label>
                    <input type="datetime-local" wire:model="due_date" name="due_date"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('due_date')
                        <!-- Mensaje de error para la fecha límite -->
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="priority"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prioridad</label>
                    <select wire:model="priority" name="priority"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Selecciona una prioridad</option>
                        <!-- Añade un valor vacío para obligar a elegir -->
                        <option value="alta">Alta</option>
                        <option value="media" selected>Media</option>
                        <option value="baja">Baja</option>
                    </select>
                    @error('priority')
                        <!-- Mensaje de error para la prioridad -->
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </form>

            <!-- Modal footer -->
            <div class="flex justify-end space-x-2 pt-3 border-t">
                <button wire:click="toggleModal" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded">
                    Cerrar
                </button>
                <button wire:click="save" type="button"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                    Guardar Tarea
                </button>
            </div>
        </x-create>
    @endif
</div>
