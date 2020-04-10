<?php

namespace App\Utility;

use App\Coursework;

class Time
{
    /**
     * This function checks all the courseworks in the database and updates their state if the
     * deadlines have been passed or their start dates are in the future.
     */
    public static function checkAllCourseworkStates()
    {
        foreach (Coursework::all() as $coursework)
        {
            Time::checkCourseworkState($coursework);
        }
    }

    /**
     * This fucntion updates the state of a coursework if the
     * deadline have passed or the start date is in the future.
     */
    public static function checkCourseworkState($coursework)
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