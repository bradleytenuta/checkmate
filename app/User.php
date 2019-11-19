<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'firstname', 'surname', 'password',
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
     * Gets all the privileges the user has for each module.
     */
    public function ModulePrivileges() {
        return $this->hasMany('App\ModulePrivilege');
    }

    /**
     * Gets the global privilage the user has. This can be null
     * as its possible a user does not have any global privileges.
     */
    public function globalPrivilege() {
        return $this->hasOne('App\GlobalPrivilege');
    }
}