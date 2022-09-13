<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Role;
use App\Models\Branch;
use App\Models\DubiaLuckRecord;
use App\Models\TwodList;
use App\Models\TwodTime;
use App\Models\DubaiTerminateNumber;
class DubiaLuckyRecordController extends Controller
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
    public function twodrecords(Request $request)
    {
        date_default_timezone_set("Asia/Yangon");
        $users = User::where("branch_id",Auth::user()->branch_id)->where("role_id",3)->get();
        $records = DubiaLuckRecord::select('dubia_luck_records.*')
            ->leftJoin("users","users.id","=","dubia_luck_records.user_id")
            ->where("users.branch_id",Auth::user()->branch_id);
            $countArray = array();
        if(!empty($request->get("number")))
        {
            $countArray[] =$records->where("dubia_luck_records.number","=",$request->get("number"));
        }
        if(!empty($request->get("date")))
        {
            $countArray[] =$records->whereDate("dubia_luck_records.date","=",date("Y-m-d",strtotime($request->get("date"))));
        }
        if(!empty($request->get("time")))
        {
            $countArray[] =$records->where("dubia_luck_records.time","=",$request->get("time"));
        }
        if(!empty($request->get("user_id")))
        {
            $countArray[] =$records->where("dubia_luck_records.user_id","=",$request->get("user_id"));
        }
        if(!empty($request->get("condition")) && !empty($request->get("price")))
        {
            $countArray[] =$records->where("dubia_luck_records.price",$request->get("condition"),$request->get("price"));
        }
        if (count($countArray) > 0) {
            $records = $records->orderBy("dubia_luck_records.id","DESC")->get();
            //$records = $records->appends($request->all());
        }else
        {
            $time = date("Hi");
            $date = date("Y-m-d");
            // $time="0003";
            //မနက်ပိုင်း
            if($time >= "0000" && $time <= "1114")//for 11
            {
                $twodTime = "11:00";
            }else if($time >= "1115" && $time <= "1314")//for 11
            {
                $twodTime = "13:00";
            }else if($time >= "1315" && $time <= "1514")//for 11
            {
                $twodTime = "15:00";
            }else if($time >= "1515" && $time <= "1714")//for 11
            {
                $twodTime = "17:00";
            }else if($time >= "1715" && $time <= "1914")//for 11
            {
                $twodTime = "19:00";
            }else if($time >= "1915" && $time <= "2359")//for 11
            {
                $twodTime = "21:00";
            }
            $records = $records->whereDate("date",Carbon::now())
                        ->where("time",$twodTime)->orderBy("dubia_luck_records.id","DESC")->get();
            
           
           // $records = $records->paginate(10);
        }
        return view("dubia_luck_records.index",compact("records","users"));
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
    public function twodList(Request $request)
    {
        date_default_timezone_set("Asia/Yangon");
        //07-05-2022 15:19
        $time = date("Hi");
        $date = date("Y-m-d");
        $terminatedNumbers = array();
        if($time >= "0000" && $time <= "1114")//for 11
        {
            $twodTime = "11:00";
        }else if($time >= "1115" && $time <= "1314")//for 11
        {
            $twodTime = "13:00";
        }else if($time >= "1315" && $time <= "1514")//for 11
        {
            $twodTime = "15:00";
        }else if($time >= "1515" && $time <= "1714")//for 11
        {
            $twodTime = "17:00";
        }else if($time >= "1715" && $time <= "1914")//for 11
        {
            $twodTime = "19:00";
        }else if($time >= "1915" && $time <= "2359")//for 11
        {
            $twodTime = "21:00";
        }
        $twodlists = TwodList::all();
        $numberTotal = array();
        foreach($twodlists as $key=>$twodlist)
        {
            $numberTotal[$twodlist->number]=$twodlist->dubaitwodTotal()->whereDate("date",$date)
            ->where("time",$twodTime)
            ->where("number",$twodlist->number)
            ->leftJoin("users","users.id","=","user_id")
            ->where("users.branch_id",Auth::user()->branch_id)
            ->sum("price");
            /*
            *terminate ထဲမှာ ပိတ်လား မပိတ်လား သိအောင် စစ်ဆေးမည်
            */
            $numberOfRow = $twodlist->dubaiterminateNumber()->whereDate("dubai_terminate_numbers.date",$date)
                                        ->where("dubai_terminate_numbers.time",$twodTime)
                                        ->where("dubai_terminate_numbers.number",$twodlist->number)
                                        ->where("dubai_terminate_numbers.branch_id",Auth::user()->branch_id)
                                        ->count();
            /*
            * break လုပ်ထားတဲ့ number တွေကို terminatedNumbers  array ထဲထည့်ခဲ့ရမယ်
            */
            if($numberOfRow > 0)
            {
                $terminatedNumbers[] = $twodlist->number;
            }
        }
        if($request->get("sorting") == "sortingamount")
        {
            arsort($numberTotal);
        }
        return view("twod_lists.dubai",compact("numberTotal","twodTime","date","terminatedNumbers"));
    }
    public function terminate($id)
    {
        date_default_timezone_set("Asia/Yangon");
        $time = date("Hi");
        $date = date("Y-m-d");
        if($time >= "0000" && $time <= "1114")//for 11
        {
            $time = "11:00";
        }else if($time >= "1115" && $time <= "1314")//for 11
        {
            $time = "13:00";
        }else if($time >= "1315" && $time <= "1514")//for 11
        {
            $time = "15:00";
        }else if($time >= "1515" && $time <= "1714")//for 11
        {
            $time = "17:00";
        }else if($time >= "1715" && $time <= "1914")//for 11
        {
            $time = "19:00";
        }else if($time >= "1915" && $time <= "2359")//for 11
        {
            $time = "21:00";
        }
       $break =  DubaiTerminateNumber::create([
            "date"   => $date,
            "time"   => $time,
            "number" => $id,
            "branch_id" => Auth::user()->branch_id
        ]);
        return response()->json([
            "status" => true,
            "msg" => "Success",
            "data" => $break
        ]);
    }
    public function open($id)
    {
        date_default_timezone_set("Asia/Yangon");
        $time = date("Hi");
        $date = date("Y-m-d");
        if($time >= "0000" && $time <= "1114")//for 11
        {
            $time = "11:00";
        }else if($time >= "1115" && $time <= "1314")//for 11
        {
            $time = "13:00";
        }else if($time >= "1315" && $time <= "1514")//for 11
        {
            $time = "15:00";
        }else if($time >= "1515" && $time <= "1714")//for 11
        {
            $time = "17:00";
        }else if($time >= "1715" && $time <= "1914")//for 11
        {
            $time = "19:00";
        }else if($time >= "1915" && $time <= "2359")//for 11
        {
            $time = "21:00";
        }
        $delete = DubaiTerminateNumber::whereDate("date",$date)
                        ->where("time",$time)
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

    public function dubaitwodrecords_delete($recId)
    {
        $DeleteRec = DubiaLuckRecord::find($recId);
        $DeleteRec->delete();
        return response()->json([
            "status" => true,
            "msg" => "Success",
            "data" => []
        ]);
    }
}
