<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\GlobalRole;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/register';

    /**
     * Requires the user to be authenticated to view the register page.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Overrides the show registration form function.
     * Before we allow access to the register page, we check to see if
     * the user is logged in or has admin rights to create a user.
     * If they don't then we redirect them to the root page.
     */
    public function showRegistrationForm()
    {
        // Checks to see if the user has the admin role.
        if (Auth::user()->hasAdminRole()) {
            return view('auth/register');
        }

        // Redirects the user.
        return redirect('/');
    }

    /**
     * Handle a registration request for the application.
     * This overrides the orignal register funtion. Now when a user is registered,
     * it doesnt automatically log that user in.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        // If the admin box was checked, then give the user admin global rights.
        // Else give the user standard global rights.
        $checkBoxTicked = isset($data['admin']) ? $data['admin'] : null;
        if ($checkBoxTicked != null) {
            
            User::create([
                'firstname' => $data['firstname'],
                'surname' => $data['surname'],
                'email' => $data['email'],
                'password' => Hash::make($data['firstname'].$data['surname']),
                'global_role_id' => App\GlobalRole::where('name', 'admin')->first()->id,
            ]);
        } else {

            User::create([
                'firstname' => $data['firstname'],
                'surname' => $data['surname'],
                'email' => $data['email'],
                'password' => Hash::make($data['firstname'].$data['surname']),
                'global_role_id' => App\GlobalRole::where('name', 'standard')->first()->id,
            ]);
        }
    }
}
