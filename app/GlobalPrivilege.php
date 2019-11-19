<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalPrivilege extends Model {
    
    public function user() {
        return $this->hasOne('App\User');
    }

    public function globalRole() {
        return $this->hasOne('App\GlobalRole');
    }
}