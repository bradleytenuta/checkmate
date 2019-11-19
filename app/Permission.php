<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

    public function globalRole() {
        return $this->belongsTo('App\GlobalRole');
    }

    public function moduleRole() {
        return $this->belongsTo('App\ModuleRole');
    }
}