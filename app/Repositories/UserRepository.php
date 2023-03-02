<?php

namespace App\Repositories;
use App\Models\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;

    }

    public function getUser($email)
    {
        return $this->user->where('email', $email)->first();

    }
}
?>