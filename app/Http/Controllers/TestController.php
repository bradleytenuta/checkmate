<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\Coursework;
use App\Test;
use App\Utility\CourseworkPermission;
use App\Utility\CourseworkType;
use Illuminate\Support\Facades\Storage;
use Redirect;

class TestController extends Controller
{
    /**
     * Shows the create test view.
     */
    public function showCreateTest($module_id, $coursework_id)
    {
        // Gets the module.
        $module = Module::findOrFail($module_id);

        // Gets the coursework.
        $coursework = Coursework::findOrFail($coursework_id);

        // Checks to see if the user has the right permission.
        if (CourseworkPermission::canCreate($module))
        {
            return view('pages.create.test', ['module' => $module, 'coursework' => $coursework]);
        } else
        {
            return Redirect::back();
        }
    }

    /**
     * Creates the test provided by the create test view.
     */
    public function createTest($module_id, $coursework_id, Request $request)
    {
        // Gets the module.
        $module = Module::findOrFail($module_id);

        // Gets the coursework.
        $coursework = Coursework::findOrFail($coursework_id);

        // Checks to see if the file contains the .java extension.
        $filename = $request->file->getClientOriginalName();
        $correct_file_type = CourseworkType::getTestFileExtension($coursework->coursework_type_id);
        if (!(strpos($filename, "." . $correct_file_type) == true))
        {
            throw ValidationException::withMessages(['Invalid File Type' => 'File is not of type ' . $correct_file_type]);
        }

        // Validation of the form.
        $request->validate([
            'test_type' => 'required',
        ]);

        // Creates the test
        $test = new Test;
        $test->public = ($request['test_type'] == "true");
        $test->coursework_id = $coursework->id;
        $test->file_name = $filename;
        // Saves the test to the database.
        // This is done beforehand so we have an id assgined to it.
        $test->save();

        // Saves the test again but with the file attached this time.
        $test->file_path = $request->file->storeAs(
            'public/coursework/' . $coursework->id . '/' . 'tests' . '/' .  $test->id,
            $filename
        );
        $test->save();

        // Redirects the user back to the coursework page.
        return redirect()->route('coursework.show', ['module_id' => $module_id, 'coursework_id' => $coursework_id]);
    }

    /**
     * This function deletes the test provided.
     */
    public function deleteTest($module_id, $coursework_id, $test_id)
    {
        // Finds the coursework and the coursework.
        $coursework = Coursework::findOrFail($coursework_id);
        $module = Module::findOrFail($module_id);
        $test = Test::findOrFail($test_id);
        if ($module->id != $coursework->module->id)
        {
            throw ValidationException::withMessages(['Moudle ID error' => 'The provided module ID does not match the coursework module.']);
            return Redirect::back();
        }

        // Checks the user has permission to delete the coursework.
        if (!CourseworkPermission::canDelete($module))
        {
            throw ValidationException::withMessages(['Delete Fail' => 'The current user does not have permission to delete the module.']);
        }

        // Deletes the file
        Storage::delete($test->file_path);

        // Deletes the test
        $test->delete();

        return Redirect::back();
    }
}
