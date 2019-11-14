<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\TimeRecord;

class CreateTimerecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timerecords', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            //ID TAREA
            $table->unsignedInteger('task_id');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');

            //FECHA DE INICIO
            $table->dateTime('start_date')->nullable()->default(null);

            //FECHA DE FINALIZACION
            $table->dateTime('finish_date')->nullable()->default(null);

            //STATUS (Borrador)
            $table->tinyInteger('status')->default(Timerecord::STATUS_DRAFT);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timerecords');
    }
}
