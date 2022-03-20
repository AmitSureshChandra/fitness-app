<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Attendence;
use App\Models\Data;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\Request;

class DataController extends AdminController
{
    public function getAll(Request $request){
        return response([
            "data" => Data::join("users", "users.id","data.user_id")->get()->makeHidden(['password', 'remember_token', 'email_verified_at'])
        ], 200);
    }

    public function getAllMembership(Request $request){
        return response([
            "data" => Membership::join("users", "users.id","memberships.user_id")->get()->makeHidden(['password', 'remember_token', 'email_verified_at'])
        ], 200);
    }

    public function getAllAttendence(Request $request){
        return response([
            "data" =>  Attendence::join("users", "users.id","attendences.user_id")->get()->makeHidden(['password', 'remember_token', 'email_verified_at'])
        ], 200);
    }

     public function getAllUsers(Request $request){
        return response([
            "data" => User::join("roles", "roles.id", "users.role_id")
                ->select(
                    'users.id as user_id',
                    'users.name as user_name',
                    'users.email as user_email',
                    'roles.name as user_role',
                    'users.created_at as created_at',
                )
                ->get()
        ], 200);
    }
}
