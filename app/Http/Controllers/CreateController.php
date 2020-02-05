<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use App\Module;
use App\ModuleRole;

class CreateController extends Controller
{
    public function showModuleForm()
    {
        // Checks to see if the user has the admin role.
        if (Auth::user()->hasAdminRole())
        {
            return view('auth.create.module');
        }
    }

    public function createModule(Request $request)
    {
        // Validation check to see if values were entered correctly.
        $this->validationCheck($request);

        // Creates an array of all user ids and their assigned roles.
        $userIdAndRoleIds = array();

        foreach($request->input() as $userId => $value)
        {
            // If the key is not a user id then skip to next value in loop.
            if (!is_int($userId)) {
                continue;
            }

            // Gets the permission based on the value entered.
            $modulePermissionId = ModuleRole::where('name', $value)->first()->id;

            // Adds the values to the array
            $userIdAndRoleIds[$userId] = $modulePermissionId;
        }
        
        // Creates the module
        $module = new Module;
        $module->name = $request['name'];
        $module->description = $request['description'];
        
        // Saves the module to the database.
        $module->save();

        // Adds the users to the modules by adding them to the modules_users table in the database.
        foreach($userIdAndRoleIds as $userId => $moduleRoleId)
        {
            DB::table('module_user')->insert([
                'module_id' => $module->id,
                'user_id' => $userId,
                'module_role_id' => $moduleRoleId
            ]);
        }

        // Redirects the user back to the home page.
        return redirect()->route('home');
    }

    public function validationCheck(Request $request)
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
}
