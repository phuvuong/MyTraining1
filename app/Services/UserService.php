<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login($email, $password)
    {
        $user = $this->userRepository->getUser($email);

        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }
        $apiToken = $this->generateApiToken();
        $user->api_token = $apiToken;
        $this->userRepository->save($user);
        return $user;
    }

    public function logout($user)
    {
        Auth::logout();
        $user->api_token = null;
        $this->userRepository->save($user);
    }

    protected function generateApiToken()
    {
        return bin2hex(random_bytes(30));
    }
}


