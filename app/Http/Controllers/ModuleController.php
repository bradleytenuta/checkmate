<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;

class ModuleController extends Controller
{
    /**
     * Shows the correct module.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        //TODO: Only allow the user to see the modules they are on. 
        $module = Module::findOrFail($id);
        return view('auth/module', ['module' => $module]);
    }
}