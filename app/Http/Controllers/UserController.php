<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use App\Events\UserLoggedIn;

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
        $apiToken = $this->userService->login($request->email, $request->password);
        if ($apiToken) {
            auth()->login($apiToken);
            Event::dispatch(new UserLoggedIn($apiToken));
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $this->userService->logout($user);
        return redirect('/login');
    }

}


