<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TwodList;
use App\Models\DubiaLuckRecord;
use App\Models\DubaiTerminateNumber;
class DubaiModeratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $twod100 = TwodList::all();
        $twodlists = $this->remaining($twod100);
        return view("moderator.dubaiindex",compact("twodlists"));
    }
    public function remaining($array=array())
    {
        date_default_timezone_set("Asia/Yangon");
        //07-05-2022 15:19
        $time = date("Hi");
        $date = date("Y-m-d");
        if($time >= "0900" && $time <= "1055")//for 11
        {
            $time = "11:00";
        }else if($time >= "1130" && $time <= "1255")//for 11
        {
            $time = "13:00";
        }else if($time >= "1330" && $time <= "1455")//for 11
        {
            $time = "15:00";
        }else if($time >= "1530" && $time <= "1655")//for 11
        {
            $time = "17:00";
        }else if($time >= "1730" && $time <= "1855")//for 11
        {
            $time = "19:00";
        }else if($time >= "1930" && $time <= "2055")//for 11
        {
            $time = "21:00";
        }else
        {
            $time = "21:00";
            //$time ="breakTime";
        }
        if($time == "breakTime")
        {
             /*
            * loop 100
            * rest time
            * status 1 is in active
            */ 
            $amountOfNumber = array();
            foreach($array as $key=>$data)
            {
                $amountOfNumber[]=array("number"=>$data->number,"remaining"=>"breaktime","status"=>1);
            }
            return $amountOfNumber;
        }else
        {
            /*
            * loop 100
            */ 
            $amountOfNumber = array();
            foreach($array as $key=>$data)
            {
                $results = DB::select( DB::raw("SELECT SUM(price) as amount FROM dubia_luck_records 
                    WHERE number = :number AND date=:date AND time=:time AND user_id=:user_id"), 
                    array(
                        'number' => $data->number,
                        'date'   => $date,
                        'time'   => $time,
                        'user_id' => Auth::user()->id
                    )
                );
                $status = $this->breakNumbers($date,$time,$data->number);
                $remainingAmount = Auth::user()->break - $results[0]->amount;
                $amountOfNumber[]=array("number"=>$data->number,"remaining"=>$remainingAmount,"status"=>$status);
            }
            return $amountOfNumber;
        }
    }
    public function breakNumbers($date,$time,$number)
    {
        $count = DubaiTerminateNumber::whereDate("date",$date)
                ->where("time",$time)
                ->where("number",$number)
                ->where("branch_id",Auth::user()->branch_id)
                ->count();
        if($count > 0)
        {
            return 1;
        }else
        {
            return 0;
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("moderator.twodoption");
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->only('number','amount'), [
            'number' => 'required',
            'amount' => 'required',
            //'name'   => 'required'
        ]);
        if ($validate->fails()) {
            return response()->json([
                "status" => false,
                "data"   => "Amount and Number သတ်မှတ်ပါ"
            ]);
        } else {
            date_default_timezone_set("Asia/Yangon");
            //07-05-2022 15:19
            $time = date("Hi");
            if($time >= "0900" && $time <= "1055")//for 11
            {
                $time = "11:00";
            }else if($time >= "1130" && $time <= "1255")//for 11
            {
                $time = "13:00";
            }else if($time >= "1330" && $time <= "1455")//for 11
            {
                $time = "15:00";
            }else if($time >= "1530" && $time <= "1655")//for 11
            {
                $time = "17:00";
            }else if($time >= "1730" && $time <= "1855")//for 11
            {
                $time = "19:00";
            }else if($time >= "1930" && $time <= "2055")//for 11
            {
                $time = "21:00";
            }else
            {
                $time = "21:00";
                //$time ="breakTime";
            }
            if($time == "breakTime")
            {
                return response()->json([
                    "status" => false,
                    "data"   => "ခဏရပ်နားထားပါသည်"
                ]);
            }else
            {
                $vouncher_id = $this->getVouncherId();
               foreach($request->number as $key=>$number)
                {
                    DubiaLuckRecord::create([
                        "name"   => $request->get("name"),
                        "date"   => date("Y-m-d"),
                        "time" => $time,
                        "number" => $request->get("number")[$key],
                        "price" => $request->get("amount")[$key],
                        "user_id" => Auth::user()->id,
                        "vouncher_id" => $vouncher_id
                    ]);
                }
                return response()->json([
                    "status" => true,
                    "data"   => $vouncher_id
                ]);
            }
        }
    }
    public function getVouncherId()
    {
        $vouncher = DubiaLuckRecord::latest()->first();
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
        $time = date("Hi");

        $histories = DubiaLuckRecord::select("name","date","time","vouncher_id")
                    ->where("user_id",Auth::user()->id)
                    //->where("time",$time)
                    ->groupBy("vouncher_id","date","time","name")
                    ->orderBy("vouncher_id","DESC");
        $countArray = array();
        if(!empty($request->get("date")))
        {
            $countArray[] =$histories->whereDate("dubia_luck_records.date","=",$request->get("date"));
        }
        if(!empty($request->get("time")))
        {
            $countArray[] =$histories->where("dubia_luck_records.time","=",$request->get("time"));
        }
        if (count($countArray) > 0) {
            $histories = $histories->get();
        }else
        {
            $date = date("Y-m-d");
            $histories = $histories->whereDate("dubia_luck_records.date","=",$date)->get();
        }
        return view("moderator.history",compact("histories"));
    }
    /*
    * vouncher id
    */
    public function vouncher($id)
    {
        $vounchers = DubiaLuckRecord::where("vouncher_id",$id)
                   ->where("user_id",Auth::user()->id)
                   ->get();
        return view("moderator.vouncher",compact("vounchers"));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 

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
