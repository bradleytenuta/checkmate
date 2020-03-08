<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Utility\Time;
use Faker\Factory as Faker;
use App\Coursework;
use App\Test;

class CourseworksTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Creates all the courseworks.
        factory(Coursework::class, 50)->create();

        // Creates a coursework manually that has not started yet.
        Coursework::create([
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

        // Loads all the test files.
        $files = File::files(storage_path('app/seeding/tests'));
        $faker = Faker::create();
        // Adds a random number of java tests to the courseworks.
        foreach (Coursework::all() as $coursework)
        {
            // Gets a random number between the number of files and creates that many tests for the
            // given coursework.
            $testsToMake = $faker->numberBetween($min = 1, $max = sizeof($files));

            for ($x = 0; $x < $testsToMake; $x++)
            {
                $test = new Test;
                $test->public = $faker->boolean;
                $test->coursework_id = $coursework->id;
                $test->save(); // Saves the test to provide it an id.

                // Gets the file path and name with the for loop index.
                $file = $files[$x];
                $filename = basename($file);

                $test->file_name = $filename;
                $test->file_path = 'public/coursework/' . $coursework->id . '/' . 'tests' . '/' .  $test->id . '/' . $filename;
                $test->save();

                // Copies the file over
                Storage::copy(str_replace("var/www/html/storage/app/", "", $file), $test->file_path);
            }
        }
    }
}