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
        // Checks to see if the deadline has passed. If so update the state of coursework.
        if (Time::dateHasPassed($coursework))
        {
            $coursework->open = false;
            $coursework->save();
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
        //
    }

    /**
     * Handle the coursework "deleted" event.
     *
     * @param  \App\Coursework  $coursework
     * @return void
     */
    public function deleted(Coursework $coursework)
    {
        //
    }

    /**
     * Handle the coursework "restored" event.
     *
     * @param  \App\Coursework  $coursework
     * @return void
     */
    public function restored(Coursework $coursework)
    {
        //
    }

    /**
     * Handle the coursework "force deleted" event.
     *
     * @param  \App\Coursework  $coursework
     * @return void
     */
    public function forceDeleted(Coursework $coursework)
    {
        //
    }
}
