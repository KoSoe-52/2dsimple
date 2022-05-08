<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\TwodList;
use App\Models\TwodLuckyRecord;
class ModeratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $twodlists = TwodList::all();
        return view("moderator.index",compact("twodlists"));
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
        $validate = Validator::make($request->only('number','amount','name'), [
            'number' => 'required',
            'amount' => 'required',
            'name'   => 'required'
        ]);
        if ($validate->fails()) {
            return "hello";
        } else {
            date_default_timezone_set("Asia/Yangon");
            //07-05-2022 15:19
            $time = date("Hi");
           // $time="0003";
            //မနက်ပိုင်း
            if($time >= "0001" && $time <= "1150")
            {
                $vouncher_id = $this->getVouncherId();
               foreach($request->number as $key=>$number)
                {
                    TwodLuckyRecord::create([
                        "name"   => $request->get("name"),
                        "date"   => date("Y-m-d"),
                        "time" => "12:01",
                        "number" => $request->get("number")[$key],
                        "price" => $request->get("amount")[$key],
                        "user_id" => Auth::user()->id,
                        "vouncher_id" => $vouncher_id
                    ]);
                }
            }else if($time >= "1230" && $time <= "1620")
            {
                $vouncher_id = $this->getVouncherId();
                foreach($request->number as $key=>$number)
                {
                    TwodLuckyRecord::create([
                        "name"   => $request->get("name"),
                        "date"   => date("Y-m-d"),
                        "time" => "16:30",
                        "number" => $request->get("number")[$key],
                        "price" => $request->get("amount")[$key],
                        "user_id" => Auth::user()->id,
                        "vouncher_id" => $vouncher_id
                    ]);
                }
            }else
            {
                return date("d-m-Y Hi")."Rest time";
            } 
        }
    }
    public function getVouncherId()
    {
        $vouncher = TwodLuckyRecord::latest()->first();
        if(!empty($vouncher))
        {
            return $vouncher->vouncher_id + 1;
        }else
        {
            return 1;
        }
    }
    public function history(Request $request)
    {
        date_default_timezone_set("Asia/Yangon");
        $date = date("Y-m-d");
        $histories = TwodLuckyRecord::whereDate("date",$date)
                    ->select("name","date","time","vouncher_id")
                    ->groupBy("name","date","time","vouncher_id")
                    ->get();
        return $histories;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
