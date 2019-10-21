<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersModules extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users_modules', function (Blueprint $table) {

            // Main Schema
            $table->unsignedInteger('userId');
            $table->unsignedInteger('moduleId');
            

            // Keys
            $table->primary(['userId', 'moduleId']);
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
        Schema::dropIfExists('users_modules');
    }
}
