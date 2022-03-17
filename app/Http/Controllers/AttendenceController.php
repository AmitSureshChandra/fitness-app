<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use App\Models\Branch;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Attendence::query()
            ->whereUserId(auth()->user()->id);

        if ($request->has("date") && !empty($request->date)) {
            $query->where("date", "LIKE", "%$request->date%");
        }

        return $query->orderBy("created_at")->paginate(10);
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
            'action' => 'required'
        ]);

        if (!in_array($request->action, ["IN", "OUT"])) {
            return response([
                "message" => "action can be either 'IN' or 'OUT'"
            ], 422);
        }

        if (
            $request->action == "OUT" &&
            is_null(Attendence::whereAction("IN")->whereUserId(auth()->user()->id)->where("date", "LIKE", Carbon::now()->format("Y-m-d"))->first())
        ) {
            return response([
                "message" => "IN action not exist"
            ], 422);
        }

        $attendence = new Attendence;
        $attendence->user_id = auth()->user()->id;
        $attendence->date =
            Carbon::now();

        $attendence->time = Carbon::now()->format("H:i:s");
        $attendence->action = $request->action;
        $attendence->branch_id = Branch::whereName("ABC")->first()->id;

        $attendence->save();

        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function get(int $id)
    {
        return Attendence::whereUserId(auth()->user()->id)->whereId($id)->first();
    }
}
