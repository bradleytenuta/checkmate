<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Submission;
use App\Coursework;

class SubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // TODO: Clean up to users only create submissions if they have correct permissions.
    // TODO: Create submissions that have already been marked and completed.
    public function run()
    {
        // Loops through all the courseworks, gathers some of its users and adds submissions for them.
        foreach (Coursework::all() as $coursework)
        {
            // Gets half of the users on the module.
            $allUsers = $coursework->module->users;
            $usersLength = $allUsers->count();
            $halfUserLength = (int) $usersLength / 2;

            // Loops through all the users that are left and create submissions for them.
            foreach ($allUsers as $key => $user)
            {
                // If the half way point is reached then break.
                if ($halfUserLength == $key)
                {
                    break;
                }

                // Creates submission.
                $submission = new Submission;
                $submission->user_id = $user->id;
                $submission->coursework_id = $coursework->id;

                // Adds the file to the submission
                $newFilePath = 'public/coursework/' . $submission->coursework->id . '/' .
                    'submissions' . '/' .  $submission->user->id . '/ExampleSubmission.zip';
                Storage::copy('public/seeding/ExampleSubmission.zip', $newFilePath);
                $submission->file_path = $newFilePath;

                // Saves the submission.
                $submission->save();
            }
        }
    }
}
