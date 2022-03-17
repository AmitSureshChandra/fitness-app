<?php

namespace App\Http\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepo
{

    protected RoleRepo $roleRepo;

    public function __construct(RoleRepo $roleRepo)
    {
        $this->roleRepo = $roleRepo;
    }

    public function findAll()
    {
        return User::all();
    }

    public function save(User $user)
    {
        return $user->save();
    }

    public function create(array $fields)
    {
        $user = new User();
        $user->name = $fields["name"];
        $user->email =
            $fields["email"];
        $user->password = Hash::make($fields["password"]);
        $user->role_id = $this->roleRepo->findByName($fields["role"])->id;

        $user->save();

        return $user;
    }

    public function findById(int $id)
    {
        return User::find($id);
    }

    public function findByEmail(string $email)
    {
        return User::whereEmail($email)->first();
    }

    public function findAllByEmail(string $email)
    {
        return User::whereEmail($email)->get();
    }
}
