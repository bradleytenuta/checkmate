<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coursework;
use App\Module;
use App\Submission;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
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

        if (Auth::user()->isInModule($module))
        {
            return view('pages.coursework', ['coursework' => $coursework]);
        } else
        {
            return Redirect::back();
        }
    }

    public function showCreateCoursework($module_id)
    {
        // Gets the module to add the coursework to.
        $module = Module::findOrFail($module_id);

        // Checks to see if the user has the admin role.
        if (Auth::user()->hasAdminRole() || Auth::user()->hasModulePermission(5, $module))
        {
            return view('pages.create.coursework', ['module' => $module]);
        } else
        {
            return Redirect::back();
        }
    }

    public function createCoursework(Request $request)
    {
        // Validates the request. Makes sure the content is valid.
        // TODO: Make sure the deadline is in valid order. Make sure not in the past.
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'maximum_score' => 'required',
            'deadline' => 'required',
            'module_id' => 'required'
        ]);

        // Finds the module to add the coursework to.
        $module = Module::findOrFail($request['module_id']);
        
        // Creates the coursework
        $coursework = new Coursework;
        $coursework->name = $request['name'];
        $coursework->description = $request['description'];
        $coursework->maximum_score = $request['maximum_score'];
        $coursework->deadline = $request['deadline'];
        $coursework->module_id = $module->id;
        
        // Saves the coursework to the database.
        $coursework->save();

        // Redirects the user back to the module.
        return redirect()->route('module.show', ['id' => $module->id]);
    }

    public function showEditCoursework($id)
    {
        // Finds the coursework and the module.
        $coursework = Coursework::findOrFail($id);
        $module = $coursework->module;

        // Checks to see if the user has the admin role.
        // Or has permission to edit the module.
        if (Auth::user()->hasAdminRole() || Auth::user()->hasModulePermission(8, $module))
        {
            return view('pages.edit.coursework', ['coursework' => $coursework]);
        } else
        {
            return Redirect::back();
        }
    }

    public function editCoursework(Request $request)
    {
        // Validates the request. Makes sure the content is valid.
        // TODO: Make sure the deadline is in valid order. Make sure not in the past.
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'maximum_score' => 'required',
            'deadline' => 'required',
            'id' => 'required'
        ]);

        // Edits the coursework
        $coursework = Coursework::findOrFail($request['id']);
        $coursework->name = $request['name'];
        $coursework->description = $request['description'];
        $coursework->maximum_score = $request['maximum_score'];
        $coursework->deadline = $request['deadline'];

        // Saves the coursework to the database.
        $coursework->save();

        // Redirects the user back to the coursework page.
        return redirect()->route('coursework.show', ['id' => $coursework->id]);
    }

    public function deleteCoursework($id)
    {
        // Finds the coursework and the coursework.
        $coursework = Coursework::findOrFail($id);
        $module = $coursework->module;

        // Checks the user has permission to delete the coursework.
        if (!Auth::user()->hasAdminRole() && !Auth::user()->hasModulePermission(6, $module))
        {
            throw ValidationException::withMessages(['Delete Fail' => 'The current user does not have permission to delete the module.']);
        }

        // Deletes the coursework.
        $this->delete($coursework->id);

        // Redirects to the module of the deleted coursework.
        return Redirect::route('module.show', ['id' => $module->id]);
    }

    private function delete($courseworkId)
    {
        Submission::where('coursework_id', $courseworkId)->delete();
        Coursework::where('id', $courseworkId)->delete();
    }
}
