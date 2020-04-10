<?php

namespace App\Observers;

use App\Coursework;
use App\Utility\Time;

class CourseworkObserver
{
    /**
     * Handle the coursework "created" event.
     *
     * @param  \App\Coursework  $coursework
     * @return void
     */
    public function created(Coursework $coursework)
    {
        // If deadline is in the past or start date is in the future, then state of coursework is closed.
        if (Time::dateHasPassed($coursework) || Time::dateInFuture($coursework))
        {
            $coursework->setState(false);
        } else {
            $coursework->setState(true);
        }
    }

    /**
     * Handle the coursework "updated" event.
     *
     * @param  \App\Coursework  $coursework
     * @return void
     */
    public function updated(Coursework $coursework)
    {
        // If deadline is in the past or start date is in the future, then state of coursework is closed.
        if (Time::dateHasPassed($coursework) || Time::dateInFuture($coursework))
        {
            $coursework->setState(false);
        } else {
            $coursework->setState(true);
        }
    }
}