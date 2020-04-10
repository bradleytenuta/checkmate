<?php

namespace Tests\Utility;

use Faker\Factory as Faker;
use App\Module;
use App\Coursework;
use DateTime;
use DateInterval;

class ModelCreator
{
    public static function createModule($numberOfOpen, $numberOfPending, $numberOfClosed)
    {
        // Uses faker to ensure that the values are never duplicated.
        $faker = Faker::create();

        $module = new Module;
        $module->name = $faker->word() . "_TestModule";
        $module->description = $faker->sentence($nbWords = 10, $variableNbWords = true);
        
        // Saves to the database.
        $module->save();

        // Adds the courseworks to the module.
        for ($x = 0; $x < $numberOfOpen; $x++) ModelCreator::createOpenCoursework($module);
        for ($x = 0; $x < $numberOfPending; $x++) ModelCreator::createPendingCoursework($module);
        for ($x = 0; $x < $numberOfClosed; $x++) ModelCreator::createClosedCoursework($module);

        return $module;
    }

    public static function createOpenCoursework($module)
    {
        $coursework = ModelCreator::createCoursework($module);

        // Deadline, tomorrow.
        $deadline = new DateTime();
        $deadline->add(new DateInterval('P1D'));
        $coursework->deadline = date_format($deadline, "Y-m-d");
        
        // Start date, yesterday.
        $startdate = new DateTime();
        $startdate->sub(new DateInterval('P1D'));
        $coursework->start_date = date_format($startdate, "Y-m-d");

        $coursework->open = true;

        // Saves to the database.
        $coursework->save();

        return $coursework;
    }

    public static function createClosedCoursework($module)
    {
        $coursework = ModelCreator::createCoursework($module);

        // Deadline, yesterday.
        $deadline = new DateTime();
        $deadline->sub(new DateInterval('P1D'));
        $coursework->deadline = date_format($deadline, "Y-m-d");
        
        // Start date, two days ago.
        $startdate = new DateTime();
        $startdate->sub(new DateInterval('P1D'))->sub(new DateInterval('P1D'));
        $coursework->start_date = date_format($startdate, "Y-m-d");

        $coursework->open = false;

        // Saves to the database.
        $coursework->save();

        return $coursework;
    }

    public static function createPendingCoursework($module)
    {
        $coursework = ModelCreator::createCoursework($module);

        // Deadline, two days from now.
        $deadline = new DateTime();
        $deadline->add(new DateInterval('P1D'))->add(new DateInterval('P1D'));
        $coursework->deadline = date_format($deadline, "Y-m-d");
        
        // Start date, tomorrow.
        $startdate = new DateTime();
        $startdate->add(new DateInterval('P1D'));
        $coursework->start_date = date_format($startdate, "Y-m-d");

        $coursework->open = false;

        // Saves to the database.
        $coursework->save();

        return $coursework;
    }

    private static function createCoursework($module)
    {
        // Uses faker to ensure that the values are never duplicated.
        $faker = Faker::create();

        $coursework = new Coursework;
        $coursework->name = $faker->word() . "_TestCoursework";
        $coursework->description = $faker->sentence($nbWords = 10, $variableNbWords = true);
        $coursework->maximum_score = 100;
        $coursework->module_id = $module->id;
        $coursework->coursework_type_id = 1; // java coursework type id.

        // Default dates to now.
        $coursework->deadline = date("Y-m-d");
        $coursework->start_date = date("Y-m-d");

        // Saves to the database.
        $coursework->save();

        return $coursework;
    }
}