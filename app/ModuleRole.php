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
}
