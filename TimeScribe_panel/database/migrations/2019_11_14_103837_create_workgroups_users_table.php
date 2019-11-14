<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkgroupsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workgroups_users', function (Blueprint $table) {
            
            $table->increments('id');
            //ID USUARIO
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //ID WORKGROUP
            $table->unsignedInteger('workgroup_id');
            $table->foreign('workgroup_id')->references('id')->on('workgroups')->onDelete('cascade');
            //Es admin
            $table->unsignedInteger('admin')->default(0);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workgroups_users');
    }
}
