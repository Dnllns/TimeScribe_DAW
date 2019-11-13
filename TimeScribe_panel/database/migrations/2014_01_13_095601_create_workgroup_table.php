<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkgroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workgroup', function (Blueprint $table) {

            // $table->timestamps();
            $table->increments('id');

            //ID Administrador
            $table->unsignedInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');

            //nombre workgroup
            $table->string('name', 100)->nullable()->default('new Workgroup');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workgroup');
    }
}
