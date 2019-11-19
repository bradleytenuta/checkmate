<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleRolesPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_roles_permissions', function (Blueprint $table) {

            // Main Schema
            $table->unsignedBigInteger('module_roles_id');
            $table->unsignedBigInteger('permission_id');

            // Keys
            $table->primary(['module_roles_id', 'permission_id']);
            $table->foreign('module_roles_id')->references('id')->
                on('module_roles')->ondelete('cascade')->onUpdate('cascade');
            $table->foreign('permission_id')->references('id')->
                on('permissions')->ondelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_roles_permissions');
    }
}
