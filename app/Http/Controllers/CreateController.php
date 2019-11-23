<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function createModule() {

        // Checks to see if the user has the admin role.
        if (Auth::user()->hasAdminRole()) {
            return view('auth/create.module');
        }
    }
}
