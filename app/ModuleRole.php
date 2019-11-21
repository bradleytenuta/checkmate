<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleRole extends Model
{
    /**
     * Gets all the permissions this role has.
     */
    public function permissions() {
        return $this->hasMany('App\Permission');
    }

    /**
     * Gets the module this role is for.
     */
    public function module() {
        return $this->hasOne('App\Module');
    }
}
