<?php

namespace App\Utility;

use App\Utility\ModulePermission;
use Illuminate\Support\Facades\Auth;
use App\Utility\Time;

class CourseworkPermission
{
    /**
     * Checks that the user can edit coursework in the given module.
     */
    public static function canEdit($module)
    {
        // If the user is admin and a student in the module then module 
        if (ModulePermission::isStudentAdmin($module)) {
            return false;
        }

        if (Auth::user()->hasAdminRole() || ModulePermission::hasPermission(8, $module, Auth::user()))
        {
            return true;
        }
        return false;
    }

    /**
     * Checks the current user can create coursework.
     */
    public static function canCreate($module)
    {
        // If the user is admin and a student in the module then module 
        if (ModulePermission::isStudentAdmin($module)) {
            return false;
        }

        if (Auth::user()->hasAdminRole() || ModulePermission::hasPermission(5, $module, Auth::user()))
        {
            return true;
        }
        return false;
    }

    /**
     * Checks the user has permission to view the coursework.
     */
    public static function canShow($coursework)
    {
        // If the user has admin role.
        if (Auth::user()->hasAdminRole())
        {
            return true;
        }

        // If the coursework hasnt started yet 
        // and the user is a student
        if(Time::dateInFuture($coursework) &&
            ModulePermission::hasRole($coursework->module, Auth::user(), 'student'))
        {
            return false;
        }

        // If the user is not in the module.
        // or doesnt have admin role.
        if (!Auth::user()->isInModule($coursework->module))
        {
            return false;
        }
        return true;
    }

    /**
     * Checks to see if the user can delete a coursework.
     */
    public static function canDelete($module)
    {
        // If the user is admin and a student in the module then module 
        if (ModulePermission::isStudentAdmin($module)) {
            return false;
        }

        if (Auth::user()->hasAdminRole() || ModulePermission::hasPermission(6, $module, Auth::user()))
        {
            return true;
        }
        return false;
    }
}