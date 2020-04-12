<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coursework;
use App\Submission;
use App\Module;
use App\Json\SubmissionJson;
use App\Utility\ModulePermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;

class SubmissionController extends Controller
{
    /**
     * This function is called when a submission is uploaded.
     */
    public function createSubmission($module_id, $coursework_id, Request $request)
    {
        $request->validate([
              'file' => 'required|mimes:zip',
              'coursework_id' => 'required',
        ]);

        // Finds the coursework this submission will be associated with.
        $coursework = Coursework::findOrFail($request['coursework_id']);
        $module = Module::findOrFail($module_id);

        // Checks that the person making the submission is a student in the module
        if (!ModulePermission::hasRole($module, Auth::user(), 'student'))
        {
            throw ValidationException::withMessages(['Submission Fail' => 'The current user does not have permission to submit work.']);
        }

        // Checks that the coursework is still open.
        if (!$coursework->open)
        {
            throw ValidationException::withMessages(['Submission Fail' => 'The coursework is not open and so the user cannot submit work.']);
        }

        // Gets the first submission found or creates a new one.
        $submission = Submission::firstOrNew(['coursework_id' => $coursework->id, 'user_id' => Auth::user()->id]);
        // Resets feedback as there has been a new submission.
        $submission->json = json_encode(new SubmissionJson);
        $submission->score = null;
        $submission->main_feedback = null;
        $submission->marker_id = null;
        $submission->save();

        // Deletes old file before uploading new one.
        $zipFiles = File::files(storage_path('app/' . $submission->file_path));
        File::delete($zipFiles);

        // Saves the folder path where the submission files can be found.
        $submission->file_path = 'public/coursework/' . $coursework->id . '/' . 'submissions' . '/' .  Auth::user()->id;
        $submission->save();

        // Saves the zip file.
        $request->file->store($submission->file_path);

        // Redirects the user back to the coursework page.
        return redirect()->route('coursework.show', ['module_id' => $module_id, 'coursework_id' => $coursework->id]);
    }
}
