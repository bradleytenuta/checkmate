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
        // Finds the coursework by the given id. Then gets the module that coursework belongs to.
        $module = Coursework::findOrFail($id)->module;

        if (Auth::user()->isInModule($module))
        {
            return view('auth/coursework', ['coursework' => $coursework]);
        } else
        {
            return Redirect::back();
        }
    }
}
