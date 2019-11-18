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
        'name', 'email', 'password',
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
     * Gets a list of all the courseworks the user belongs to.
     */
    public function courseworks() {
        return $this->hasMany('App\Coursework');
    }

    /**
     * Gets a list of all the submissions the user owns.
     */
    public function submissions() {
        return $this->hasMany('App\Submission');
    }

    /**
     * This function returns a list of all the modules the user belongs to.
     */
    public function modules() {
        
        // creates an empty list of modules.
        $modules = array_unique();

        foreach (courseworks() as $coursework) {
            $modules->add($coursework->module());
        }

        return $modules;
    }

    public function moduleRoles() {
        return $this->hasMany('App\ModuleRole');
    }
}