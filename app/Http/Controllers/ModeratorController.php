<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
            //$time="0001";
            //မနက်ပိုင်း
            if($time >= "0001" && $time <= "1150")
            {
               foreach($request->number as $key=>$number)
                {
                    TwodLuckyRecord::create([
                        "name"   => $request->get("name")[$key],
                        "date"   => date("Y-m-d"),
                        "time_id" => 1,
                        "twod_id" => aa,
                        "price" => $request->get("amount")[$key],
                        "user_id" => Auth::user()->id
                    ]);
                }
            }else if($time >= "1230" && $time <= "1620")
            {
                return date("d-m-Y Hi")."evening";
            }else
            {
                return date("d-m-Y Hi")."Rest time";
            }
            
        }
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
