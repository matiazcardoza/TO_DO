<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <!-- Encabezado de la Lista de Tareas -->
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-xl font-semibold">Lista de Tareas</h1>
                    <!-- Botón para agregar una nueva tarea -->

                </div>

                <hr />

                <!-- Mensaje de éxito si existe -->
                @if (Session::has('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">{{ Session::get('success') }}</strong>
                    </div>
                @endif

                <!-- Tabla de Tareas -->
                <div class="overflow-x-auto">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
