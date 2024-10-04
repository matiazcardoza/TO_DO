<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Livewire\ShowdashboardTasks;
use App\Http\Livewire\CreateTasks;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('users/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Agrupa las rutas que requieren autenticación y verificación de usuario
Route::middleware(['auth', 'verified'])->group(function () {
    /**
     * Muestra una lista de tareas.
     * 
     * @return \Illuminate\View\View  Retorna la vista con la lista de tareas.
     */
    Route::get('/users/tasks', [TaskController::class, 'index'])->name('users/tasks');

    //implementacion de ruta livewire
    Route::get('/users/tasks', ShowdashboardTasks::class)->name('users/tasks');
    

    /**
     * Muestra el formulario para crear una nueva tarea.
     * 
     * @return \Illuminate\View\View  Retorna la vista del formulario de creación.
     */
    Route::get('/users/tasks/create', CreateTasks::class)->name('users/tasks/create');

    /**
     * Guarda una nueva tarea en la base de datos.
     * 
     * @param \Illuminate\Http\Request $request  Contiene los datos de la tarea a guardar.
     * @return \Illuminate\Http\RedirectResponse  Redirige a la lista de tareas después de guardar.
     */
    Route::post('/users/tasks/save', [TaskController::class, 'save'])->name('users/tasks/save');

    /**
     * Muestra el formulario para editar una tarea existente.
     * 
     * @param int $id  ID de la tarea a editar.
     * @return \Illuminate\View\View  Retorna la vista del formulario de edición.
     */
    Route::get('/users/tasks/edit/{id}', [TaskController::class, 'edit'])->name('users/tasks/edit');

    /**
     * Actualiza los datos de una tarea en la base de datos.
     * 
     * @param int $id  ID de la tarea a actualizar.
     * @param \Illuminate\Http\Request $request  Contiene los nuevos datos de la tarea.
     * @return \Illuminate\Http\RedirectResponse  Redirige a la lista de tareas después de actualizar.
     */
    Route::put('/users/tasks/update/{id}', [TaskController::class, 'update'])->name('users/tasks/update');

    /**
     * Elimina una tarea de la base de datos.
     * 
     * @param int $id  ID de la tarea a eliminar.
     * @return \Illuminate\Http\RedirectResponse  Redirige a la lista de tareas después de eliminar.
     */
    Route::delete('/users/tasks/delete/{id}', [TaskController::class, 'delete'])->name('users/tasks/delete');

    /**
     * Marca una tarea como completada.
     * 
     * @param int $id  ID de la tarea a marcar como completada.
     * @return \Illuminate\Http\RedirectResponse  Redirige a la lista de tareas después de completar.
     */
    Route::patch('/users/tasks/complete/{id}', [TaskController::class, 'complete'])->name('users/tasks/complete');
});

require __DIR__.'/auth.php';

/*Route::get('/users/tasks', [TaskController::class, 'index'])->middleware((['auth', 'verified']))->name('users/tasks');
Route::get('/users/tasks/create', [TaskController::class, 'create'])->middleware((['auth', 'verified']))->name('users/tasks/create');
Route::post('/users/tasks/save', [TaskController::class, 'save'])->middleware((['auth', 'verified']))->name('users/tasks/save');
Route::get('/users/tasks/edit{id}', [TaskController::class, 'edit'])->middleware((['auth', 'verified']))->name('users/tasks/edit');
Route::put('/users/tasks/edit{id}', [TaskController::class, 'update'])->middleware((['auth', 'verified']))->name('users/tasks/update');
Route::get('/users/tasks/delete{id}', [TaskController::class, 'delete'])->middleware((['auth', 'verified']))->name('users/tasks/delete');
Route::patch('/users/tasks/complete{id}', [TaskController::class, 'complete'])->middleware((['auth', 'verified']))->name('users/tasks/complete');*/
