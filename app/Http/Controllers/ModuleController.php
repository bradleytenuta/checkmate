<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use App\ModuleRole;

class ModuleController extends Controller
{
    /**
     * Shows the correct module.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        // Finds the module by the given id.
        $module = Module::findOrFail($id);

        if (Auth::user()->isInModule($module))
        {
            return view('auth/module', ['module' => $module]);
        } else
        {
            return Redirect::back();
        }
    }

    public function showCreateModule()
    {
        // Checks to see if the user has the admin role.
        if (Auth::user()->hasAdminRole())
        {
            return view('pages.create.module');
        }
    }

    public function createModule(Request $request)
    {
        // Validation check to see if values were entered correctly.
        $this->validationCheck($request);

        // Gets the assigned values from the request.
        $userIdAndRoleIds = $this->getAssignValues($request);
        
        // Creates the module
        $module = new Module;
        $module->name = $request['name'];
        $module->description = $request['description'];
        
        // Saves the module to the database.
        $module->save();

        // Applys the assigned values to the database relationship.
        $this->applyAssignedValues($userIdAndRoleIds, $module);

        // Redirects the user back to the home page.
        return redirect()->route('home');
    }

    private function validationCheck(Request $request)
    {
        // Checks to make sure the user has the admin role.
        if (!Auth::user()->hasAdminRole())
        {
            throw ValidationException::withMessages(['Admin Rights needed' => 'The user does not have perission to create a module.']);
        }

        // Validates the request. Makes sure the content is valid.
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        // Removes the first few elements that arnt assigns from the array.
        $allroleAssignInputs = array_slice($request->input(), 3);

        // If there is no professor assigned.
        $result = array_search('professor', $allroleAssignInputs);
        if ($result == false && $result != 0)
        {
            throw ValidationException::withMessages(['Assign Fail' => 'A Professor must be assigned to the module.']);
        }
    }

    private function getAssignValues($request)
    {
        // Creates an array of all user ids and their assigned roles.
        $userIdAndRoleIds = array();

        foreach($request->input() as $userId => $modulePermissionId)
        {
            // If the key is not a user id then skip to next value in loop.
            if (!is_int($userId)) {
                continue;
            }

            // Adds the values to the array
            $userIdAndRoleIds[$userId] = $modulePermissionId;
        }

        return $userIdAndRoleIds;
    }

    private function applyAssignedValues($userIdAndRoleIds, $module)
    {
        // Adds the users to the modules by adding them to the modules_users table in the database.
        foreach($userIdAndRoleIds as $userId => $moduleRoleId)
        {
            DB::table('module_user')->updateOrInsert(
                ['module_id' => $module->id, 'user_id' => $userId],
                ['module_role_id' => $moduleRoleId]
            );
        }
    }

    public function showEditModule($id)
    {
        // Finds the module by the given id.
        $module = Module::findOrFail($id);

        // Checks to see if the user has the admin role.
        // Or has permission to edit the module.
        if (Auth::user()->hasAdminRole() || Auth::user()->hasModulePermission(5, $module))
        {
            return view('pages.edit.module', ['module' => $module]);
        } else
        {
            return Redirect::back();
        }
    }

    public function editModule(Request $request)
    {
        // Validation check to see if values were entered correctly.
        $this->validationCheck($request);

        // Also checks that the module ID was passed through
        $request->validate([
            'id' => 'required'
        ]);

        // Gets the assigned values from the request.
        $userIdAndRoleIds = $this->getAssignValues($request);

        // Edits the module
        $module = Module::findOrFail($request['id']);
        $module->name = $request['name'];
        $module->description = $request['description'];

        // Saves the module to the database.
        $module->save();

        // Applys the assigned values to the database relationship.
        $this->applyAssignedValues($userIdAndRoleIds, $module);

        // Redirects the user back to the module page.
        return redirect()->route('module.show', ['id' => $module->id]);
    }
}