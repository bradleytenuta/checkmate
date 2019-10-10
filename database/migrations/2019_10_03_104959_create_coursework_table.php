<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseworkTable extends Migration {

    /**
     * Run the migrations.
     * Up means moving forward, this means its adding when migrating.
     * 
     * This function creates the table and the
     * schema for the table.
     * 
     * @return void
     */
    public function up() {
        // Creates the Schema for the table.
        Schema::create('coursework', function (Blueprint $table) {
            // All the headings for the table.
            $table->bigIncrements('CourseworkId');
            $table->string('Name');
            $table->timestamp('Deadline');
            $table->string('EmailAddress');
            $table->bigInteger('ModuleId');
            $table->integer('MaximumScore');
            $table->string('Description')->default("No description has been set.");

            // This will add 'created at' and 'updated at' timestamp.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Down means it reverses the migration or undo.
     * So we want to remove/drop the table when we roll back.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('coursework');
    }
}