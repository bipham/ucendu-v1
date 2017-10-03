<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
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

    public function getLogin() {
        return view('auth.login');
    }

    public function authenticated(Request $request, $user) {
        $result = true;
        if (!$user->activated) {
//            auth()->logout();
            $result = false;
        }
        return $result;
    }

    public function checkStatus(Request $request, $user) {
        $result = true;
        if (!$user->status) {
//            auth()->logout();
            $result = false;
        }
        return $result;
    }

    public function postLogin(LoginRequest $request) {
        $login = array(
            'email' => $request->email,
            'password' => $request->password
        );
//        dd(Auth::attempt($login));
        if (!Auth::attempt($login)) {
            $message = ['flash_level'=>'danger message-custom','flash_message'=>'Thông tin email/password sai.'];
            return redirect()->back()->with($message);
        }
        else {
            $checkActivated = $this->authenticated($request, $this->guard()->user());
            $checkStatus = $this->checkStatus($request, $this->guard()->user());
//            dd($check);
            if ($checkActivated && $checkStatus) {
                return redirect()->intended('/');
            }
            elseif (!$checkStatus) {
                Auth::logout();
                $message = ['flash_level'=>'warning message-custom','flash_message'=>'Your account is expired! Please contact admin to reactive'];
                return redirect()->Route('getLogin')->with($message);
            }
            elseif (!$checkActivated) {
                $message = ['flash_level'=>'warning message-custom','flash_message'=>'Your must change password first'];
                return redirect()->Route('getChangePassword')->with($message);
            }
        }
    }

    public function getLogout(Request $request){
        Auth::logout();
        return redirect('/');
    }
}
