<?php

namespace App\Utility;

use Illuminate\Support\Facades\DB;
use App\ModuleRole;

class ModulePermission
{
    /**
     * These maps contain information depending on what role the user has within a module.
     */
    private static $permissionIconPathMap = array("student" => "/images/icon/module-icon-student.png", "professor" => "/images/icon/module-icon-professor.png", "assessor" => "/images/icon/module-icon-assessor.png");
    private static $permissionTextMap = array("student" => "Student", "professor" => "Professor", "assessor" => "Assessor");

    /**
     * Checks whether a user has a given role within a module.
     */
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

    /**
     * When given a permission id, whether the user has that permission within the module.
     */
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

    /**
     * Returns the path for the given permission icon.
     */
    public static function permissionIconPath($module, $user)
    {
        // Gets the module role.
        $module_role_id = ModulePermission::getModuleRoleId($user, $module);
        $moduleRole = ModuleRole::findOrFail($module_role_id);

        // Uses the key to get the icon path from the map.
        return ModulePermission::$permissionIconPathMap[$moduleRole->name];
    }

    /**
     * Returns the given text for the module permission the user has within the module.
     */
    public static function permissionText($module, $user)
    {
        // Gets the module role.
        $module_role_id = ModulePermission::getModuleRoleId($user, $module);
        $moduleRole = ModuleRole::findOrFail($module_role_id);

        // Uses the key to get the icon path from the map.
        return ModulePermission::$permissionTextMap[$moduleRole->name];
    }

    /**
     * This function is used by the other functions in this class.
     * It gets a users role within a module.
     */
    private static function getModuleRoleId($user, $module)
    {
        return DB::table('module_user')
            ->where('user_id', $user->id)
            ->where('module_id', $module->id)
            ->first()
            ->module_role_id;
    }
}