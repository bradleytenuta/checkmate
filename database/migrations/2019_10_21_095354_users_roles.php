<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersRoles extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users_roles', function (Blueprint $table) {

            // Main Schema
            $table->unsignedInteger('userId');
            $table->unsignedInteger('roleId');

            // Keys
            $table->foreign('userId')->references('id')->
                on('users')->ondelete('cascade')->onUpdate('cascade');
            $table->foreign('roleId')->references('id')->
                on('roles')->ondelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users_roles');
    }
}
