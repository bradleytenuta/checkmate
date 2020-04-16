<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Utility\FileSystem;
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

        // Checks the states of all the created courseworks.
        Time::checkAllCourseworkStates();

        // Loads all the test files.
        $files = File::files(storage_path('app/seeding/tests'));
        $faker = Faker::create();

        // Creates tests for each coursework.
        foreach (Coursework::all() as $coursework)
        {
            $this->makeTest($coursework, true, $files[0]);
            $this->makeTest($coursework, false, $files[1]);
        }
    }

    /**
     * Creates a test for a coursework given a file to be used as the
     * test and a boolean on whether the test is public or private.
     */
    private function makeTest($coursework, $boolean, $file)
    {
        $test = new Test;
        $test->public = $boolean;
        $test->coursework_id = $coursework->id;
        $test->save(); // Saves the test to provide it an id.

        // Gets the file path and name with the for loop index.
        $filename = basename($file);

        $test->file_name = $filename;
        $test->file_path = 'public/coursework/' . $coursework->id . '/' . 'tests' . '/' .  $test->id . '/' . $filename;
        $test->save();

        // Copies the file over
        $file = FileSystem::cleanFilePath($file);
        Storage::copy($file, $test->file_path);
    }
}