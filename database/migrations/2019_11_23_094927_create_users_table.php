<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // Main Schema
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('firstname');
            $table->string('surname');
            $table->unsignedBigInteger('global_role_id')->default(2);

            // Meta Data
            $table->timestamps();
            $table->rememberToken();

            // Keys
            $table->foreign('global_role_id')->references('id')->
                on('global_roles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
