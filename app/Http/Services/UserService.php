<?php

namespace App\Http\Services;

use App\Http\Repository\UserRepo;

class UserService
{
    protected UserRepo $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }
}
