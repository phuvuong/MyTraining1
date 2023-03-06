<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function login($credentials)
    {
        $user = $this->userRepository->getUser($credentials['email']);

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return false;
        }

        return $user;
    
    }
    public function logout()
    {
        Auth::logout();
        
    }
}
?>
