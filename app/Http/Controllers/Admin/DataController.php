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
            "data" => Data::all()
        ], 200);
    }

    public function getAllMembership(Request $request){
        return response([
            "data" => Membership::all()
        ], 200);
    }

    public function getAllAttendence(Request $request){
        return response([
            "data" =>  Attendence::all()
        ], 200);
    }

     public function getAllUsers(Request $request){
        return response([
            "data" => User::all()
        ], 200);
    }
}
