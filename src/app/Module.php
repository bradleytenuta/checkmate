<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Utility\Time;

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
     * Returns all the closed courseworks, that have a start and end date in the past.
     */
    public function closedCourseworks()
    {
        $closed_courseworks = $this->courseworks->where("open", false);

        // Removes the pending courseworks.
        foreach ($closed_courseworks as $key => $coursework)
        {
            if (Time::dateInFuture($coursework)) {
                $closed_courseworks->forget($key);
            }
        }

        return $closed_courseworks;
    }

    /**
     * Returns all the pending courseworks, 
     * which are closed and their start dates are in the future, so havnt started yet.
     */
    public function pendingCourseworks()
    {
        $pending_courseworks = $this->courseworks->where("open", false);

        // Keeps the pending courseworks.
        foreach ($pending_courseworks as $key => $coursework)
        {
            if (!Time::dateInFuture($coursework)) {
                $pending_courseworks->forget($key);
            }
        }

        return $pending_courseworks;
    }
}