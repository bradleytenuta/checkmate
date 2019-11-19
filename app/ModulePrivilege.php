<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModulePrivilege extends Model {

    /**
     * Gets the module this privilage is for.
     */
    public function module() {
        return $this->hasOne('App\Module');
    }

    /**
     * Gets the user that owns this privilage.
     */
    public function user() {
        return $this->hasOne('App\User');
    }

    /**
     * Gets the role that this privilage is for.
     */
    public function moduleRole() {
        return $this->hasOne('App\ModuleRole');
    }
}