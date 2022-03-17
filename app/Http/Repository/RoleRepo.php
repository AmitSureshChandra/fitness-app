<?php
namespace App\Http\Repository;

use App\Models\Role;

class RoleRepo{
    public function findAll(){
        return Role::all();
    }

    public function findAllByName(string $name)
    {
        return Role::whereName($name)->get();
    }

    public function findByName(string $name)
    {
        return Role::whereName($name)->first();
    }

    public function findById(int $id)
    {
        return Role::find($id);
    }
}