<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

    }
    public function getLoginForm()
    {
        return view('login');

    }
    public function login(UserRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if ($this->userService->login($credentials)) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Đăng nhập thất bại. Vui lòng thử lại.']);
        }

    }
    public function logout(Request $request)
    {
        $this->userService->logout($request);
        return redirect('/login');

    }
}
?>
