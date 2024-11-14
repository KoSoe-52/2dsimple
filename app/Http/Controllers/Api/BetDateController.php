<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BetDate;
use App\Models\Bet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class BetDateController extends Controller
{
    public function getDate()
    {
        $results = BetDate::select('id','date',
                        DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y %H:%i:%s') as created"))
                        ->orderBy("created_at","DESC")
                    ->get();
        return response()->json([
            "status" => true,
            "msg" => " Get all date",
            "data" => $results
        ]);
    }
    public function deleteDate(Request $request)
    {
        $date = date("Y-m-d",strtotime($request->date));
        $count = Bet::where("date",$date)->count();
        if($count < 1)
        {
            $results = BetDate::whereDate("date",$date)->delete();
            return response()->json([
                "status" => true,
                "msg" => "Successfully deleted",
                "data" => []
            ]);
        }else
        {
            return response()->json([
                "status" => false,
                "msg" => "အချက်အလက်များကို ဦးစွာဖျက်ပါ...",
                "data" => []
            ],404);
        }  
    }
}
