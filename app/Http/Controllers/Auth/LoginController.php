<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $userName = $request->user_name;
        $this->validateLogin($request);

        if ($request->loginStep == 1) {
            $checkUser = User::where('user_name', $userName)->first();
            $userName = $checkUser->user_name;
            /* Admin login Screen*/
            if ($checkUser->role == 1) {
                return view('auth.login_2',['userName' => $userName]);
            }

            if ($checkUser->role == 2) {
                $companyCounts = json_decode($checkUser->company_ids);
                $companyCount = count($companyCounts);

                if ($companyCount <= 1) {
                    return view('auth.login_2',['userName' => $userName]);
                }

                if ($companyCount > 1) {
                    $tenants = Tenant::whereIn('id',$companyCounts)->get();
                    return view('auth.login_3',['userName' => $userName,'tenants' => $tenants]);
                }
            }
        }

        if ($request->loginStep == 2) {
            $checkUser = User::where('user_name', $userName)->first();
            if ($checkUser->role == 1) {
                if ($this->attemptLogin($request)) {
                    if ($request->hasSession()) {
                        $request->session()->put('auth.password_confirmed_at', time());
                    }
                    return $this->sendLoginResponse($request);
                }
            }

            if ($checkUser->role == 2) {
                $companyCounts = json_decode($checkUser->company_ids);
                $getCompanyName = $companyCounts[0];

                if ($this->attemptLogin($request)) {
                    if ($request->hasSession()) {
                        $request->session()->put('auth.password_confirmed_at', time());
                    }

                    return $this->sendLoginResponse($request);
                }
            }
        }

        if ($request->loginStep == 3) {
            $tenant = Tenant::find($request->company);
            $cred = array(
                'user_name' => $tenant->name,
                'password' => $request->password,
            );

            if (Auth::attempt($cred)) {
                if ($request->hasSession()) {
                    $request->session()->put('auth.password_confirmed_at', time());
                }
                return $this->sendLoginResponse($request);
            } else {
                return Redirect::route("login");
            }
        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        // if (method_exists($this, 'hasTooManyLoginAttempts') &&
        //     $this->hasTooManyLoginAttempts($request)) {
        //     $this->fireLockoutEvent($request);

        //     return $this->sendLockoutResponse($request);
        // }

        // if ($this->attemptLogin($request)) {
        //     if ($request->hasSession()) {
        //         $request->session()->put('auth.password_confirmed_at', time());
        //     }

        //     return $this->sendLoginResponse($request);
        // }

        // // If the login attempt was unsuccessful we will increment the number of attempts
        // // to login and redirect the user back to the login form. Of course, when this
        // // user surpasses their maximum number of attempts they will get locked out.
        // $this->incrementLoginAttempts($request);

        // return $this->sendFailedLoginResponse($request);
    }
}
