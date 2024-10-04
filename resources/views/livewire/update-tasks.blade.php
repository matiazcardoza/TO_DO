<div>
    <div>
        <!-- Botón para abrir el modal de edición -->
        <button wire:click="toggleModal"
            class="bg-blue-500 text-white font-semibold py-1 px-3 rounded hover:bg-blue-600 transition duration-200 cursor-pointer">
            Editar</button>

        <!-- Modal -->
        @if ($open)
            <x-create>
                <!-- Formulario de edición de tarea -->
                <form wire:submit.prevent="update"> <!-- Usamos wire:submit.prevent para Livewire -->
                    @csrf
                    <!-- Campo de título -->
                    <div class="mb-4">
                        <label for="title"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                        <input type="text" wire:model.defer="title"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Título de la tarea">
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo de descripción -->
                    <div class="mb-4">
                        <label for="description"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                        <input wire:model.defer="description"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Descripción de la tarea">
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo de estado -->
                    <div class="mb-4">
                        <label for="status"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
                        <select wire:model.defer="status"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="pendiente">Pendiente</option>
                            <option value="completada">Completada</option>
                        </select>
                        @error('status')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo de fecha límite -->
                    <div class="mb-4">
                        <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha
                            Límite</label>
                        <input type="datetime-local" wire:model.defer="due_date"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('due_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo de prioridad -->
                    <div class="mb-4">
                        <label for="priority"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prioridad</label>
                        <select wire:model.defer="priority"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="alta">Alta</option>
                            <option value="media">Media</option>
                            <option value="baja">Baja</option>
                        </select>
                        @error('priority')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </form>

                <!-- Modal footer -->
                <div class="flex justify-end space-x-2 pt-3 border-t">
                    <button wire:click="toggleModal"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded">
                        Cerrar
                    </button>
                    <button wire:click="update" type="button"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                        Guardar Tarea
                    </button>
                </div>
            </x-create>
        @endif
    </div>
</div>
