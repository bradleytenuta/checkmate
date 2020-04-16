<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Utility\CourseworkPermission;
use App\Utility\ModulePermission;
use App\Utility\FileSystem;
use App\Module;
use App\Coursework;
use App\Submission;
use App\Test;
use File;
use Redirect;
use Illuminate\Validation\ValidationException;

class ViewerController extends Controller
{
    /**
     * This shows the viewer view for someone who can mark a given submission.
     */
    public function showMark($module_id, $coursework_id, $submission_id)
    {
        $module = Module::findOrFail($module_id);
        $coursework = Coursework::findOrFail($coursework_id);
        $submission = Submission::findOrFail($submission_id);

        // Checks the user has permission to mark.
        if (!CourseworkPermission::canMark($module))
        {
            throw ValidationException::withMessages(['Permission Fail' => 'The current user does not have permission to mark this coursework.']);
        }

        // Gets all the files from the submission.
        $files = FileSystem::extractSubmissionToFiles($submission);

        // Shows the view.
        return view('pages.viewer', ['submission' => $submission, 'coursework' => $coursework, 'isMarkable' => true, 'files' => $files]);
    }

    /**
     * This function allows the user to view a given submission in student view.
     */
    public function showStudent($module_id, $coursework_id, $submission_id)
    {
        $module = Module::findOrFail($module_id);
        $coursework = Coursework::findOrFail($coursework_id);
        $submission = Submission::findOrFail($submission_id);

        // Checks the user has permission to use the student view.
        if (!ModulePermission::hasRole($module, Auth::user(), 'student'))
        {
            throw ValidationException::withMessages(['Permission Fail' => 'The current user does not have permission to mark this coursework.']);
        }

        // Checks the student is viewing their own submission.
        if ($submission->user->id != Auth::user()->id)
        {
            throw ValidationException::withMessages(['Permission Fail' => 'The current user can only view their own submission.']);
        }

        // Gets all the files from the submission.
        $files = FileSystem::extractSubmissionToFiles($submission);

        // Shows the view.
        return view('pages.viewer', ['submission' => $submission, 'coursework' => $coursework, 'isMarkable' => false, 'files' => $files]);
    }

    /**
     * This function allows the user to view the source code of a given test within the viewer.
     */
    public function showTest($module_id, $coursework_id, $test_id)
    {
        $coursework = Coursework::findOrFail($coursework_id);
        $module = Module::findOrFail($module_id);
        $test = Test::findOrFail($test_id);

        // Checks the user has permission to mark.
        if (!CourseworkPermission::canMark($module) && !ModulePermission::hasRole($coursework->module, Auth::user(), 'student'))
        {
            throw ValidationException::withMessages(['Permission Fail' => 'The current user does not have permission to mark this coursework.']);
        }

        // Gets zip file and extracts those tests into a list of files.
        $files = FileSystem::extractTest($coursework_id, $test_id);

        // Shows the view.
        return view('pages.viewer', ['submission' => null, 'coursework' => $coursework, 'isMarkable' => false, 'files' => $files]);
    }

    /**
     * This function saves the mark from the viewer form.
     */
    public function saveMark($module_id, $coursework_id, $submission_id, Request $request)
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

        // Saves the score if one was given.
        if ($request["score"] != null) {
            $submission->score = $request["score"];
        }

        // Saves the main feedback if one was given.
        if ($request["main_feedback"] != null) {
            $submission->main_feedback = $request["main_feedback"];
        }

        // Saves the current user as the most recent marker.
        $submission->marker_id = Auth::user()->id;

        // Creates an array from the comments and then adds them to the json object.
        $jsonObj = json_decode($submission->json);
        // Creates an array of all line comments
        $lineComments = array();
        $request_input = array_slice($request->input(), 3); // removes the first 3 elements from request input.
        foreach($request_input as $lineNumber => $comment)
        {
            // Adds the values to the array
            $lineComments[$lineNumber] = $comment;
        }
        $jsonObj->comments = $lineComments;
        $submission->json = json_encode($jsonObj);

        // Saves the submission
        $submission->save();

        // Redirects back to the viewer.
        return Redirect::back();
    }
}
