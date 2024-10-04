<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use Carbon\Carbon; // Importamos Carbon para trabajar con fechas

class UpdateTasks extends Component
{
    public $task;
    public $open = false; // Inicialmente cerrado

    // Campos del formulario que se llenarán con los datos de la tarea
    public $title;
    public $description;
    public $status;
    public $due_date;
    public $priority;

    public function mount(Task $task)
    {
        $this->task = $task;

        // Rellenar los campos con los datos de la tarea
        $this->title = $task->title;
        $this->description = $task->description;
        $this->status = $task->status;

        // Verificar si due_date es una fecha válida, y si es así, aplicar formato
        $this->due_date = $task->due_date ? Carbon::parse($task->due_date)->format('Y-m-d\TH:i') : null;

        $this->priority = $task->priority;
    }

    public function toggleModal()
    {
        $this->open = !$this->open;
    }

    public function update()
    {
        // Validar los campos antes de guardar
        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'due_date' => 'required',
            'priority' => 'required',
        ]);

        // Actualizar la tarea con los nuevos valores
        $this->task->update([
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'due_date' => $this->due_date,
            'priority' => $this->priority,
        ]);

        $this->emit('render');

        // Cerrar el modal después de actualizar
        $this->toggleModal();

        // Emitir un evento si es necesario o mostrar un mensaje de éxito
        session()->flash('success', 'Tarea actualizada exitosamente.');
    }

    public function render()
    {
        return view('livewire.update-tasks');
    }
}
