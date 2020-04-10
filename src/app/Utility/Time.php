<?php

namespace App\Utility;

use App\Coursework;

class Time
{
    /**
     * This function checks to see if any courseworks deadlines are in the past.
     * If they are in the past then update the state of the coursework to be closed.
     */
    public static function checkCourseworkDeadline()
    {
        foreach (Coursework::all() as $coursework)
        {
            if ((Time::dateHasPassed($coursework)) && ($coursework->open == true))
            {
                $coursework->setState(false);
            }
        }
    }

    /**
     * This function checks all the courseworks and makes sure that if the current time
     * has gone passed the start date of a coursework then it updates the state of the coursework
     * to open.
     */
    public static function checkCourseworkStartDate()
    {
        foreach (Coursework::all() as $coursework)
        {
            // If the start date is in the past and the deadline is in the future.
            // And the coursework is not already open, then open it.
            if (!(Time::dateInFuture($coursework)) && !(Time::dateHasPassed($coursework)) && ($coursework->open == false))
            {
                $coursework->setState(true);
            }
        }
    }

    /**
     * This function checks to see if the given coursework's deadline is in the past.
     */
    public static function dateHasPassed($coursework)
    {
        return date("Y-m-d") > $coursework->deadline;
    }

    /**
     * This function checks to see if the coursework's deadline is today.
     */
    public static function dateIsToday($coursework)
    {
        return date("Y-m-d") == $coursework->deadline;
    }

    /**
     * This function checks to see if the coursework start date is in the future
     * and so the coursework has not started yet and should be in the closed state.
     */
    public static function dateInFuture($coursework)
    {
        return $coursework->start_date > date("Y-m-d");
    }
}