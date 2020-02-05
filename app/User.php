<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;
use App\Permission;
use App\GlobalPrivilege;
use App\ModuleRole;
use App\Module;
use App\Coursework;
use DateTime;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'firstname', 'surname', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Gets a list of all the modules the user belongs to.
     */
    public function modules() {
        return $this->belongsToMany('App\Module', 'module_user')
                    ->withPivot('module_role_id');
    }

    /**
     * Gets a list of all the submissions the user owns.
     */
    public function submissions() {
        return $this->hasMany('App\Submission');
    }

    /**
     * Gets the users global role if they have one.
     */
    public function globalRole() {
        // 2nd param is the column name in the GlobalRole table.
        // 3rd param is the column name in the Users table.
        return $this->hasOne('App\GlobalRole', 'id', 'global_role_id');
    }

    /**
     * This function returns a list of all the global permission objects that this
     * user has.
     */
    public function globalPermissions() {
        return $this->globalRole->permissions;
    }

    /**
     * This function takes in an id.
     * It checks to see if the id matches any global permission
     * id's this user has.
     */
    public function hasGlobalPermission($id) {

        foreach ($this->globalPermissions() as $global_permission) {
            if ($global_permission->id == $id) {
                return true;
            }
        }
        return false;
    }

    /**
     * This function checks to see if the user has an admin global role.
     */
    public function hasAdminRole() {

        // If the global role is admin then return.
        if ($this->globalRole->name == "admin") {
            return true;
        }

        return false;
    }

    public function isStudent($module) {
        // Checks to see if this user is in the given module.
        // If not then return false.
        if (!$this->isInModule($module)) {
            return false;
        }

        $module_role_id = DB::table('module_user')->where('user_id', $this->id)->where('module_id', $module->id)->first()->module_role_id;
        
        if (ModuleRole::where('name', 'student')->first()->id == $module_role_id) {
            return true;
        }
        return false;
    }

    public function isProfessor($module) {
        // Checks to see if this user is in the given module.
        // If not then return false.
        if (!$this->isInModule($module)) {
            return false;
        }

        $module_role_id = DB::table('module_user')->where('user_id', $this->id)->where('module_id', $module->id)->first()->module_role_id;
        
        if (ModuleRole::where('name', 'professor')->first()->id == $module_role_id) {
            return true;
        }
        return false;
    }

    // TODO: Can merge these 3 methods into one method that returns a file path depending on the role type.
    public function isAssessor($module) {
        // Checks to see if this user is in the given module.
        // If not then return false.
        if (!$this->isInModule($module)) {
            return false;
        }
        
        $module_role_id = DB::table('module_user')->where('user_id', $this->id)->where('module_id', $module->id)->first()->module_role_id;
        
        if (ModuleRole::where('name', 'assessor')->first()->id == $module_role_id) {
            return true;
        }
        return false;
    }

    public function hasModulePermission($id, $module) {

        // Gets the users role within the module.
        $module_role_id = DB::table('module_user')->where('user_id', $this->id)->where('module_id', $module->id)->first()->module_role_id;

        // Gets all the permissions that belong to the module role.
        $permission_module_role_rows = DB::table('module_roles_permissions')->where('module_roles_id', $module_role_id)->get();

        // Loops through all the permissions and check it matches the ones mentioned in the params.
        foreach ($permission_module_role_rows as $permission_module_role) {

            if ($permission_module_role->permission_id == $id) {
                return true;
            }
        }

        return false;
    }

    public function getModulePermissionIconPath($item) {

        // Gets the module role.
        $module_role_id = $this->getUserModuleRole($item);

        // If the user is a student.
        if (ModuleRole::where('name', 'student')->first()->id == $module_role_id) {
            return "/images/icon/module-icon-student.png";
        }

        // If the user is a professor.
        if (ModuleRole::where('name', 'professor')->first()->id == $module_role_id) {
            return "/images/icon/module-icon-professor.png";
        }

        // If the user is an assessor.
        if (ModuleRole::where('name', 'assessor')->first()->id == $module_role_id) {
            return "/images/icon/module-icon-assessor.png";
        }

        return null;
    }

    public function getModulePermissionText($item) {

        // Gets the module role.
        $module_role_id = $this->getUserModuleRole($item);

        // If the user is a student.
        if (ModuleRole::where('name', 'student')->first()->id == $module_role_id) {
            return "Student";
        }

        // If the user is a professor.
        if (ModuleRole::where('name', 'professor')->first()->id == $module_role_id) {
            return "Professor";
        }

        // If the user is an assessor.
        if (ModuleRole::where('name', 'assessor')->first()->id == $module_role_id) {
            return "Assessor";
        }

        return null;
    }

    public function getItemTypePath($item) {
        if ($item instanceof Module) {
            return "/images/navbar/module.png";
        } else if ($item instanceof Coursework) {
            return "/images/navbar/coursework.png";
        } else {
            return "";
        }
    }

    public function getItemTypeText($item) {
        if ($item instanceof Module) {
            return "Module";
        } else if ($item instanceof Coursework) {
            return "Coursework";
        } else {
            return "";
        }
    }

    private function getUserModuleRole($item) {

        $module_role_id = null;

        if ($item instanceof Module) {

            // If the item is a module
            $module_role_id = DB::table('module_user')
                ->where('user_id', $this->id)
                ->where('module_id', $item->id)
                ->first()->module_role_id;

        } else if ($item instanceof Coursework) {

            // If the item is a coursework
            $module_role_id = DB::table('module_user')
                ->where('user_id', $this->id)
                ->where('module_id', $item->module->id)
                ->first()->module_role_id;

        }

        return $module_role_id;
    }

    public function isInModule($module)
    {
        return $this->modules->where('id', $module->id)->isNotEmpty();
    }
}