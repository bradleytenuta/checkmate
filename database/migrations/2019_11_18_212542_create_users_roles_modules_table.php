<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersRolesModulesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users_roles_modules', function (Blueprint $table) {

            // Main Schema
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('module_id');

            // Keys
            $table->primary(['user_id', 'module_id']);

            $table->foreign('user_id')->references('id')->
                on('users')->ondelete('cascade')->onUpdate('cascade');
            $table->foreign('role_id')->references('id')->
                on('roles')->ondelete('cascade')->onUpdate('cascade');
            $table->foreign('module_id')->references('id')->
                on('modules')->ondelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users_roles_modules');
    }
}