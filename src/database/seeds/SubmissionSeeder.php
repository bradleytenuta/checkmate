<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Utility\ModulePermission;
use App\Json\SubmissionJson;
use Faker\Factory as Faker;
use App\Submission;
use App\Coursework;

class SubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // TODO: Create submissions that have already been marked and completed.
    public function run()
    {
        // Creates a faker object. Its used for random booleans.
        $faker = Faker::create();
        // Loads the files.
        $files = File::files(storage_path('app/seeding/submissions'));

        foreach (Coursework::all() as $coursework)
        {
            // Gathers a list of users from the coursework.
            foreach ($coursework->module->users as $user)
            {
                // Only creates a submission for those that are students within the module.
                // Also a random boolean is used so only a random number of submissions is created
                // for all the valid users.
                if (ModulePermission::hasRole($coursework->module, $user, 'student') && $faker->boolean)
                {
                    // Creates submission.
                    $submission = new Submission;
                    $submission->user_id = $user->id;
                    $submission->coursework_id = $coursework->id;
                    $submission->json = json_encode(new SubmissionJson);

                    // Creates the folder path
                    $submission->file_path = 'public/coursework/' . $coursework->id . '/' . 'submissions' . '/' .  $user->id;
                    $submission->save();

                    // Copies over a random number of the example seed files into the submission folder.
                    $filesToCopy = $faker->numberBetween($min = 1, $max = sizeof($files));
                    for ($x = 0; $x < $filesToCopy; $x++)
                    {
                        Storage::copy(str_replace("var/www/html/storage/app/", "", $files[$x]), $submission->file_path);
                    }
                }
            }
        }
    }
}
