<?php

namespace App\Http\Controllers;

use App\Models\ThreedTerminateNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ThreedTerminateNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ThreedTerminateNumber  $threedTerminateNumber
     * @return \Illuminate\Http\Response
     */
    public function show(ThreedTerminateNumber $threedTerminateNumber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ThreedTerminateNumber  $threedTerminateNumber
     * @return \Illuminate\Http\Response
     */
    public function edit(ThreedTerminateNumber $threedTerminateNumber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ThreedTerminateNumber  $threedTerminateNumber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ThreedTerminateNumber $threedTerminateNumber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ThreedTerminateNumber  $threedTerminateNumber
     * @return \Illuminate\Http\Response
     */
    public function destroy(ThreedTerminateNumber $threedTerminateNumber)
    {
        //
    }
    public function terminate(Request $request,$id)
    {
        date_default_timezone_set("Asia/Yangon");
       $break =  ThreedTerminateNumber::create([
            "date"   => date("Y-m-d",strtotime($request->date)),
            "number" => $id,
            "branch_id" => Auth::user()->branch_id
        ]);
        return response()->json([
            "status" => true,
            "msg" => "Success",
            "data" => []
        ]);
    }
    public function open(Request $request,$id)
    {
        date_default_timezone_set("Asia/Yangon");
        $delete = ThreedTerminateNumber::whereDate("date",$request->date)
                        ->where("number",$id)
                        ->where("branch_id",Auth::user()->branch_id)
                        ->delete();
        if($delete == true)
        {
            return response()->json([
                "status" => true,
                "msg" => "Success",
                "data" => []
            ]);
        }else
        {
            return response()->json([
                "status" => false,
                "msg" => "Fail",
                "data" => []
            ]); 
        }
    }
}
