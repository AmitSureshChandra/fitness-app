<?php

use App\Http\Controllers\Admin\DataController;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;

// Admin API

// DATA API 
Route::get("/data", [DataController::class, "getAll"]);
Route::get("/memberships", [DataController::class, "getAllMembership"]);
Route::get("/attendences", [DataController::class, "getAllAttendence"]);
Route::get("/users", [DataController::class, "getAllUsers"]);
