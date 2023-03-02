<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;


class UserService
{
    protected $userRepository;

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
    public function logout()
    {
        Auth::logout();
        
    }
}
?>
