<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RolesPermissions extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('roles_permissions', function (Blueprint $table) {

            // Main Schema
            $table->unsignedInteger('roleId');
            $table->unsignedInteger('permissionId');

            // Keys
            $table->primary(['roleId', 'permissionId']);
            $table->foreign('roleId')->references('id')->
                on('roles')->ondelete('cascade')->onUpdate('cascade');
            $table->foreign('permissionId')->references('id')->
                on('permissions')->ondelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('roles_permissions');
    }
}
