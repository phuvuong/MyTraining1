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

        if ($user = $this->userService->login($credentials)) {
            auth()->login($user);
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
        

    }
    public function logout(Request $request)
    {
        $this->userService->logout($request);
        return redirect('/login');

    }
}
?>
