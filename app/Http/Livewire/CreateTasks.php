<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;

class CreateTasks extends Component
{
    public $open = false; // Inicialmente cerrado

    public $showAlert = false; // Para mostrar la alerta

    public $title;
    public $description;
    public $status = 'pendiente';
    public $due_date;
    public $priority = 'media';
    public $completed_at;

    public function save()
    {
        // Validar los campos del formulario
        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'due_date' => 'required',
            'priority' => 'required',
        ]);

        // Si pasa la validación, crear la tarea
        Task::create([
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'due_date' => $this->due_date,
            'priority' => $this->priority,
            'completed_at' => $this->completed_at
        ]);

        // Resetear los campos
        $this->reset(['open', 'title', 'description', 'status', 'due_date', 'priority']);
        $this->emit('render');
        $this->showAlert = true;
        session()->flash('success', 'Tarea creada exitosamente.');
    }

    public function toggleModal()
    {
        $this->open = !$this->open; // Alterna la visibilidad del modal
    }

    public function render()
    {
        return view('livewire.create-tasks');
    }
}
