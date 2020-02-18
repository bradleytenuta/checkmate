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

        // Creates a coursework manually that has not started yet.
        App\Coursework::create([
            'module_id' => 1,
            'name' => "CourseworkName",
            'description' => "This is a coursework description",
            'maximum_score' => 20,
            'deadline' => "2020-12-22",
            'start_date' => "2020-12-10",
        ]);

        // Checks to see if any of their deadlines are in the past.
        Time::checkCourseworkDeadline();

        // Checks to see if the start dates are in the past too.
        Time::checkCourseworkStartDate();
    }
}