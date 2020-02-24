<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    /**
     * Gets the coursework the test belongs to.
     */
    public function coursework()
    {
        return $this->belongsTo('App\Coursework');
    }
}