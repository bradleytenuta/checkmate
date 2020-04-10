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
        Time::checkCourseworkState($coursework);
    }

    /**
     * Handle the coursework "updated" event.
     *
     * @param  \App\Coursework  $coursework
     * @return void
     */
    public function updated(Coursework $coursework)
    {
        Time::checkCourseworkState($coursework);
    }
}