<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->user = $user;
    }

    public function getUser($email)
    {
        return $this->user->where('email', $email)->first();
    }

    public function findByApiToken($apiToken)
    {
        return $this->user->where('api_token', $apiToken)->first();
    }

    public function save($user)
    {
        $user->save();
    }
}


