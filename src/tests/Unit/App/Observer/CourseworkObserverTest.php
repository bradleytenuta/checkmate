<?php

namespace Tests\Unit\App\Observer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory as Faker;
use App\Module;
use App\Coursework;
use DateTime;
use DateInterval;

class CourseworkObserverTest extends TestCase
{
    /**
     * Tests that the coursework state is updated when created.
     *
     * @return void
     */
    public function testCourseworkCreated()
    {
        $faker = Faker::create();

        $coursework = new Coursework;
        $coursework->name = $faker->word() . "_TestCoursework";
        $coursework->description = $faker->sentence($nbWords = 10, $variableNbWords = true);
        $coursework->maximum_score = 100;
        $coursework->module_id = Module::all()->first()->id;
        $coursework->coursework_type_id = 1; // java coursework type id.

        // Set so the coursework will change to the open state.
        $deadline = new DateTime();
        $deadline->add(new DateInterval('P1D'));
        $coursework->deadline = date_format($deadline, "Y-m-d");

        $startdate = new DateTime();
        $startdate->sub(new DateInterval('P1D'));
        $coursework->start_date = date_format($startdate, "Y-m-d");

        // Saves the coursework to trigger the observer.
        $coursework->save();

        // Checks that the coursework is now open instead of closed.
        $this->assertTrue($coursework->open);
    }

    /**
     * Tests that the coursework state is not updated when created.
     *
     * @return void
     */
    public function testCourseworkCreatedNoStateChange()
    {
        $faker = Faker::create();

        $coursework = new Coursework;
        $coursework->name = $faker->word() . "_TestCoursework2";
        $coursework->description = $faker->sentence($nbWords = 10, $variableNbWords = true);
        $coursework->maximum_score = 100;
        $coursework->module_id = Module::all()->first()->id;
        $coursework->coursework_type_id = 1; // java coursework type id.

        // Set so the coursework will stay in the closed state.
        $deadline = new DateTime();
        $deadline->sub(new DateInterval('P1D'));
        $coursework->deadline = date_format($deadline, "Y-m-d");

        $startdate = new DateTime();
        $startdate->sub(new DateInterval('P1D'))->sub(new DateInterval('P1D'));
        $coursework->start_date = date_format($startdate, "Y-m-d");

        // Saves the coursework to trigger the observer.
        $coursework->save();

        // Checks that the coursework is now open instead of closed.
        $this->assertFalse($coursework->open);
    }
}