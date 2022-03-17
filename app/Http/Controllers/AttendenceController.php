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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show(Attendence $attendence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendence $attendence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendence $attendence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendence $attendence)
    {
        //
    }
}
