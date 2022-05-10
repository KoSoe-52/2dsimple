<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;
use App\Models\Branch;


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
    protected function redirectTo(){
        if(Auth::check())
        {
            if(Auth()->user()->role_id==1)
            {
                // LoginLog::create([
                //     "user_id" => Auth::user()->id
                // ]);
                return route("admin.showUsers");
            }
            elseif( Auth()->user()->role_id==2)
            {
                // LoginLog::create([
                //     "user_id" => Auth::user()->id
                // ]);
                return route("super.dashboard");
            }
            elseif( Auth()->user()->role_id==3)
            {
                // LoginLog::create([
                //     "user_id" => Auth::user()->id
                // ]);
                return route("moderator.dashboard");
            }
        }else
        {
            return '/login';
        }
    }



    public function login(Request $request)
    {
        $input=$request->all();
        $this->validate($request,[
            'login'=>'required',
            'password'=>'required'
        ]);
        if(auth()->attempt(array('name'=>$input['login'],'password'=>$input['password'])))
        {
            if(auth()->user()->role_id==1)
            {
                // LoginLog::create([
                //     "user_id" => Auth::user()->id
                // ]);
                return redirect()->route('admin.dashboard');

            }
            elseif(auth()->user()->role_id==2)
            {
                // LoginLog::create([
                //     "user_id" => Auth::user()->id
                // ]);
                return redirect()->route('super.dashboard');
            }
            elseif(auth()->user()->role_id==3)
            {
                // LoginLog::create([
                //     "user_id" => Auth::user()->id
                // ]);
                return redirect()->route('moderator.dashboard');
            }
        }
        else
        {
            return redirect()->route('login')->with('error','Email and Password are Wrong!');
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


