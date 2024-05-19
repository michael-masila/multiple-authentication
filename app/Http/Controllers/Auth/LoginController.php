<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
//import the function here
use Illuminate\Http\Request;
//import Auth
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    //create a function that will attend to our logins
    protected function login(Request $request){
        //validate the credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        //login our user after validation using if function
        //if user attempt to login, pass the credentials
        if (Auth::attempt($credentials)) {
    
            //if correct login else redirect the user to login page
            //now get the role of logged in user to redirect them to their respective dashboards
            $user_role = Auth::user()->role;
    
            //use switch statement to check the user role
            switch ($user_role) {
                case 1:
                    return redirect('/admin');
                    break;
                case 2:
                    return redirect('/staff');
                    break;
                case 3:
                    return redirect('/client');
                    break;
                default:
                    Auth::logout();
                    return redirect('/login')->with('error', 'Oops, something went wrong');
            }    
        } else {
            return redirect('/login');
        }
    }
}    