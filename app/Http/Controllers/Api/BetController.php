<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bet;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class BetController extends Controller
{
    public function insert(Request $request)
    {
        date_default_timezone_set("Asia/Yangon");
        $token = $this->generateTokenWithDate();
        foreach($request->bets as $key=>$bet)
        {
            $date = date("Y-m-d",strtotime($bet["date"]));
            foreach($bet["numberArray"] as $key=> $num)
            {
                Bet::create([
                    "date" => $date,
                    "time" => "15:00",
                    "number" => $num,
                    "amount" => $bet["amount"],
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
}
