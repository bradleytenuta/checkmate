<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalRole extends Model
{
    public function permissions() {
        return $this->belongsToMany('App\Permission');
    }
}
