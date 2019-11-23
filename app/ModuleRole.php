<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleRole extends Model
{
    /**
     * Gets all the permissions this role has.
     */
    public function permissions() {
        return $this->belongsToMany('App\Permission');
    }

    /**
     * Gets the module this role is for.
     */
    public function module() {
        return $this->belongsToMany('App\Module');
    }

    /**
     * Gets the user that owns this role.
     */
    public function user() {
        return $this->belongsToMany('App\User');
    }
}
