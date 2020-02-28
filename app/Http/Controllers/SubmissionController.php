<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coursework;
use App\Submission;
use App\Utility\ModulePermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $submission->save();

        // Deletes old file before uploading new one.
        Storage::delete($submission->file_path);

        // Adds the file to the submission
        $submission->file_path = $request->file->store(
            'public/coursework/' . $coursework->id . '/' . 'submissions' . '/' .  Auth::user()->id);
        $submission->save();

        // Redirects the user back to the coursework page.
        return redirect()->route('coursework.show', ['module_id' => $module_id, 'coursework_id' => $coursework->id]);
    }
}
