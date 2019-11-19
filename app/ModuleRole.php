<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleRole extends Model
{
    public function permissions() {
        return $this->belongsToMany('App\Permission');
    }
}
