<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            //$table->timestamps();

            //ID PROYECTO
            $table->unsignedInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

            //ID GRUPO DE TAREA
            $table->unsignedInteger('taskgroup_id');
            $table->foreign('taskgroup_id')->references('id')->on('taskgroups')->onDelete('cascade');

            //NOMBRE
            $table->string('name', 50);

            //DESCRIPCION
            $table->string('description', 250);

            //ESTADO
            $table->string('status', 3);

            //FECHA DE INICIO
            $table->dateTime('start_date')->nullable()->default(null);

            //FECHA DE FINALIZACION
            $table->dateTime('finish_date')->nullable()->default(null);

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
