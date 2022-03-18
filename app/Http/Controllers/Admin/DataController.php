<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function getAll(Request $request){
        $length = $request->has("length") ? $request->length : 10;
        return Data::paginate($length);
    }
}
