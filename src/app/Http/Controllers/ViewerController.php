<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Utility\CourseworkPermission;
use App\Module;
use App\Coursework;
use App\Submission;
use File;

class ViewerController extends Controller
{
    public function showMark($module_id, $coursework_id, $submission_id)
    {
        // Finds the models from the id's.
        $module = Module::findOrFail($module_id);
        $coursework = Coursework::findOrFail($coursework_id);
        $submission = Submission::findOrFail($submission_id);

        // Checks the user has permission to mark.
        if (!CourseworkPermission::canMark($module))
        {
            throw ValidationException::withMessages(['Permission Fail' => 'The current user does not have permission to mark this coursework.']);
        }

        // Gets all the files from the submission.
        $files = File::files(storage_path($submission->file_path));

        // Shows the view.
        return view('pages.viewer', ['submission' => $submission, 'isMarkable' => true, 'files' => $files]);
    }

    public function saveMark($module_id, $coursework_id, $submission_id, Request $request)
    {
        dd("Hello World!");
    }
}