<?php

namespace App\Utility;

use App\Utility\ModulePermission;
use Illuminate\Support\Facades\Auth;
use App\Utility\Time;

class CourseworkPermission
{
    /**
     * Checks the current user can create coursework.
     */
    public static function canCreate($module)
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
     * Checks the user has permission to view the coursework.
     */
    public static function canShow($coursework)
    {
        // If the user is admin and a student in the module then module 
        if (ModulePermission::isStudentAdmin($coursework->module)) {
            return false;
        }

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
     * Checks to see if the current user can mark coursework within a module.
     */
    public static function canMark($module)
    {
        // If the user is admin and a student in the module then module 
        if (ModulePermission::isStudentAdmin($module)) {
            return false;
        }

        // If the user has permission to mark submissions.
        if (Auth::user()->hasAdminRole() ||
            ModulePermission::hasRole($module, Auth::user(), "professor") ||
            ModulePermission::hasRole($module, Auth::user(), "assessor"))
        {
            return true;
        }
        return false;
    }
}