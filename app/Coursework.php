<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coursework extends Model {

    /**
     * This function updates the name
     * of the coursework.
     */
    public function rename($name) {
        $this->Name = $name;
        $this->save();
    }
}