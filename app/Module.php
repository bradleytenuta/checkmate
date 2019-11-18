<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model {
    
    /**
     * Gets a list of all the courseworks this module has.
     */
    public function courseworks() {
        return $this->hasMany('App\Coursework');
    }
}