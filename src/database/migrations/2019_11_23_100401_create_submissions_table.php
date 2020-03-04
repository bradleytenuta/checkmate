<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Json\SubmissionJson;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            // Main Schema
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('coursework_id');
            $table->string('file_path')->default("");
            $table->json('json')->nullable();
            $table->unsignedBigInteger('score')->nullable();
            $table->longText('main_feedback')->nullable();
            $table->unsignedBigInteger('marker_id')->nullable();

            // Meta Data
            $table->timestamps();

            // Keys
            $table->foreign('user_id')->references('id')->
                on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('coursework_id')->references('id')->
                on('courseworks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('marker_id')->references('id')->
                on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submissions');
    }
}
