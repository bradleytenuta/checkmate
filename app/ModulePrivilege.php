<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModulePrivilege extends Model {

    public function module() {
        return $this->hasOne('App\Module');
    }

    public function user() {
        return $this->hasOne('App\User');
    }

    public function moduleRoles() {
        return $this->hasMany('App\ModuleRole');
    }
}