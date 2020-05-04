<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Jobs\MossRunner;
use App\Jobs\JavaTestRunner;

class Coursework extends Model
{
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
     * Gets a list of all the tests within this coursework.
     */
    public function tests()
    {
        return $this->hasMany('App\Test');
    }

    /**
     * Sets the state of the coursework, either open or closed.
     */
    public function setState($boolean)
    {
        // If the state is null then set the state and leave the function.
        if (is_null($this->open))
        {
            $this->open = $boolean;
            $this->save();
            return;
        }
        
        // Only updates the state if the state is different.
        if ($this->open != $boolean)
        {
            $this->open = $boolean;
            $this->save();

            // If the coursework state is now closed, then run the moss job.
            if ($this->open == false)
            {
                $this->runMoss();
            }
            
        }
    }

    /**
     * Creates a job for each submission in the coursework.
     */
    public function runMoss()
    {
        foreach ($this->submissions as $submission)
        {
            MossRunner::dispatch($submission->id);
        }
    }

    /**
     * Creates a job for each submission in the coursework.
     */
    public function runTests()
    {
        // Runs this section if the coursework type is java.
        if ($this->coursework_type_id == 1)
        {
            foreach ($this->submissions as $submission)
            {
                // Dispatches job after 1 minute.
                JavaTestRunner::dispatch($submission->id)
                ->delay(now()->addMinutes(1));
            }
        }
    }
}