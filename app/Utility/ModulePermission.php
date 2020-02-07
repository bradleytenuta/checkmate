<?php

namespace App\Utility;

use Illuminate\Support\Facades\DB;
use App\ModuleRole;

class ModulePermission
{
    public static function hasRole($module, $user, $roleName)
    {
        // Checks to see if user is in module.
        if ($user->isInModule($module))
        {
            // Checks if the user has the given role.
            $module_role_id = DB::table('module_user')
                ->where('user_id', $user->id)
                ->where('module_id', $module->id)
                ->first()
                ->module_role_id;

            if (ModuleRole::where('name', $roleName)->first()->id == $module_role_id)
            {
                return true;
            }
        }
        return false;
    }
}