<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * Gets the global roles this permission belongs to.
     */
    public function globalRoles()
    {
        // As its a many to many relationship both are 'belongsToMany'
        // The name of the table that contains the many-to-many relationship is needed.
        return $this->belongsToMany('App\GlobalRole', 'global_roles_permissions');
    }

    /**
     * Gets the module roles this permission belongs to.
     */
    public function moduleRoles()
    {
        return $this->belongsToMany('App\ModuleRole');
    }
}