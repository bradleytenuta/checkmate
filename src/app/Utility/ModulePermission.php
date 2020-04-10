<?php

namespace App\Utility;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\ModuleRole;

class ModulePermission
{
    /**
     * These maps contain information depending on what role the user has within a module.
     */
    private static $permissionIconPathMap = array("student" => "/images/icon/module-icon-student.png", "professor" => "/images/icon/module-icon-professor.png", "assessor" => "/images/icon/module-icon-assessor.png", "null" => "/images/icon/no-permission.png");
    private static $permissionTextMap = array("student" => "Student", "professor" => "Professor", "assessor" => "Assessor", "null" => "No Role");

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

            // if null then user does not have any role in the module
            if ($module_role_id == null)
            {
                return false;
            }

            if (ModuleRole::where('name', $roleName)->first()->id == $module_role_id)
            {
                return true;
            }
        }
        return false;
    }

    /**
     * Returns the path for the given permission icon.
     */
    public static function permissionIconPath($module, $user)
    {
        // Gets the module role.
        $module_role_id = ModulePermission::getModuleRoleId($user, $module);

        // If null then return no permission icon path.
        if ($module_role_id == null)
        {
            return ModulePermission::$permissionIconPathMap["null"];
        }

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

        // If null then return no permission text.
        if ($module_role_id == null)
        {
            return ModulePermission::$permissionTextMap["null"];
        }

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
        $module = DB::table('module_user')
                    ->where('user_id', $user->id)
                    ->where('module_id', $module->id)
                    ->first();

        if ($module == null)
        {
            return null;
        }

        return $module->module_role_id;
    }

    /**
     * Checks that the current user can edit a module.
     */
    public static function canEdit($module)
    {
        // If the user is admin and a student in the module then module 
        if (ModulePermission::isStudentAdmin($module)) {
            return false;
        }

        if (Auth::user()->hasAdminRole() || ModulePermission::hasRole($module, Auth::user(), "professor"))
        {
            return true;
        }
        return false;
    }

    /**
     * Checks to see if the user can delete the module.
     */
    public static function canDelete($module)
    {
        // If the user is admin and a student in the module then module 
        if (ModulePermission::isStudentAdmin($module)) {
            return false;
        }

        if (Auth::user()->hasAdminRole() || ModulePermission::hasRole($module, Auth::user(), "professor"))
        {
            return true;
        }
        return false;
    }

    /**
     * Checks to see if the user can create a module.
     */
    public static function canCreate()
    {
        return Auth::user()->hasAdminRole();
    }

    /**
     * Checks to see if the user can view the module.
     */
    public static function canShow($module)
    {
        return Auth::user()->isInModule($module) || Auth::user()->hasAdminRole();
    }

    /**
     * Checks to see if the user is an admin and a student.
     */
    public static function isStudentAdmin($module)
    {
        return Auth::user()->hasAdminRole() && ModulePermission::hasRole($module, Auth::user(), 'student');
    }
}