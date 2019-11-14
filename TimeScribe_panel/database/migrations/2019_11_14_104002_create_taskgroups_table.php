<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\TaskGroup;

class CreateTaskgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taskgroups', function (Blueprint $table) {
            $table->increments('id');
            
            //ID PROYECTO
            $table->unsignedInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

            //NOMBRE
            $table->string('name', 50);

            //DESCRIPCION
            $table->string('description', 250);

            //ESTADO
            $table->tinyInteger('status')->default(TaskGroup::STATUS_TODO);

            //VISIBLE
            $table->tinyInteger('visible')->default(TaskGroup::VISIBLE);

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
        Schema::dropIfExists('taskgroups');
    }
}
