<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-xl p-6 mt-10 max-h-[80vh] overflow-auto">
        <!-- Modal header -->
        <div class="flex justify-between items-center border-b pb-3">
            <h5 class="text-lg font-bold">Agregar Tarea</h5>
            <button wire:click="toggleModal" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                &times;
            </button>
        </div>

        <!-- Modal body -->
        <div class="py-4">
            {{ $slot }}
        </div>
    </div>
</div>
