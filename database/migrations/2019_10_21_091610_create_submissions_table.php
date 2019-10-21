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
            $table->unsignedInteger('userId');
            $table->unsignedInteger('courseworkId');
            $table->unsignedInteger('score');
            $table->string('mainFeedback');
            $table->string('json');

            // Meta Data
            $table->timestamps();

            // Keys
            $table->primary('id');
            $table->foreign('userId')->references('id')->
                on('users')->ondelete('cascade')->onUpdate('cascade');
            $table->foreign('courseworkId')->references('id')->
                on('coursework')->ondelete('cascade')->onUpdate('cascade');
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
