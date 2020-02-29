<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utility\CourseworkPermission;
use App\Module;
use App\Coursework;
use App\Submission;

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

        // Shows the view.
        return view('pages.viewer', ['submission' => $submission, 'isMarkable' => true]);
    }

    public function saveMark($module_id, $coursework_id, $submission_id, Request $request)
    {
        dd("Hello World!");
    }
}
