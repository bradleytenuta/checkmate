<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    /**
     * Shows the correct module.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        // Finds the module by the given id.
        $module = Module::findOrFail($id);

        if (Auth::user()->isInModule($module))
        {
            return view('auth/module', ['module' => $module]);
        } else
        {
            return Redirect::back();
        }
    }
}