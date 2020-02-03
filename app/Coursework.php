<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coursework extends Model {
    
    /**
     * Gets the module that this coursework belongs to.
     */
    public function module()
    {
        return $this->belongsTo('App\Module');
    }

    /**
     * Gets a list of all the submissions within this coursework.
     */
    public function submissions()
    {
        return $this->hasMany('App\Submission');
    }

    /**
     * Sets the state of the coursework, either open or closed.
     */
    public function setState($boolean)
    {
        $this->open = $boolean;
        $this->save();
    }
}