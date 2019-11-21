<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobalRolesPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_roles_permissions', function (Blueprint $table) {

            // Main Schema
            $table->unsignedBigInteger('global_role_id');
            $table->unsignedBigInteger('permission_id');

            // Keys
            $table->primary(['global_role_id', 'permission_id']);
            $table->foreign('global_role_id')->references('id')->
                on('global_roles')->ondelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('global_roles_permissions');
    }
}
