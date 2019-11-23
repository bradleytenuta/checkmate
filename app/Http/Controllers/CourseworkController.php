<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coursework;

class CourseworkController extends Controller
{
    /**
     * Shows the correct coursework.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        //TODO: Only allow the user to see the courseworks they are on. 
        $coursework = Coursework::findOrFail($id);
        return view('auth/coursework', ['coursework' => $coursework]);
    }
}
