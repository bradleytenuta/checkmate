<?php

use Illuminate\Database\Seeder;
use App\Utility\Time;

class CourseworksTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Creates all the courseworks.
        factory(App\Coursework::class, 50)->create();

        // Checks to see if any of their deadlines are in the past.
        Time::checkCourseworkDeadline();

        // Checks to see if the start dates are in the past too.
        Time::checkCourseworkStartDate();
    }
}