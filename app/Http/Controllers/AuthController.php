<?php

namespace App\Http\Controllers;

use App\Http\Repository\UserRepo;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected UserService $userService;
    protected UserRepo $userRepo;

    public function __construct(UserService $userService, UserRepo $userRepo)
    {
        $this->userService = $userService;
        $this->userRepo = $userRepo;
    }

    public function register(Request $request)
    {
        $fields = $request->validate([
            "name" => "required|string",
            "email" => "required|string|unique:users,email|email",
            "password" => "required|string",
            "role" => "required|string"
        ]);

        $user = $this->userRepo->create($fields);

        $token = $user->createToken("fitness_app")->plainTextToken;

        $response = [
            "user" => $user,
            "token" => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            "email" => "required|string|email",
            "password" => "required|string"
        ]);

        // check email & password 

        $user = $this->userRepo->findByEmail($fields["email"]);


        if($request->has("type") && $request->type == "admin" && $user &&  $user->role->name !== config("constants.roles")["admin"]){
           return response([
               "message" => "unauthorized"
           ], 401);
        }

        
        if (!$user || !Hash::check($fields["password"], $user->password)) {
            return response([
                "message" => "Bad Credential"
            ], 401);
        }

        $token = $user->createToken("myapptoken")->plainTextToken;

        $response = [
            "user" => $user,
            "token" => $token
        ];

        return response($response, 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response([
            "message" => "logout"
        ], 200);
    }

    public function createToken(Request $request)
    {
        $token = $request->user()->createToken($request->token_name);
        return ['token' => $token->plainTextToken];
    }
}
