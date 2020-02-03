<?php

namespace App\Utility;

use App\Coursework;
use DateTime;

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
     * This function checks to see if the given coursework's deadline is in the past.
     */
    public static function dateHasPassed($coursework)
    {
        // Gets the current date
        $current_date = new DateTime();
        $deadline = new DateTime($coursework->deadline);

        if (date_format($current_date, 'Y-m-d') > date_format($deadline, 'Y-m-d'))
        {
            return true;
        }
        return false;
    }

    /**
     * This function checks to see if the coursework's deadline is today.
     */
    public static function dateIsToday($coursework)
    {
        // Gets the current date
        $current_date = new DateTime();
        $deadline = new DateTime($coursework->deadline);

        if (date_format($current_date, 'Y-m-d') == date_format($deadline, 'Y-m-d'))
        {
            return true;
        }
        return false;
    }
}