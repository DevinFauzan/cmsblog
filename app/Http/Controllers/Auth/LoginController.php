<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = 'auth/dashboard';

    protected function redirectTo()
    {
        $role = auth()->user()->role;

        switch ($role) {
            case 'admin':
                return '/landing_page'; // Redirect admin
                break;
            // case 'tech_person':
            //     return '/dashboard-tech'; // Redirect tech person
            //     break;
            // case 'user':
            //     return '/my_ticket'; // Redirect user to my_ticket page
            //     break;
            default:
                return '/home'; // Redirect to a default page if the role is not recognized
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
