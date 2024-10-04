<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use Livewire\WithPagination;

class ShowdashboardTasks extends Component
{
    use WithPagination;

    public $search;
    public $datesearch;
    public $sort = 'id';
    public $direction = 'desc';

    protected $listeners = ['render' => 'render'];

    public function deleteTask($taskId)
    {
        $task = Task::find($taskId);

        if ($task) {
            $task->delete(); // Eliminar la tarea
            $this->emit('taskDeleted'); // Emitir evento para refrescar la lista
            session()->flash('success', 'Tarea eliminada exitosamente.'); // Mensaje de éxito
        }
    }

    public function completeTask($taskId)
    {
        $task = Task::find($taskId);

        if ($task) {
            // Actualizar el estado de la tarea y marcar la fecha de completado
            $task->update([
                'status' => 'completada',
                'completed_at' => now(), // Establecer la fecha actual
            ]);
            $this->emit('taskCompleted'); // Emitir evento para refrescar la lista
            session()->flash('success', 'Tarea marcada como completada.'); // Mensaje de éxito
        }
    }

    public function render()
    {
        $tasks = Task::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%');
            })
            // Filtrar por fecha de vencimiento si se selecciona
            ->when($this->datesearch, function ($query) {
                $query->whereDate('due_date', $this->datesearch);
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(4);

        return view('livewire.showdashboard-tasks', compact('tasks'));
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            $this->direction = $this->direction == 'desc' ? 'asc' : 'desc';
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }
}
