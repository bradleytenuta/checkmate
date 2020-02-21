<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coursework;
use App\Module;
use App\Submission;
use App\Utility\ModulePermission;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Utility\Time;
use Redirect;

class CourseworkController extends Controller
{
    /**
     * Shows the correct coursework.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        // Finds the coursework by the given id. Then gets the module that coursework belongs to.
        $coursework = Coursework::findOrFail($id);
        $module = $coursework->module;

        // If the coursework hasnt started yet 
        // and the user is a student
        if(Time::dateInFuture($coursework) &&
            ModulePermission::hasRole($module, Auth::user(), 'student'))
        {
            return Redirect::back();
        }

        // If the user is not in the module.
        if (!Auth::user()->isInModule($module))
        {
            return Redirect::back();
        }

        return view('pages.coursework', ['coursework' => $coursework]);
    }

    /**
     * Shows the create coursework view.
     */
    public function showCreateCoursework($module_id)
    {
        // Gets the module to add the coursework to.
        $module = Module::findOrFail($module_id);

        // Checks to see if the user has the admin role.
        if (Auth::user()->hasAdminRole() || ModulePermission::hasPermission(5, $module, Auth::user()))
        {
            return view('pages.create.coursework', ['module' => $module]);
        } else
        {
            return Redirect::back();
        }
    }

    /**
     * The POST function for creating a coursework.
     */
    public function createCoursework(Request $request)
    {
        // Validates the request. Makes sure the content is valid.
        $this->validationCheck($request);
        $request->validate([
            'module_id' => ['required', 'integer']
        ]);

        // Finds the module to add the coursework to.
        $module = Module::findOrFail($request['module_id']);
        
        // Creates the coursework
        $coursework = new Coursework;
        $coursework->name = $request['name'];
        $coursework->description = $request['description'];
        $coursework->maximum_score = $request['maximum_score'];
        $coursework->deadline = $request['deadline'];
        $coursework->start_date = $request['start_date'];
        $coursework->module_id = $module->id;
        
        // Saves the coursework to the database.
        $coursework->save();

        // Redirects the user back to the module.
        return redirect()->route('module.show', ['id' => $module->id]);
    }

    /**
     * Shows the edit coursework view.
     */
    public function showEditCoursework($id)
    {
        // Finds the coursework and the module.
        $coursework = Coursework::findOrFail($id);
        $module = $coursework->module;

        // Checks to see if the user has the admin role.
        // Or has permission to edit the module.
        if (Auth::user()->hasAdminRole() || ModulePermission::hasPermission(8, $module, Auth::user()))
        {
            return view('pages.edit.coursework', ['coursework' => $coursework]);
        } else
        {
            return Redirect::back();
        }
    }

    /**
     * The post function for editing a piece of coursework.
     */
    public function editCoursework(Request $request)
    {
        // Validates the request. Makes sure the content is valid.
        $this->validationCheck($request);
        $request->validate([
            'id' => ['required', 'integer']
        ]);

        // Edits the coursework
        $coursework = Coursework::findOrFail($request['id']);
        $coursework->name = $request['name'];
        $coursework->description = $request['description'];
        $coursework->maximum_score = $request['maximum_score'];
        $coursework->deadline = $request['deadline'];
        $coursework->start_date = $request['start_date'];

        // Saves the coursework to the database.
        $coursework->save();

        // Redirects the user back to the coursework page.
        return redirect()->route('coursework.show', ['id' => $coursework->id]);
    }

    /**
     * The POST function for deleting a coursework.
     */
    public function deleteCoursework($id)
    {
        // Finds the coursework and the coursework.
        $coursework = Coursework::findOrFail($id);
        $module = $coursework->module;

        // Checks the user has permission to delete the coursework.
        if (!Auth::user()->hasAdminRole() && !ModulePermission::hasPermission(6, $module, Auth::user()))
        {
            throw ValidationException::withMessages(['Delete Fail' => 'The current user does not have permission to delete the module.']);
        }

        // Deletes the coursework.
        $this->delete($coursework->id);

        // Redirects to the module of the deleted coursework.
        return Redirect::route('module.show', ['id' => $module->id]);
    }

    /**
     * Checks that all the infromation entered for creating or editing a coursework is valid.
     */
    private function validationCheck(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'maximum_score' => ['required', 'integer'],
            'deadline' => ['required', 'string', 'date'],
            'start_date' => ['required', 'string', 'date']
        ]);

        $current_date = new DateTime();
        $start_date = new DateTime($coursework->start_date);
        $deadline = new DateTime($coursework->deadline);

        // Checks both dates are not in the past.
        if ($start_date < $current_date || $deadline < $current_date)
        {
            throw ValidationException::withMessages(['Invalid Date' => 'Date is in the past.']);
        }

        // Checks that the start date is before the deadline.
        if ($start_date > $deadline)
        {
            throw ValidationException::withMessages(['Invalid Date' => 'Start Date should be before deadline.']);
        }
    }

    /**
     * The function that deletes a coursework and all traces of it from other database tables.
     */
    private function delete($courseworkId)
    {
        Submission::where('coursework_id', $courseworkId)->delete();
        Coursework::where('id', $courseworkId)->delete();
    }

    /**
     * This function is called when a submission is uploaded.
     */
    public function storeSubmission(Request $request)
    {
        $request->validate([
              'file' => 'required|mimes:zip',
              'coursework_id' => 'required',
        ]);

        // Finds the coursework this submission will be associated with.
        $coursework = Coursework::findOrFail($request['coursework_id']);

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
        return redirect()->route('coursework.show', ['id' => $coursework->id]);
    }
}