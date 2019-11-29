<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkgroupinvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workgroupinvitations', function (Blueprint $table) {

            $table->increments('id');

            //Id del Workgroup
            $table->unsignedInteger('workgroup_id');
            $table->foreign('workgroup_id')->references('id')->on('workgroups')->onDelete('cascade');

            $table->string('email');
            // Hash
            $table->string('hash', 60);
            // invitation used
            $table->boolean('used');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workgroupinvitations');
    }
}
