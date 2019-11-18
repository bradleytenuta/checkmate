<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {
    
    public function moduleRoles() {
        return $this->hasMany('App\ModuleRole');
    }

    public function role() {
        return $this->belongsTo('App\Role');
    }
}