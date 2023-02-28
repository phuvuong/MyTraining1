<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function login(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            return true;
        } else {
            return false;
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
    }
}
?>
