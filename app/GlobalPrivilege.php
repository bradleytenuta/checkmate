<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalPrivilege extends Model {
    
    /**
     * Gets the user that owns this global privilege.
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * Gets the role that this privilage is for.
     */
    public function globalRole() {
        return $this->hasOne('App\GlobalRole');
    }
}