<?php

namespace App\Http\Controllers;

use App\Models\ThreedList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ThreedListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        date_default_timezone_set("Asia/Yangon");
        /*
        * 1 , 16 ရက်နေ့ ထွက်သည့်အတွက်
        */
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
        $terminatedNumbers = array();
        $threedlists = ThreedList::all();
        $numberTotal = array();
        foreach($threedlists as $key=>$threedlist)
        {
            $numberTotal[$threedlist->number]=$threedlist->threedTotal()->whereDate("date",$date)
            ->where("number",$threedlist->number)
            ->leftJoin("users","users.id","=","user_id")
            ->where("users.branch_id",Auth::user()->branch_id)
            ->sum("price");
            /*
            *terminate ထဲမှာ ပိတ်လား မပိတ်လား သိအောင် စစ်ဆေးမည်
            */
            $numberOfRow = $threedlist->threedTerminateNumber()->whereDate("threed_terminate_numbers.date",$date)
                                        ->where("threed_terminate_numbers.number",$threedlist->number)
                                        ->where("threed_terminate_numbers.branch_id",Auth::user()->branch_id)
                                        ->count();
            /*
            * break လုပ်ထားတဲ့ number တွေကို terminatedNumbers  array ထဲထည့်ခဲ့ရမယ်
            */
            if($numberOfRow > 0)
            {
                $terminatedNumbers[] = $threedlist->number;
            }
        }
        if($request->get("sorting") == "sortingamount")
        {
            arsort($numberTotal);
        }
        return view("threed_lists.index",compact("numberTotal","date","terminatedNumbers"));
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
     * @param  \App\Models\ThreedList  $threedList
     * @return \Illuminate\Http\Response
     */
    public function show(ThreedList $threedList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ThreedList  $threedList
     * @return \Illuminate\Http\Response
     */
    public function edit(ThreedList $threedList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ThreedList  $threedList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ThreedList $threedList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ThreedList  $threedList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ThreedList $threedList)
    {
        //
    }
}
