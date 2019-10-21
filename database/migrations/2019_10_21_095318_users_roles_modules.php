<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersRolesModules extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users_roles_modules', function (Blueprint $table) {

            // Main Schema
            $table->unsignedInteger('roleId');
            $table->unsignedInteger('userId');
            $table->unsignedInteger('moduleId');
            

            // Keys
            $table->primary(['roleId', 'userId', 'moduleId']);
            $table->foreign('roleId')->references('id')->
                on('roles')->ondelete('cascade')->onUpdate('cascade');
            $table->foreign('userId')->references('id')->
                on('users')->ondelete('cascade')->onUpdate('cascade');
            $table->foreign('moduleId')->references('id')->
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
