<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_user', function (Blueprint $table) {
            // Main Schema
            $table->unsignedBigInteger('module_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('module_role_id');

            // Keys
            $table->primary(['module_id', 'user_id']);
            $table->foreign('module_id')->references('id')->
                on('modules')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->
                on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('module_role_id')->references('id')->
                on('module_roles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_user');
    }
}
