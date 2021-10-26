<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiLoginController extends Controller
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
    protected $redirectTo = RouteServiceProvider::PORTAL;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function loginAPI(Request $request)
    {
        // return $request->all() ;
        if(Auth::user()){
            return Auth::user()->with('branch')->first();
        }

        if (Auth::attempt($request->all())) {
            $request->session()->regenerate();
            $user = Auth::user()->with('branch')->first();
            return [$user , $user->createToken('yaqeenToken')->plainTextToken];
        }else{
            return 'faild';
        }


    }

    public function logout()
    {
        Auth::logout();
        return 'succsess' ;
    }
}
