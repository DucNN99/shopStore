<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use App\Models\User;

class UserController extends Controller
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login(Request $request)
    {
        $status = $this->user->login($request);
        if ($status == true) {
            $user = Auth::user();
            if ($user->is_del == 1) {
                return redirect("/")->with("danger","Tên đăng nhập hoặc mật khẩu không chính xác ! Vui lòng thử lại");
            }
            if ($user->status == 0) {
                return redirect("/")->with("danger","Tài khoản của bạn hiện đang bị khóa !");
            }
            return redirect()->route('dashboard')->with("success","Đăng nhập thành công");
        } else {
            return redirect("/")->with("danger","Tên đăng nhập hoặc mật khẩu không chính xác ! Vui lòng thử lại");
        }
    }

    public function logout()
    {
        $status = $this->user->logout();
        return redirect("/")->with("danger","Bạn đã đăng xuất !");
    }

    public function index()
    {
        $users = $this->user->getUser();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'username'  => [Rule::unique('users','username')->where(function($query) use ($request) {
                                    $query->where('is_del', 0); })
                ],
                'email'     => [Rule::unique('users','email')->where(function($query) use ($request) {
                                    $query->where('is_del', 0)->where('email', '!=', null); })
                ,
                ]
            ],
            [
                'username.unique'   => 'Tài khoản đã tồn tại !',
                'email.unique'      => 'Email đã tồn tại !',
            ]
        );
        $this->user->storeUser($request);
        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $user = $this->user->getUserById($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'username'  => [Rule::unique('users','username')->where(function($query) use ($request, $id) {
                                    $query->where('is_del', 0)->where('id', '!=', $id); })
                ],
                'email'     => [Rule::unique('users','email')->where(function($query) use ($request, $id) {
                                    $query->where('is_del', 0)->where('email', '!=', null)->where('id', '!=', $id); })
                ,
                ]
            ],
            [
                'username.unique'   => 'Tài khoản đã tồn tại !',
                'email.unique'      => 'Email đã tồn tại !',
            ]
        );
        $this->user->updateUser($request, $id);
        return response()->json(['success' => true]);
    }

    public function changepassword(Request $request)
    {
        $request->validate(
            [
                'new_passwordchange'        => 'same:confirm_passwordchange'
            ],
            [
                'new_passwordchange.same'   => 'Mật khẩu nhập lại không khớp với mật khẩu'
            ]
        );
        $response = $this->user->changePasswordUser($request);
        return response()->json($response);
    }

    public function resetpassword($id)
    {
        $new_password = $this->user->resetPasswordUser($id);
        return response()->json($new_password);
    }

    public function show(Request $request, $type)
    {
        switch ($type) {
            case 'search':
                    $users = $this->user->getUser($request);
                    return view('user.table', compact('users'));
                break;
        }
    }

    public function destroy($id)
    {
        $this->user->deleteUser($id);
        return response()->json(['success' => true]);
    }
}
