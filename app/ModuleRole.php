<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleRole extends Model {

    /**
     * The users that belong to the role.
     */
    public function users() {
        return $this->belongsTo('App\User');
    }

    /**
     * Returns the module this role belongs to.
     */
    public function module() {
        return $this->belongsTo('App\Module');
    }

    /**
     * Returns the role this ModuleRole belongs to.
     */
    public function role() {
        return $this->belongsTo('App\Role');
    }
}