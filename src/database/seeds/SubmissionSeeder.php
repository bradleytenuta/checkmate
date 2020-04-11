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
    public function run()
    {
        // Creates the submissions.
        $this->createSubmissions();

        // Marks some of the submissions.
        $this->markSubmissions();
    }

    /**
     * This function creates a submission for a random number of students
     * within a coursework.
     */
    private function createSubmissions()
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
                    $submission->file_path = 'public/coursework/' . $coursework->id . '/' . 'submissions' . '/' .  $user->id . "/";
                    $submission->save();

                    // Copies over a random number of the example seed files into the submission folder.
                    $filesToCopy = $faker->numberBetween($min = 1, $max = sizeof($files));
                    for ($x = 0; $x < $filesToCopy; $x++)
                    {
                        $filepath = $files[$x];
                        $filename = basename($filepath);

                        $filepath = str_replace("var/www/html/storage/app/", "", $filepath); // For Nginx server.
                        $filepath = str_replace("opt/atlassian/pipelines/agent/build/src/storage/app/", "", $filepath); // For bitbucket pipelines server.
                        Storage::copy($filepath, $submission->file_path . $filename);
                    }
                }
            }
        }
    }

    /**
     * This function goes through a random number of submissions within a coursework
     * and marks them.
     */
    private function markSubmissions()
    {
        // Creates a faker object. Its used for random booleans.
        $faker = Faker::create();

        foreach (Coursework::all() as $coursework)
        {
            foreach ($coursework->submissions as $submission)
            {
                // Only marks a random number of submissions.
                if ($faker->boolean)
                {
                    continue;
                }

                // Finds a user who is an assessor or professor in module
                // and uses them as the marker.
                foreach ($coursework->module->users->shuffle() as $user)
                {
                    if (ModulePermission::hasRole($coursework->module, $user, 'professor') ||
                        ModulePermission::hasRole($coursework->module, $user, 'assessor'))
                    {
                        $submission->marker_id = $user->id;
                        break;
                    }
                }

                // Uses a random sentence as main feedback.
                $submission->main_feedback = $faker->sentence($nbWords = 12, $variableNbWords = true);

                // Gets a random number as a score.
                $submission->score = $faker->numberBetween($min = 0, $max = $coursework->maximum_score);

                // Decodes the json object in the submission.
                $jsonObj = json_decode($submission->json);
                $lineComments = array(); // Creates an array of all line comments
                $lineComments[0] = $faker->sentence($nbWords = 4, $variableNbWords = true); // Creates a random comment for line 1.
                $jsonObj->comments = $lineComments; // Saves the comments to the object.
                $submission->json = json_encode($jsonObj);

                $submission->save();
            }
        }
    }
}