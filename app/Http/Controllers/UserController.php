<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Redirect;

class UserController extends Controller
{
    /**
     * Shows the clicked user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        // If the current user, then show edit user page.
        if (Auth::user()->id == $id) {
            return redirect()->route('user.edit.show');
        } else {
            return view('pages.user', ['user' => $user]);
        }
    }

    public function showEditUser()
    {
        return view('pages.edit.user');
    }

    public function editUser(Request $request)
    {
        // Validates all the data is present.
        $request->validate([
            'email' => 'required',
            'firstname' => 'required',
            'surname' => 'required'
        ]);

        // Updates the users properties.
        Auth::user()->email = $request['email'];
        Auth::user()->firstname = $request['firstname'];
        Auth::user()->surname = $request['surname'];

        // Updates the password, only if the property isn't empty.
        if (!empty($request['password']))
        {
            Auth::user()->password = Hash::make($request['password']);
        }

        // Saves the user to the database.
        Auth::user()->save();

        // Goes back to previous page.
        return Redirect::back();
    }
}