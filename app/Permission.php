<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

    /**
     * Gets the global roles this permission belongs to.
     */
    public function globalRole() {
        return $this->belongsToMany('App\GlobalRole');
    }

    /**
     * Gets the module roles this permission belongs to.
     */
    public function moduleRole() {
        return $this->belongsTo('App\ModuleRole');
    }
}