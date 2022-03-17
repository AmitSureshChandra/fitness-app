<?php

use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group(["middleware" => ["auth:sanctum"]], function () {

    // Auth API
    Route::post('/tokens/create', [AuthController::class, "createToken"]);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, "logout"]);


    // Attendence API
    Route::post('/attendence', [AttendenceController::class, "store"]);

    Route::get('/attendence', [AttendenceController::class, "index"]);

    // Data Store API

    Route::post('/data', [DataController::class, "store"]);

    Route::get('/data', [DataController::class, "index"]);

    Route::get('/data/{id}', [DataController::class, "show"]);
});

Route::post("/register", [AuthController::class, "register"]);
Route::post('/login', [AuthController::class, "login"])->name("login");
