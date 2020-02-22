<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Submission;
use Illuminate\Support\Facades\DB;
use Redirect;

class UserController extends Controller
{
    /**
     * Shows the clicked user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($user_id)
    {
        $user = User::findOrFail($user_id);

        // If the current user, then show edit user page.
        if (Auth::user()->id == $user_id) {
            return redirect()->route('user.edit.show');
        } else {
            return view('pages.user', ['user' => $user]);
        }
    }

    /**
     * Shows the edit user page.
     */
    public function showEditUser()
    {
        return view('pages.edit.user');
    }

    /**
     * The function that is called on the POST request for editing a user.
     */
    public function editUser(Request $request)
    {
        // Validates all the data is present.
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'firstname' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
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

    /**
     * Shows the delete user page.
     */
    public function showDeleteUser()
    {
        return view('pages.delete.user');
    }

    /**
     * The POST function for deleting a user.
     */
    public function deleteUser(Request $request)
    {
        // Checks the current user has the right to delete users.
        if (!Auth::user()->hasGlobalPermission(3)) {
            throw ValidationException::withMessages(['Delete Fail' => 'The current user does not have permission to delete users.']);
        }

        // Gets all the users to delete.
        $allInputs = array_keys($request->input());

        // Deletes the users from the database.
        foreach($allInputs as $input)
        {
            // If the key is not a user id then skip to next value in loop.
            if (!is_int($input)) {
                continue;
            }

            $this->delete($input);
        }

        // Goes back to previous page.
        return Redirect::back();
    }

    /**
     * A POST function to delete the currently logged in user.
     */
    public function deleteCurrentUser(Request $request)
    {
        // Checks the user has admin rights to delete their account
        if (!Auth::user()->hasAdminRole()) {
            throw ValidationException::withMessages(['Delete Fail' => 'The current user does not have permission to delete themself.']);
        }

        // Gets the user id so the user can be deleted while logged out.
        $user_id = Auth::user()->id;

        // Logs the user out first.
        Auth::logout();

        $this->delete($user_id);

        // Redirect to login page.
        return Redirect::route('login')->with('global', 'Your account has been deleted!');
    }

    /**
     * Deletes a given user and everything about them in other database tables.
     */
    private function delete($user_id)
    {
        Submission::where('user_id', $user_id)->delete();
        DB::table('module_user')->where('user_id', $user_id)->delete();
        User::where('id', $user_id)->delete();
    }
}