<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Project;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            // //ID DESARROLLADOR
            // $table->unsignedInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            //ID CLIENTE
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');

            //NOMBRE
            $table->string('name', 50);

            //DESCRIPCION
            $table->string('description', 250);

            //ESTADO
            $table->tinyInteger('status')->default(Project::STATUS_TODO);

            //VISIBLE
            $table->tinyInteger('visible')->default(Project::VISIBLE);

            //CREADO POR
            $table->unsignedInteger('created_by_id')->nullable()->default(null);
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('projects');
    }



    
}
