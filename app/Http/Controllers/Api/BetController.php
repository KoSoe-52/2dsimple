<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bet;
use App\Models\BetDate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class BetController extends Controller
{
    public function insert(Request $request)
    {
        date_default_timezone_set("Asia/Yangon");
        foreach($request->bets as $key=>$bet)
        {
            $token = $this->generateTokenWithDate();
            $date = date("Y-m-d",strtotime($bet["date"]));
            foreach($bet["numberArray"] as $key=> $num)
            {
                Bet::create([
                    "date" => $date,
                    "time" => "15:00",
                    "number" => $num,
                    "amount" => $bet["condition"].$bet["amount"],
                    "user_id" => Auth::user()->id,
                    "token" => $token
                ]);
            }
            
        } // foreach end
        return response()->json([
            "status" => true,
            "msg" => "Successfully created",
            "data" => []
        ]);
    }
    public function generateTokenWithDate()
    {
        // Generate a unique token
        $token = Str::random(20,'0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'); // Adjust the length as needed
        // Append current date to the token
        $token .= '-' . now()->format('dmYHis');
        return $token;
    }
    public function betDetail(Request $request)
    {
        $date = BetDate::orderBy("date","DESC")->first();
        $results = Bet::select('token', DB::raw('GROUP_CONCAT(number) as merged_number'),'date',
                        DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y %H:%i:%s') as created"),
                        DB::raw('count(*) as total_row'),'amount')
                    ->where("date",$date->date)
                    ->groupBy(['token','date','created_at','amount'])
                    ->orderBy("created_at","ASC")
                    ->get();
        return response()->json([
            "status" => true,
            "msg" => "Successfully get detail",
            "data" => $results
        ]);
    }
    public function deleteToken(Request $request)
    {
        
        $results = Bet::where("token",$request->token)->delete();
        return response()->json([
            "status" => true,
            "msg" => "Successfully deleted",
            "data" => $request->token
        ]);
    }
}
