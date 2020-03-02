<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        // Gets all modules.
        $modules = Auth::user()->modules;

        // Creates view with given parameters.
        return view('pages.home', ['modules' => $modules]);
    }
}
