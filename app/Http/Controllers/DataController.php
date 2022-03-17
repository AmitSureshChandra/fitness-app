<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Data::whereUserId(auth()->user()->id)->orderBy("date")->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "neck" => "required|integer",
            "shoulder" => "required|integer",
            "chest" => "required|integer",
            "arms" => "required|integer",
            "forearms" => "required|integer",
            "thighs" => "required|integer",
            "calf" => "required|integer",
            "weight" => "required|integer",
        ]);

        $data = new Data;

        $data->neck = $request->neck;
        $data->shoulder = $request->shoulder;
        $data->chest = $request->chest;
        $data->arms = $request->arms;
        $data->forearms = $request->forearms;
        $data->thighs = $request->thighs;
        $data->calf = $request->calf;
        $data->weight = $request->weight;

        $data->date = Carbon::now();
        $data->user_id = auth()->user()->id;

        $data->save();

        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function get(int $id)
    {
        return Data::whereUserId(auth()->user()->id)->orderBy("date")->whereId($id)->first();
    }
}
