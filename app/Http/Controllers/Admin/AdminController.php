<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AdminController extends Controller{
    public function __construct(Request $request)
    {
        // auth middleware
        $this->middleware(["auth:sanctum"]);


        // admin middleware
        $this->middleware(function ($request, $next) {      

            logger(auth()->user()->role->name);
            if(auth()->user()->role->name !==  config("constants.roles")["admin"]){
                return response(['message' => 'You are not authorized to access'], 401);
            }
            return $next($request);
        });
    }
}