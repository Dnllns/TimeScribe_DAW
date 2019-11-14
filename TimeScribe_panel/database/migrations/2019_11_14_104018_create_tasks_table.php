<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Task;

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

            //NOMBRE
            $table->string('name', 50);

            //DESCRIPCION
            $table->string('description', 250);

            //ESTADO
            $table->tinyInteger('status')->default(Task::STATUS_TODO);

            //FECHA DE INICIO
            $table->dateTime('start_date')->nullable()->default(null);

            //FECHA DE FINALIZACION
            $table->dateTime('finish_date')->nullable()->default(null);

            //VISIBLE
            $table->tinyInteger('visible')->default(Task::VISIBLE);

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
