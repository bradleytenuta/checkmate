<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalRole extends Model
{
    /**
     * Gets all the permissions for the role.
     */
    public function permissions() {
        return $this->hasMany('App\Permission');
    }
}
