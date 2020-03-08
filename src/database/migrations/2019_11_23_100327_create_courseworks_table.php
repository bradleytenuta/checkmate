<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class CreateCourseworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courseworks', function (Blueprint $table) {
            // Main Schema
            $table->bigIncrements('id');
            $table->unsignedBigInteger('module_id');
            $table->unsignedBigInteger('maximum_score');
            $table->unsignedBigInteger('coursework_type_id')->default(1);
            $table->string('name');
            $table->longText('description');
            $table->boolean('open')->default(false);
            $table->date('deadline');
            $table->date('start_date');

            // Meta Data
            $table->timestamps();

            // Keys
            $table->foreign('module_id')->references('id')->
                on('modules')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('coursework_type_id')->references('id')->
                on('coursework_types')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courseworks');
        Storage::deleteDirectory('public/coursework'); // Deletes the coursework directory.
    }
}
