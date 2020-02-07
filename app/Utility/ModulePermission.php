<?php

namespace App\Utility;

use Illuminate\Support\Facades\DB;
use App\ModuleRole;

class ModulePermission
{
    private static $permissionIconPathMap = array("student" => "/images/icon/module-icon-student.png", "professor" => "/images/icon/module-icon-professor.png", "assessor" => "/images/icon/module-icon-assessor.png");
    private static $permissionTextMap = array("student" => "Student", "professor" => "Professor", "assessor" => "Assessor");

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

    public static function permissionIconPath($module, $user)
    {
        // Gets the module role.
        $module_role_id = ModulePermission::getModuleRoleId($user, $module);
        $moduleRole = ModuleRole::findOrFail($module_role_id);

        // Uses the key to get the icon path from the map.
        dd($permissionIconPathMap[$moduleRole->name]);
        return $permissionIconPathMap[$moduleRole->name];
    }

    public static function permissionText($module, $user) {

        // Gets the module role.
        $module_role_id = ModulePermission::getModuleRoleId($user, $module);
        $moduleRole = ModuleRole::findOrFail($module_role_id);

        // Uses the key to get the icon path from the map.
        return $permissionTextMap[$moduleRole->name];
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