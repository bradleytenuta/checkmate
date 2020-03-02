<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coursework_id', 'user_id',
    ];

    /**
     * Returns the coursework this submission belongs to.
     */
    public function coursework()
    {
        return $this->belongsTo('App\Coursework');
    }

    /**
     * Gets the user that owns this submission.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}