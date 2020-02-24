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
     * When given a permission id, whether the user has that permission within the module.
     */
    public static function hasPermission($id, $module, $user)
    {
        // Gets the users role within the module.
        $module_role_id = ModulePermission::getModuleRoleId($user, $module);

        // If null then return false.
        if ($module_role_id == null)
        {
            return false;
        }

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
        if (ModulePermission::hasRole($module, Auth::user(), 'assessor') ||
            ModulePermission::hasRole($module, Auth::user(), 'professor'))
        {
            if (ModulePermission::hasPermission(5, $module, Auth::user()))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks to see if the user can delete the module.
     */
    public static function canDelete($module)
    {
        if (ModulePermission::hasRole($module, Auth::user(), 'assessor') ||
            ModulePermission::hasRole($module, Auth::user(), 'professor'))
        {
            if (ModulePermission::hasPermission(6, $module, Auth::user()))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks to see if the user can create a module.
     */
    public static function canCreate()
    {
        if (Auth::user()->hasAdminRole()) {
            return true;
        }
        return false;
    }

    /**
     * Checks to see if the user can view the module.
     */
    public static function canShow($module)
    {
        if (Auth::user()->isInModule($module) || Auth::user()->hasAdminRole())
        {
            return true;
        }
        return false;
    }
}