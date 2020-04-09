<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Permission;
use App\GlobalPrivilege;
use App\ModuleRole;
use App\Module;
use App\Coursework;
use DateTime;

class User extends Authenticatable
{
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
    public function modules()
    {
        return $this->belongsToMany('App\Module', 'module_user')
                    ->withPivot('module_role_id');
    }

    /**
     * Gets a list of all the submissions the user owns.
     */
    public function submissions()
    {
        return $this->hasMany('App\Submission');
    }

    /**
     * Gets the users global role.
     */
    public function globalRole()
    {
        // 2nd param is the column name in the GlobalRole table.
        // 3rd param is the column name in the Users table.
        return $this->hasOne('App\GlobalRole', 'id', 'global_role_id');
    }

    public function isInModule($module)
    {
        return $this->modules->where('id', $module->id)->isNotEmpty();
    }

    /**
     * This function checks to see if the user has an admin global role.
     */
    public function hasAdminRole()
    {
        // If the global role is admin then return.
        return $this->globalRole->name == "admin";
    }
}