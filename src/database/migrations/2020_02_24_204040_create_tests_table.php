<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            // Main Schema
            $table->bigIncrements('id');
            $table->boolean('public')->default(true);
            $table->unsignedBigInteger('coursework_id');
            $table->string('file_path')->default("");
            $table->string('file_name')->default("");

            // Meta Data
            $table->timestamps();

            // Keys
            $table->foreign('coursework_id')->references('id')->
                on('courseworks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
