<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();//Identificador único de la tarea.
            $table->string('title');//Título o nombre de la tarea.
            $table->text('description')->nullable();//Descripción detallada de la tarea.
            $table->enum('status', ['pendiente', 'completada'])->default('pendiente');//Estado de la tarea (ej. pendiente, completada).
            $table->datetime('due_date')->nullable();//Fecha límite para completar la tarea.
            $table->enum('priority', ['alta', 'media', 'baja'])->default('media');//Nivel de prioridad (ej. alta, media, baja).
            $table->timestamps();//Fecha y hora en que se creó la tarea (se genera automáticamente si usas timestamps de Laravel).
            $table->datetime('completed_at')->nullable();//Fecha y hora en la que se marcó como completada (si la tarea es completada).
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
