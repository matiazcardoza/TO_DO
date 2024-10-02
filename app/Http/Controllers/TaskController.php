<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Mostrar una lista de tareas filtradas.
     *
     * @param Request $request - La solicitud HTTP que puede contener parámetros de filtrado.
     * 
     * @return \Illuminate\View\View - Retorna la vista con las tareas filtradas y el total de tareas.
     */
    public function index(Request $request)
    {
        // Capturar los parámetros del formulario de filtrado
        $title = $request->input('title');
        $status = $request->input('status');
        $due_date = $request->input('due_date');

        // Inicializar la consulta
        $query = Task::orderBy('id', 'desc');

        // Filtrar por título si se proporciona
        if (!empty($title)) {
            $query->where('title', 'like', '%' . $title . '%');
        }

        // Filtrar por estado si se proporciona
        if (!empty($status)) {
            $query->where('status', $status);
        }

        // Filtrar por fecha límite si se proporciona
        if (!empty($due_date)) {
            $query->whereDate('due_date', $due_date);
        }

        // Ejecutar la consulta y obtener las tareas filtradas
        $tasks = $query->get();

        // Obtener el total de tareas (sin filtros)
        $total = Task::count();

        // Retornar la vista con las tareas filtradas y el total
        return view('users.task.home', compact(['tasks', 'total']));
    }

    /**
     * Mostrar el formulario para crear una nueva tarea.
     *
     * @return \Illuminate\View\View - Retorna la vista del formulario de creación de tarea.
     */
    public function create()
    {
        return view('users.task.create');
    }

    /**
     * Guardar una nueva tarea en la base de datos.
     *
     * @param Request $request - La solicitud HTTP que contiene los datos de la tarea a crear.
     * 
     * @return \Illuminate\Http\RedirectResponse - Redirige a la lista de tareas con un mensaje de éxito o error.
     */
    public function save(Request $request)
    {
        // Validar los datos de entrada
        $validation = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'due_date' => 'required',
            'priority' => 'required',
        ]);

        // Crear la nueva tarea
        $data = Task::create($validation);

        if ($data) {
            session()->flash('success', 'Tarea creada');
            return redirect()->route('users/tasks');
        } else {
            session()->flash('error', 'Ocurrió un problema');
            return redirect()->route('users.tasks/create');
        }
    }

    /**
     * Mostrar el formulario para editar una tarea existente.
     *
     * @param int $id - El ID de la tarea a editar.
     * 
     * @return \Illuminate\View\View - Retorna la vista del formulario de actualización de tarea.
     */
    public function edit($id)
    {
        $tasks = Task::findOrFail($id);
        return view('users.task.update', compact('tasks'));
    }

    /**
     * Actualizar una tarea existente en la base de datos.
     *
     * @param Request $request - La solicitud HTTP que contiene los datos de la tarea a actualizar.
     * @param int $id - El ID de la tarea a actualizar.
     * 
     * @return \Illuminate\Http\RedirectResponse - Redirige a la lista de tareas con un mensaje de éxito o error.
     */
    public function update(Request $request, $id)
    {
        $tasks = Task::findOrFail($id);
        $title = $request->title;
        $description = $request->description;
        $status = $request->status;
        $due_date = $request->due_date;
        $priority = $request->priority;

        // Actualizar los atributos de la tarea
        $tasks->title = $title;
        $tasks->description = $description;
        $tasks->status = $status;
        $tasks->due_date = $due_date;
        $tasks->priority = $priority;

        // Establecer la fecha de completado si el estado es 'completada'
        if ($status == 'completada') {
            $tasks->completed_at = now(); // Establece la fecha de completado
        } else {
            $tasks->completed_at = null; // Establece completed_at a null si está pendiente
        }

        // Guardar la tarea actualizada
        $data = $tasks->save();

        if ($data) {
            session()->flash('success', 'Tarea actualizada');
            return redirect()->route('users/tasks');
        } else {
            session()->flash('error', 'Ocurrió un problema');
            return redirect()->route('users.tasks/update');
        }
    }

    /**
     * Eliminar una tarea de la base de datos.
     *
     * @param int $id - El ID de la tarea a eliminar.
     * 
     * @return \Illuminate\Http\RedirectResponse - Redirige a la lista de tareas con un mensaje de éxito o error.
     */
    public function delete($id)
    {
        $tasks = Task::findOrFail($id)->delete();
        if ($tasks) {
            session()->flash('success', 'Tarea eliminada');
            return redirect()->route('users/tasks');
        } else {
            session()->flash('error', 'Ocurrió un problema');
            return redirect()->route('users.tasks');
        }
    }

    /**
     * Marcar una tarea como completada.
     *
     * @param int $id - El ID de la tarea a completar.
     * 
     * @return \Illuminate\Http\RedirectResponse - Redirige a la lista de tareas con un mensaje de éxito o error.
     */
    public function complete($id)
    {
        $tasks = Task::findOrFail($id);

        // Actualizar el estado de la tarea a 'completada' y establecer la fecha de completado
        $updated = $tasks->update([
            'status' => 'completada',
            'completed_at' => now(),
        ]);

        if ($updated) {
            session()->flash('success', 'Tarea marcada como completada.');
            return redirect()->route('users/tasks'); // Redirigir a la lista de tareas con mensaje de éxito
        } else {
            session()->flash('error', 'Ocurrió un problema al completar la tarea.');
            return redirect()->route('users/tasks'); // Redirigir a la lista de tareas con mensaje de error
        }
    }
}
