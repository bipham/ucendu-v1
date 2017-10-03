<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class UserController extends Controller
{
    use RegistersUsers;
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function getCreateNewUser($domain) {

        return view('admin.createNewUser');
    }

    public function postCreateNewUser($domain, RegisterRequest $request) {
        $account = new User();
//        dd($request->all());
        $account->username = $request->username;
        $account->email = $request->email;
        $account->password = Hash::make('abc123');
        $account->level = $request->level;
        $account->remember_token = $request->_token;
        $account->avatar = 'default.jpg';
        $account->save();
        $message = ['flash_level'=>'success message-custom','flash_message'=>'Đăng ký thành công!'];
//        dd($message);
        return redirect('createNewUser')->with($message);
//        return 'success'->with($message);
    }
}
