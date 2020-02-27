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

    /**
     * This function checks to see if the coursework start date is in the future
     * and so the coursework has not started yet and should be in the closed state.
     */
    public static function dateInFuture($coursework)
    {
        // Gets the current date
        $current_date = new DateTime();
        $start_date = new DateTime($coursework->start_date);
        
        if ($start_date > $current_date)
        {
          return true;
        }
        return false;
    }
}