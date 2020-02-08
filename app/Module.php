<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    /**
     * Gets a list of all the courseworks this module has.
     */
    public function courseworks()
    {
        return $this->hasMany('App\Coursework');
    }

    /**
     * Gets all the users that are within this module.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'module_user')
                    ->withPivot('module_role_id');
    }

    /**
     * Returns all the open courseworks.
     */
    public function openCourseworks()
    {
        return $this->courseworks->where("open", true);
    }

    /**
     * Returns all the closed courseworks.
     */
    public function closedCourseworks()
    {
        return $this->courseworks->where("open", false);
    }
}