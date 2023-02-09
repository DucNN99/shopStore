<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Illuminate\Support\Facades\Hash;
use Str;

class User extends Authenticatable
{
    protected $table    = "users";

    protected $guarded  = [];

    protected $perPage  = 10;

    public function login($request)
    {
        if (Auth::attempt(["username" => $request["username"], "password" => $request["password"]])) {
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        Auth::logout();
        return true;
    }

    public function getUser($request = null)
    {
        $users = User::where('is_del', 0);
                        if ($request != null) {
                            $users = $users->where(function($query) use ($request){
                                                $query->where('username', 'LIKE', '%'.$request->search.'%')
                                                        ->orwhere('email', 'LIKE', '%'.$request->search.'%');
                                            });
                        }
                        $users = $users->orderBy('id', 'DESC')
                        ->paginate(optional($request)->perPage);
        return $users;
    }

    public function storeUser($request)
    {
        $user           = new User();
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->password = bcrypt($request->password);
        $user->is_del   = 0;
        $user->status   = $request->status;
        $user->role     = 1;
        $user->save();
        return $user;
    }

    public function getUserById($id)
    {
        return User::find($id);
    }

    public function updateUser($request, $id)
    {
        $user           = User::find($id);
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->password = bcrypt($request->password);
        $user->is_del   = 0;
        $user->status   = $request->status;
        $user->role     = 1;
        $user->save();
        return $user;
    }

    public function changePasswordUser($request)
    {
        $user = User::find(Auth::id());
        if (Hash::check($request->passwordchange, $user->password) == false) {
            $response['msg']        = 'Mật khẩu cũ không chính xác';
            $response['success']    = false;
            return $response;
        } else {
            if ($request->new_passwordchange != $request->confirm_passwordchange) {
                $response['msg']        = 'Mật khẩu mới không trùng khớp';
                $response['success']    = false;
                return $response;
            }
            $user->password     = Hash::make($request->new_passwordchange);
            $user->save();
            $response['msg']        = 'Thay đổi mật khẩu thành công';
            $response['success']    = true;
            return $response;
        }
    }

    public function resetPasswordUser($id)
    {
        $user               = User::find($id);
        $random             = Str::random(10);
        $user->password     = bcrypt($random);
        $user->save();
        return $random;
    }

    public function deleteUser($id)
    {
        $user           = User::find($id);
        $user->is_del   = 1;
        $user->save();
        return $user;
    }
}
