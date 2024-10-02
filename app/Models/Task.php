<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada al modelo
    protected $table = 'tasks';

    // Los atributos que se pueden asignar de forma masiva
    protected $fillable = [
        'title',         // Título de la tarea
        'description',   // Descripción de la tarea
        'status',        // Estado de la tarea (ej. pendiente, completada)
        'due_date',      // Fecha límite de la tarea
        'priority',      // Prioridad de la tarea (ej. alta, media, baja)
        'completed_at',  // Fecha de completado de la tarea
    ];

    // Definición de los tipos de datos de los atributos
    protected $casts = [
        'completed_at' => 'datetime', // Convierte 'completed_at' a tipo datetime
    ];
}
