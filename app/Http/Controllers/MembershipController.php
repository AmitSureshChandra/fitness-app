<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Membership::whereUserId(auth()->user()->id)->get();
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
            "payment_mode" => "required",
            "amount" => "required|integer",
            "months" => "required|integer",
            "status" => "required"
        ]);

        if (!in_array($request->status, ["DONE", "CANCELLED", "PENDING"])) {
            return response([
                "message" => 'status can one value from  ["DONE", "CANCELLED", "PENDING"]'
            ], 422);
        }

        if (!in_array($request->payment_mode, ["GPAY", "PAYTM", "PHONEPE", "OTHER"])) {
            return response([
                "message" => 'status can one value from ["GPAY", "PAYTM", "PHONEPE", "OTHER"]'
            ], 422);
        }


        $membership = new Membership();
        $membership->user_id = auth()->user()->id;
        $membership->payment_mode = $request->payment_mode;
        $membership->amount = $request->amount;
        $membership->status = $request->status;
        $membership->months = $request->months;

        if ($request->payment_mode == "OTHER" && $request->has("other_detail")) {
            $membership->payment_mode =   $request->payment_mode . "(" . ($request->other_detail) . ")";
        }

        $membership->save();

        return $membership;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function get(int $id)
    {
        return Membership::whereUserId(auth()->user()->id)->whereId($id)->first();
    }
}
