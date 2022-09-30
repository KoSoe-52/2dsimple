<?php

namespace App\Http\Controllers;

use App\Models\ThreedLuckyRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ThreedLuckyRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        date_default_timezone_set("Asia/Yangon");
        $users = User::where("branch_id",Auth::user()->branch_id)->where("role_id",3)->get();
        $records = ThreedLuckyRecord::select('threed_lucky_records.*')
            ->leftJoin("users","users.id","=","threed_lucky_records.user_id")
            ->where("users.branch_id",Auth::user()->branch_id);
            $countArray = array();
        if(!empty($request->get("number")))
        {
            $countArray[] =$records->where("threed_lucky_records.number","=",$request->get("number"));
        }
        if(!empty($request->get("date")))
        {
            $countArray[] =$records->whereDate("threed_lucky_records.date","=",date("Y-m-d",strtotime($request->get("date"))));
        }
        if(!empty($request->get("user_id")))
        {
            $countArray[] =$records->where("threed_lucky_records.user_id","=",$request->get("user_id"));
        }
        if(!empty($request->get("condition")) && !empty($request->get("price")))
        {
            $countArray[] =$records->where("threed_lucky_records.price",$request->get("condition"),$request->get("price"));
        }
        if (count($countArray) > 0) {
            $records = $records->orderBy("threed_lucky_records.id","DESC")->get();
            //$records = $records->appends($request->all());
        }else
        {
            $day = date("d");
            if($day >=2 && $day <=16)
            {
                $Ym = date("Y-m-");
                $date = $Ym."16";
            }else if($day >=17 && $day<=31)
            {
                //next month
                $time = strtotime(date('Y-m-d'));
                $Ym = date("Y-m-", strtotime("+1 month", $time));
                 $date = $Ym."01";
            }else
            {
               // day 1 
               $Ym = date("Y-m-");
               $date = $Ym."01";
            }
           $records = $records->whereDate("date",$date)->orderBy("threed_lucky_records.id","DESC")->get();
        }
        return view("threed_lucky_records.index",compact("records","users"));
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
     * @param  \App\Models\ThreedLuckyRecord  $threedLuckyRecord
     * @return \Illuminate\Http\Response
     */
    public function show(ThreedLuckyRecord $threedLuckyRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ThreedLuckyRecord  $threedLuckyRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(ThreedLuckyRecord $threedLuckyRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ThreedLuckyRecord  $threedLuckyRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ThreedLuckyRecord $threedLuckyRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ThreedLuckyRecord  $threedLuckyRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(ThreedLuckyRecord $threedLuckyRecord)
    {
        //
    }
}
