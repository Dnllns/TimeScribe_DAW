<?php

use App\Task;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');

            //ID GRUPO DE TAREA
            $table->unsignedInteger('task_group_id');
            $table->foreign('task_group_id')->references('id')->on('taskgroups')->onDelete('cascade');

            $table->string('name', 50); //NOMBRE

            $table->string('description', 250)->nullable(); //DESCRIPCION

            $table->dateTime('start_date')->nullable()->default(null); //FECHA DE INICIO

            $table->dateTime('finish_date')->nullable()->default(null); //FECHA DE FINALIZACION

            $table->tinyInteger('status')->default(Task::STATUS_TODO); //ESTADO

            $table->tinyInteger('visible')->default(Task::VISIBLE); //VISIBLE

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
}
