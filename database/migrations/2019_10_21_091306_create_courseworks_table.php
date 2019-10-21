<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseworksTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('courseworks', function (Blueprint $table) {

            // Main Schema
            $table->bigIncrements('id');
            $table>unsignedInteger('moduleId');
            $table->string('name');
            $table->dateTime('deadline');
            $table>unsignedInteger('maximumScore');
            $table->string('description');

            // Meta Data
            $table->timestamps();

            // Keys
            $table->primary('id');
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
        Schema::dropIfExists('courseworks');
    }
}
