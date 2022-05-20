<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TwodList;
use App\Models\TwodLuckyRecord;
use App\Models\TerminateNumber;
class ModeratorController extends Controller
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
        return view("moderator.index",compact("twodlists"));
    }
    public function remaining($array=array())
    {
        date_default_timezone_set("Asia/Yangon");
        //07-05-2022 15:19
        $time = date("Hi");
        
        // $time="0003";
        //မနက်ပိုင်း
        if($time >= "0000" && $time <= "1159")//changed
        {
            $time = "12:01";
            $date = date("Y-m-d");
            /*
            * loop 100
            */ 
            $amountOfNumber = array();
            foreach($array as $key=>$data)
            {
                $results = DB::select( DB::raw("SELECT SUM(price) as amount FROM twod_lucky_records 
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
        }else if($time >= "1230" && $time <= "1620")//changed
        {
            //db ထဲထည့်ရန်
            $time="16:30";
            $date = date("Y-m-d");
            /*
            * loop 100
            */ 
            $amountOfNumber = array();
            foreach($array as $key=>$data)
            {
                $results = DB::select( DB::raw("SELECT SUM(price) as amount FROM twod_lucky_records 
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
        }else if($time >= "1700" && $time <= "2359")
        {
            // နောက်ရက် မနက်ပိုင်းအတွက်ထိုးပေးရမယ်
            //db ထဲထည့်ရန်
             $time="12:01";
            $currentDate = date("Y-m-d");
            $nextDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
            /*
            * loop 100
            */ 
            $amountOfNumber = array();
            foreach($array as $key=>$data)
            {
                $results = DB::select( DB::raw("SELECT SUM(price) as amount FROM twod_lucky_records 
                    WHERE number = :number AND date=:date AND time=:time AND user_id=:user_id"), 
                    array(
                        'number' => $data->number,
                        'date'   => $nextDate,//next day
                        'time'   => $time,
                        'user_id' => Auth::user()->id
                    )
                );
                $status = $this->breakNumbers($nextDate,$time,$data->number);
                $remainingAmount = Auth::user()->break - $results[0]->amount;
                $amountOfNumber[]=array("number"=>$data->number,"remaining"=>$remainingAmount,"status"=>$status);
            }
            return $amountOfNumber;
        }else
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
        }
    }
    public function breakNumbers($date,$time,$number)
    {
        $count = TerminateNumber::whereDate("date",$date)
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
        $validate = Validator::make($request->only('number','amount'), [
            'number' => 'required',
            'amount' => 'required',
            //'name'   => 'required'
        ]);
        if ($validate->fails()) {
            return "hello";
        } else {
            date_default_timezone_set("Asia/Yangon");
            //07-05-2022 15:19
            $time = date("Hi");
            // $time="0003";
            //မနက်ပိုင်း
            if($time >= "0000" && $time <= "1159")//changed
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
                return response()->json([
                    "status" => true,
                    "data"   => $vouncher_id
                ]);
            }else if($time >= "1230" && $time <= "1620")//changed
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
                return response()->json([
                    "status" => true,
                    "data"   => $vouncher_id
                ]);
            }else if($time >= "1700" && $time <= "2359") // ညနေပိုင်းဖြစ်လို့ နောက်ရက် 12:01 အချိန်ဖြစ်ပါသည်
            {
                $vouncher_id = $this->getVouncherId();
                //နောက်ရက် မနက်ပိုင်း 12:01 အချိန်အတွက်ထိုးခြင်းဖြစ်ပါသည်
                $currentDate = date("Y-m-d");
                $nextDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
                foreach($request->number as $key=>$number)
                {
                    TwodLuckyRecord::create([
                        "name"   => $request->get("name"),
                        "date"   => $nextDate,
                        "time" => "12:01",
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
            }else
            {
                return response()->json([
                    "status" => false,
                    "data"   => "ခဏရပ်နားထားပါသည်"
                ]);
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
        $time = date("Hi");
        // if($time >= "0000" && $time <= "1159")//changed
        // {
        //     $date = date("Y-m-d");
        //     $time = "12:01";
        // }else if($time >= "1230" && $time <= "1620")//changed
        // {
        //     $date = date("Y-m-d");
        //     $time="16:30";
        // }else if($time >= "1700" && $time <= "2359") // ညနေပိုင်းဖြစ်လို့ နောက်ရက် 12:01 အချိန်ဖြစ်ပါသည်
        // {
        //     //နောက်ရက် မနက်ပိုင်း 12:01 အချိန်အတွက်ထိုးခြင်းဖြစ်ပါသည်
        //     $currentDate = date("Y-m-d");
        //     $date = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        //     $time ="12:01";
        // }else
        // {
        //     //အချက်အလက်မရှိပါ
        //     $histories = [];
        //     return view("moderator.history",compact("histories"));
        // }
        $histories = TwodLuckyRecord::select("name","date","time","vouncher_id")
                    ->where("user_id",Auth::user()->id)
                    //->where("time",$time)
                    ->groupBy("vouncher_id","date","time","name")
                    ->orderBy("vouncher_id","DESC");
        $countArray = array();
        if(!empty($request->get("date")))
        {
            $countArray[] =$histories->whereDate("twod_lucky_records.date","=",$request->get("date"));
        }
        if(!empty($request->get("time")))
        {
            $countArray[] =$histories->where("twod_lucky_records.time","=",$request->get("time"));
        }
        if (count($countArray) > 0) {
            $histories = $histories->get();
        }else
        {
            $date = date("Y-m-d");
            $histories = $histories->whereDate("twod_lucky_records.date","=",$date)->get();
        }
        return view("moderator.history",compact("histories"));
    }
    /*
    * vouncher id
    */
    public function vouncher($id)
    {
        $vounchers = TwodLuckyRecord::where("vouncher_id",$id)
                   ->where("user_id",Auth::user()->id)
                   ->get();
        return view("moderator.vouncher",compact("vounchers"));
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
