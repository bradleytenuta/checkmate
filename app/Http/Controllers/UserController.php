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

    public function showDeleteUser()
    {
        return view('pages.delete.user');
    }

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

            // TODO: Is there an easier way than this.
            $this->delete($input);
        }

        // Goes back to previous page.
        return Redirect::back();
    }

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

    private function delete($userId)
    {
        Submission::where('user_id', $userId)->delete();
        DB::table('module_user')->where('user_id', $userId)->delete();
        User::where('id', $userId)->delete();
    }
}