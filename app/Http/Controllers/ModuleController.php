<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\Utility\ModulePermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use App\ModuleRole;
use App\User;
use App\Coursework;
use Redirect;

class ModuleController extends Controller
{
    /**
     * Shows the correct module.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($module_id)
    {
        // Finds the module by the given id.
        $module = Module::findOrFail($module_id);

        // Shows the module page if the user is assigned to that module or is an admin.
        if (ModulePermission::canShow($module))
        {
            return view('pages.module', ['module' => $module]);
        } else
        {
            return Redirect::back();
        }
    }

    /**
     * Shows the create module view.
     */
    public function showCreateModule()
    {
        // Checks to see if the user has the admin role.
        if (ModulePermission::canCreate())
        {
            return view('pages.create.module');
        } else
        {
            return Redirect::back();
        }
    }

    /**
     * Returns an admin view that allows them to view all modules and courseworks.
     */
    public function showAll()
    {
        // Checks to see if the user has the admin role.
        if (ModulePermission::canCreate())
        {
            // Gets all the modules in the database and returns them.
            $modules = Module::all();
            return view('pages.admin.modules-all', ['modules' => $modules]);
        } else
        {
            return Redirect::back();
        }
    }

    /**
     * The post function used for creating a module.
     */
    public function createModule(Request $request)
    {
        // Validation check to see if values were entered correctly.
        $this->validationCheck($request);

        // Gets the assigned values from the request.
        $userIdAndRoleIds = $this->getAssignValues($request);

        // Checks the user has permission to create a module
        if (!ModulePermission::canCreate())
        {
            throw ValidationException::withMessages(['Permission Fail' => 'The current user does not have permission to create a module.']);
        }
        
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

    /**
     * This function checks that the user has rights to create a module
     * and that everything was entered in correctly.
     */
    private function validationCheck(Request $request)
    {
        // Checks to make sure the user has the admin role.
        if (!Auth::user()->hasAdminRole())
        {
            throw ValidationException::withMessages(['Admin Rights needed' => 'The user does not have perission to create a module.']);
        }

        // Validates the request. Makes sure the content is valid.
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string']
        ]);

        // Removes the first few elements that arnt assigns from the array.
        $allroleAssignInputs = array_slice($request->input(), 3);

        // If there is no professor assigned.
        if (!in_array(ModuleRole::where('name', 'professor')->first()->id, $allroleAssignInputs))
        {
            throw ValidationException::withMessages(['Assign Fail' => 'A Professor must be assigned to the module.']);
        }
    }

    /**
     * This function gets all the assigned values from the select user table.
     */
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

    /**
     * This function applies those users to the module bu adding them
     * to the relationship table.
     */
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

        // Goes through all the users in the database.
        // If the user is not in the list assigned list
        // then remove them from the module relationship, 
        // incase they used to be part of the module.
        foreach(User::all() as $user)
        {
            // If the user is not in the assigned list,
            // And they are in the relationship, then remove them.
            if (!in_array($user->id, array_keys($userIdAndRoleIds)) && DB::table('module_user')
                                ->where('module_id', $module->id)
                                ->where('user_id', $user->id)
                                ->exists())
            {
                DB::table('module_user')
                    ->where('module_id', $module->id)
                    ->where('user_id', $user->id)
                    ->delete();
            }
        }
    }

    /**
     * Shows the view for editing modules.
     */
    public function showEditModule($module_id)
    {
        // Finds the module by the given id.
        $module = Module::findOrFail($module_id);

        // Checks to see if the user has the admin role.
        // Or has permission to edit the module.
        if (ModulePermission::canEdit($module))
        {
            return view('pages.edit.module', ['module' => $module]);
        } else
        {
            return Redirect::back();
        }
    }

    /**
     * The post function for editing a module.
     */
    public function editModule(Request $request)
    {
        // Validation check to see if values were entered correctly.
        $this->validationCheck($request);

        // Also checks that the module ID was passed through
        $request->validate([
            'id' => ['required', 'integer']
        ]);

        // Gets the assigned values from the request.
        $userIdAndRoleIds = $this->getAssignValues($request);

        // Checks the user has permission to edit a module
        $module = Module::findOrFail($request['id']);
        if (!ModulePermission::canEdit($module))
        {
            throw ValidationException::withMessages(['Permission Fail' => 'The current user does not have permission to edit the module.']);
        }
        
        // Edits the module
        $module->name = $request['name'];
        $module->description = $request['description'];

        // Saves the module to the database.
        $module->save();

        // Applys the assigned values to the database relationship.
        $this->applyAssignedValues($userIdAndRoleIds, $module);

        // Redirects the user back to the module page.
        return redirect()->route('module.show', ['id' => $module->id]);
    }

    /**
     * The POST function for deleting a module.
     */
    public function deleteModule($module_id)
    {
        // Finds the module by the given id.
        $module = Module::findOrFail($module_id);

        // Checks the user has permission to delete the module.
        if (!ModulePermission::canDelete($module))
        {
            throw ValidationException::withMessages(['Delete Fail' => 'The current user does not have permission to delete the module.']);
        }

        // Deletes the module.
        $this->delete($module->id);

        return Redirect::route('home');
    }

    /**
     * The function that deletes the module and all traces of it in other database tables.
     */
    private function delete($moduleId)
    {
        Coursework::where('module_id', $moduleId)->delete();
        DB::table('module_user')->where('module_id', $moduleId)->delete();
        Module::where('id', $moduleId)->delete();
    }
}