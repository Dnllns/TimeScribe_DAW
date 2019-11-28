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
            //ID INVITACION
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
