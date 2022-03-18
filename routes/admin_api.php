<?php

use App\Http\Controllers\Admin\DataController;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;

// Admin API

Route::group(["middleware" => ["auth:sanctum"], "prefix" => "admin"], function () {

    // Auth API
    Route::post('/tokens/create', [AuthController::class, "createToken"]);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, "logout"]);


    // Attendence API

    Route::post('/attendence', [AttendenceController::class, "store"]);

    Route::get('/attendence', [AttendenceController::class, "index"]);

    Route::get('/attendence/{id}', [AttendenceController::class, "get"]);

    // Data Store API

    Route::post('/data', [DataController::class, "store"]);

    Route::get('/data', [DataController::class, "index"]);

    Route::get('/data/{id}', [DataController::class, "get"]);

    // membership api 

    Route::post('/memberships', [MembershipController::class, "store"]);

    Route::get('/memberships', [MembershipController::class, "index"]);

    Route::get('/memberships/{id}', [MembershipController::class, "get"]);
});