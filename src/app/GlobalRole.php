<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalRole extends Model
{
    /**
     * Gets all the permissions for the role.
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Permission', 'global_roles_permissions');
    }

    /**
     * Gets the user that owns this role.
     */
    public function user() 
    {
        return $this->belongsToMany('App\User');
    }
}
