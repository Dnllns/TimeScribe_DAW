<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkgroupsWorkgroupinvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workgroups_workgroupinvitations', function (Blueprint $table) {
            $table->increments('id');

            //ID WORKGROUP
            $table->unsignedInteger('workgroup_id');
            $table->foreign('workgroup_id')->references('id')->on('workgroups')->onDelete('cascade');

            //ID INVITACION
            $table->unsignedInteger('invitation_id');
            $table->foreign('invitation_id')->references('id')->on('workgroupinvitations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workgroups_workgroupinvitations');
    }
}
