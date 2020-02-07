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
            $module_role_id = ModulePermission::getModuleRoleId($user, $module);

            if (ModuleRole::where('name', $roleName)->first()->id == $module_role_id)
            {
                return true;
            }
        }
        return false;
    }

    public static function hasPermission($id, $module, $user)
    {
        // Gets the users role within the module.
        $module_role_id = ModulePermission::getModuleRoleId($user, $module);

        // Gets all the permissions that belong to the module role.
        return $permission_module_role_rows = DB::table('module_roles_permissions')
            ->where('module_roles_id', $module_role_id)
            ->where('permission_id', $id)
            ->get()
            ->isNotEmpty();
    }

    private static function getModuleRoleId($user, $module)
    {
        return DB::table('module_user')
            ->where('user_id', $user->id)
            ->where('module_id', $module->id)
            ->first()
            ->module_role_id;
    }
}