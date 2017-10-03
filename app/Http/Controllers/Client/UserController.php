<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getChangePassword () {
        return view('auth.changePassword');
    }

    public function postChangePassword (Request $request) {
        $userModel = new User();
//        dd($request);
        $new_password = $request->password;
        $userModel->changePasswordUser(Auth::id(), $new_password);
        return redirect()->intended('/');
    }
}
