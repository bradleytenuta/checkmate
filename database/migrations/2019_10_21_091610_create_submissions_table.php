<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('submissions', function (Blueprint $table) {

            // Main Schema
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('coursework_id');
            $table->unsignedBigInteger('score')->nullable();
            $table->string('main_feedback')->nullable();
            $table->string('json')->nullable();

            // Meta Data
            $table->timestamps();

            // Keys
            $table->foreign('user_id')->references('id')->
                on('users')->ondelete('cascade')->onUpdate('cascade');
            $table->foreign('coursework_id')->references('id')->
                on('courseworks')->ondelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('submissions');
    }
}