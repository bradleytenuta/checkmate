<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
    
    public function moduleRoles() {
        return $this->hasMany('App\ModuleRole');
    }

    public function permissions() {
        return $this->hasMany('App\Permission');
    }
}