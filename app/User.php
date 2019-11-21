<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;
use App\Permission;
use App\GlobalPrivilege;

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
        return $this->belongsToMany('App\Module');
    }

    /**
     * Gets a list of all the submissions the user owns.
     */
    public function submissions() {
        return $this->hasMany('App\Submission');
    }

    /**
     * Gets a list of all the roles a user had for their modules.
     */
    public function ModuleRoles() {
        return $this->hasMany('App\ModuleRole');
    }

    /**
     * Gets the users global role if they have one.
     */
    public function globalPrivilege() {
        return $this->hasOne('App\GlobalPrivilege');
    }

    /**
     * This function returns a list of all the global permission objects that this
     * user has.
     */
    public function globalPermissions() {

        $global_role_id = $this->globalPrivilege->global_role_id;
        $all_permissions = DB::table('global_roles_permissions')->where('global_role_id', $global_role_id)->get();
        //dd($all_permissions);

        $all_permission_ids = array();
        foreach ($all_permissions as $permission) {
            $all_permission_ids[] = $permission->permission_id;
        }

        return Permission::findMany($all_permission_ids);
    }

    /**
     * This function takes in an id.
     * It checks to see if the id matches any global permission
     * id's this user has.
     */
    public function hasGlobalPermission($id) {

        foreach ($this->globalPermissions() as $global_permission) {
            if ($id ==  $global_permission->id) {
                return true;
            }
        }
        return false;
    }

    /**
     * This function checks to see if the user has an admin global role.
     */
    public function hasAdminRole() {
        
        // If its null then return false
        if (GlobalPrivilege::where('user_id', $this->id)->get()->isEmpty()) {
            return false;
        }

        return true;
    }
}