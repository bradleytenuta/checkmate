<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Submission;
use App\GlobalRole;
use Illuminate\Support\Facades\DB;
use Redirect;
use Illuminate\Validation\ValidationException;

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
            return redirect()->route('user.edit.show', ['user_id' => $user_id]);
        } else {
            return view('pages.user', ['user' => $user]);
        }
    }

    /**
     * Shows the edit user page.
     */
    public function showEditUser($user_id)
    {
        $user = User::findOrFail($user_id);

        // Checks if the user has permission to edit a user.
        if (!Auth::user()->hasAdminRole()) {
            return Redirect::back();
        }

        return view('pages.edit.user', ['user' => $user]);
    }

    /**
     * The function that is called on the POST request for editing a user.
     */
    public function editUser($user_id, Request $request)
    {
        // Checks if the user has permission to edit a user.
        if (!Auth::user()->hasAdminRole()) {
            throw ValidationException::withMessages(['Edit Fail' => 'The current user does not have permission to edit user.']);
        }

        // Validates all the data is present.
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
        ]);

        $user = User::findOrFail($user_id);

        // Checks if the email has been updated
        if ($user->email != $request['email'])
        {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
            $user->email = $request['email'];
        }

        // Updates the users properties.
        $user->firstname = $request['firstname'];
        $user->surname = $request['surname'];

        // Adds admin rights if set.
        if ($request['admin'] == 'on')
        {
            $user->global_role_id = GlobalRole::where('name', 'admin')->first()->id;
        } else {
            $user->global_role_id = GlobalRole::where('name', 'standard')->first()->id;
        }

        // Updates the password, only if the property isn't empty.
        if (!empty($request['password']))
        {
            // Checks that both passwords are a match.
            if ($request['password'] == $request['password_typed_first'])
            {
                $user->password = Hash::make($request['password']);
            } else {
                throw ValidationException::withMessages(['Edit Fail' => 'The two passwords do not match.']);
            }
        }

        // Saves the user to the database.
        $user->save();

        // Goes back to previous page.
        return Redirect::back();
    }

    /**
     * Shows the all users page.
     */
    public function showAll()
    {
        if (!Auth::user()->hasAdminRole())
        {
            throw ValidationException::withMessages(['Delete Fail' => 'The current user does not have permission to view all users.']);
        }
        return view('pages.admin.users-all');
    }

    /**
     * The POST function for deleting a user.
     */
    public function deleteUser($user_id, Request $request)
    {
        // Checks the current user has the right to delete users.
        if (!Auth::user()->hasAdminRole()) {
            throw ValidationException::withMessages(['Delete Fail' => 'The current user does not have permission to delete users.']);
        }

        // Checks if the current user is the user that is being deleted.
        if (Auth::user()->id == $user_id)
        {
            $this->deleteCurrentUser($request);
        }

        // Deletes the user.
        $this->delete($user_id);

        return redirect()->route('home');
    }

    /**
     * A POST function to delete the currently logged in user.
     */
    private function deleteCurrentUser(Request $request)
    {
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