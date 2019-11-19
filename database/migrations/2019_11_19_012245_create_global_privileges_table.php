<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobalPrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_privileges', function (Blueprint $table) {
            
            // Main Schema
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('global_role_id');

            // Keys
            $table->primary(['user_id', 'global_role_id']);
            $table->foreign('user_id')->references('id')->
                on('users')->ondelete('cascade')->onUpdate('cascade');
            $table->foreign('global_role_id')->references('id')->
                on('global_roles')->ondelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('global_privileges');
    }
}
