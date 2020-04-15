<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coursework;
use App\Module;
use App\Submission;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Utility\Time;
use App\Utility\CourseworkPermission;
use App\Utility\ModulePermission;
use Redirect;

class CourseworkController extends Controller
{
    /**
     * Shows the correct coursework.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($module_id, $coursework_id)
    {
        // Finds the coursework by the given id. Then gets the module that coursework belongs to.
        $coursework = Coursework::findOrFail($coursework_id);
        $module = Module::findOrFail($module_id);
        if ($module->id != $coursework->module->id)
        {
            throw ValidationException::withMessages(['Moudle ID error' => 'The provided module ID does not match the coursework module.']);
            return Redirect::back();
        }

        if (CourseworkPermission::canShow($coursework))
        {
            return view('pages.coursework', ['coursework' => $coursework]);
        } else 
        {
            return Redirect::back();
        }
    }

    /**
     * Shows the create coursework view.
     */
    public function showCreateCoursework($module_id)
    {
        // Gets the module to add the coursework to.
        $module = Module::findOrFail($module_id);

        // Checks to see if the user has the admin role.
        if (CourseworkPermission::canCreate($module))
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
    public function createCoursework($module_id, Request $request)
    {
        // Validates the request. Makes sure the content is valid.
        try {
            $this->validationCheck($request);
        } catch(ValidationException $exception) {
            return Redirect::back()->withErrors(['msg', 'Validation check failed!']);
        }

        $request->validate([
            'module_id' => ['required', 'integer']
        ]);

        // Finds the module to add the coursework to.
        $module = Module::findOrFail($request['module_id']);

        // Checks the user can create coursework.
        if (!CourseworkPermission::canCreate($module))
        {
            throw ValidationException::withMessages(['Permission Fail' => 'The current user does not have permission to create coursework.']);
        }
        
        // Creates the coursework
        $coursework = new Coursework;
        $coursework->name = $request['name'];
        $coursework->description = $request['description'];
        $coursework->maximum_score = $request['maximum_score'];
        $coursework->deadline = $request['deadline'];
        $coursework->start_date = $request['start_date'];
        $coursework->module_id = $module->id;
        $coursework->coursework_type_id = $request['coursework_type_id'];
        
        // Saves the coursework to the database.
        $coursework->save();

        // Redirects the user back to the module.
        return redirect()->route('module.show', ['module_id' => $module->id]);
    }

    /**
     * Shows the edit coursework view.
     */
    public function showEditCoursework($module_id, $coursework_id)
    {
        // Finds the coursework and the module.
        $coursework = Coursework::findOrFail($coursework_id);
        $module = Module::findOrFail($module_id);
        if ($module->id != $coursework->module->id)
        {
            throw ValidationException::withMessages(['Moudle ID error' => 'The provided module ID does not match the coursework module.']);
            return Redirect::back();
        }

        // Checks to see if the user has the admin role.
        // Or has permission to edit the module.
        if (ModulePermission::canEdit($module))
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
    public function editCoursework($module_id, Request $request)
    {
        // Validates the request. Makes sure the content is valid.
        $request->validate([
            'id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'maximum_score' => ['required', 'integer'],
            'deadline' => ['required', 'string', 'date'],
            'start_date' => ['required', 'string', 'date'],
            'coursework_type_id' => ['required', 'integer']
        ]);

        // Gets the coursework to edit.
        $coursework = Coursework::findOrFail($request['id']);

        // Finds the module the editing coursework belongs to.
        $module = Module::findOrFail($module_id);
        if ($module->id != $coursework->module->id)
        {
            throw ValidationException::withMessages(['Moudle ID error' => 'The provided module ID does not match the coursework module.']);
            return Redirect::back();
        }

        // Checks the user has permission to edit the coursework.
        if (!ModulePermission::canEdit($module))
        {
            throw ValidationException::withMessages(['Permission Fail' => 'The current user does not have permission to edit this coursework.']);
        }

        // Edits the coursework
        $coursework->name = $request['name'];
        $coursework->description = $request['description'];
        $coursework->maximum_score = $request['maximum_score'];
        $coursework->deadline = $request['deadline'];
        $coursework->start_date = $request['start_date'];
        $coursework->coursework_type_id = $request['coursework_type_id'];

        // Saves the coursework to the database.
        $coursework->save();

        // Redirects the user back to the coursework page.
        return redirect()->route('coursework.show', ['module_id' => $module->id, 'coursework_id' => $coursework->id]);
    }

    /**
     * The POST function for deleting a coursework.
     */
    public function deleteCoursework($module_id, $coursework_id)
    {
        // Finds the coursework and the coursework.
        $coursework = Coursework::findOrFail($coursework_id);
        $module = Module::findOrFail($module_id);
        if ($module->id != $coursework->module->id)
        {
            throw ValidationException::withMessages(['Moudle ID error' => 'The provided module ID does not match the coursework module.']);
            return Redirect::back();
        }

        // Checks the user has permission to delete the coursework.
        if (!ModulePermission::canDelete($module))
        {
            throw ValidationException::withMessages(['Delete Fail' => 'The current user does not have permission to delete the module.']);
        }

        // Deletes the coursework.
        $this->delete($coursework->id);

        // Redirects to the module of the deleted coursework.
        return Redirect::route('module.show', ['module_id' => $module->id]);
    }

    /**
     * This function runs moss for the submissions within the coursework.
     * This is done automatically when the courseworks deadline is passed.
     * However this is a manual approach.
     */
    public function runMoss($module_id, $coursework_id)
    {
        $coursework = Coursework::findOrFail($coursework_id);
        $coursework->runMoss();
        return Redirect::back();
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
            'start_date' => ['required', 'string', 'date'],
            'coursework_type_id' => ['required', 'integer']
        ]);

        $current_date = date("Y-m-d");
        $start_date = $request['start_date'];
        $deadline = $request['deadline'];

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
}