<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Hash;

class User extends Authenticatable
{

    protected $table = 'users';

    use Notifiable;

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'level', 'fullname', 'adress', 'phone', 'dob', 'avatar','activated'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAllAdmin() {
        return $this->where('level', 0)->select('id')->get();
    }

    public function getInfoBasicUserById($id) {
        return $this->where('id',$id)->select('username', 'avatar')->get()->first();
    }

    public function changePasswordUser($id, $new_password) {
        DB::table('users')  -> where('id', $id)
                            -> update(['password' => Hash::make($new_password), 'activated' => 1]);
    }

    public function getLevelCurrentUserByUserId($id) {
        return $this->where('id',$id)->select('level')->get()->first();
    }
}
