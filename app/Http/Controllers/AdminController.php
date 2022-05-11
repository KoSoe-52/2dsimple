<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Role;
use App\Models\Branch;
use App\Models\TwodLuckyRecord;
use App\Models\TwodList;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route("admin.twodrecords");
    }
    public function showUsers()
    {
        //$roles= Role::all();
        //$branches= Branch::all();
        $users = User::where("branch_id",Auth::user()->branch_id)->where("role_id",3)->paginate(10);
        return  view("users.index",compact('users'));

    }
    public function twodrecords(Request $request)
    {
        date_default_timezone_set("Asia/Yangon");
        $users = User::where("branch_id",Auth::user()->branch_id)->where("role_id",3)->get();
        $records = TwodLuckyRecord::leftJoin("users","users.id","=","twod_lucky_records.user_id")
            ->where("users.branch_id",Auth::user()->branch_id);
            $countArray = array();
        if(!empty($request->get("number")))
        {
            $countArray[] =$records->where("twod_lucky_records.number","=",$request->get("number"));
        }
        if(!empty($request->get("date")))
        {
            $countArray[] =$records->whereDate("twod_lucky_records.date","=",date("Y-m-d",strtotime($request->get("date"))));
        }
        if(!empty($request->get("time")))
        {
            $countArray[] =$records->where("twod_lucky_records.time","=",$request->get("time"));
        }
        if(!empty($request->get("user_id")))
        {
            $countArray[] =$records->where("twod_lucky_records.user_id","=",$request->get("user_id"));
        }
        if(!empty($request->get("condition")) && !empty($request->get("price")))
        {
            $countArray[] =$records->where("twod_lucky_records.price",$request->get("condition"),$request->get("price"));
        }
        if (count($countArray) > 0) {
            $records = $records->orderBy("twod_lucky_records.id","DESC")->get();
            //$records = $records->appends($request->all());
        }else
        {
            $time = date("Hi");
            $date = date("Y-m-d");
            // $time="0003";
            //မနက်ပိုင်း
            if($time >= "0001" && $time <= "1229")
            {
                $twodTime = "12:01";
            }else 
            {
                $twodTime = "16:30";
            }
           $records = $records->whereDate("date",Carbon::now())
                        ->where("time",$twodTime)->orderBy("twod_lucky_records.id","DESC")->get();
           // $records = $records->paginate(10);
        }
        return view("twod_lucky_records.index",compact("records","users"));
    }
    public function storeUsers(Request $request)
    {
        $users = User::create([
            "name" => $request->get("name"),
            "password" => Hash::make($request->get("password")),
            "phone" => $request->get("phone"),
            "status" => $request->get("status"),
            "break" => $request->get("break"),            
            "role_id" => 3,
            "branch_id" => Auth::user()->branch_id,          
        ]);
        return redirect("/users")->with("status","Successfully created New_user");
    }
    public function editUsers($user_id)
    {
        //$roles=Role::all();
       // $branches=Branch::all();
        $users = User::whereId($user_id)->get();
        return  view("users.useredit",compact('users'));
    }
    public function updateUsers(Request $request, $update_id)
    {
        $users=User::whereId($update_id)->firstOrFail();
        $users->name= $request->get('name');
        if(empty($request->get("password")))
        {
            $users->password = $users->password;
        }else
        {
            $users->password= Hash::make($request->get('password'));
        }
        $users->phone= $request->get('phone');
        $users->status= $request->get('status');
        $users->break= $request->get('break');
        $users->update();
        return redirect()->action([AdminController::class,'editUsers'], ['id' => $update_id])
        ->with("status","Successfully updated!");
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
        // $time="0003";
        //မနက်ပိုင်း
        if($time >= "0001" && $time <= "1229")
        {
            $twodTime = "12:01";
            //whereDate("date",$date)->where("time",$twodTime)
            $twodlists = TwodList::all();
            $numberTotal = array();
            foreach($twodlists as $key=>$twodlist)
            {
                $numberTotal[$twodlist->number]=$twodlist->twodTotal()->whereDate("date",$date)
                ->where("time",$twodTime)
                ->where("number",$twodlist->number)
                ->leftJoin("users","users.id","=","user_id")
                ->where("users.branch_id",Auth::user()->branch_id)
                ->sum("price");
            }
        }else if($time >= "1230" && $time <= "2359")
        {
            $twodTime = "16:30";
            
            $twodlists = TwodList::all();
            $numberTotal = array();
            foreach($twodlists as $key=>$twodlist)
            {
                $numberTotal[$twodlist->number]=$twodlist->twodTotal()->whereDate("date",$date)
                ->where("time",$twodTime)
                ->where("number",$twodlist->number)
                ->leftJoin("users","users.id","=","user_id")
                ->where("users.branch_id",Auth::user()->branch_id)
                ->sum("price");
            }
        }
        
        return view("twod_lists.index",compact("numberTotal","twodTime"));
    }
}
