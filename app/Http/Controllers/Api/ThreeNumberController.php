<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ThreedList;
class ThreeNumberController extends Controller
{
    public function threeNumber()
    {
        date_default_timezone_set("Asia/Yangon");
        $amountOfNumber = array();
        $total  = [];
        $td1000 = ThreedList::all();
        foreach($td1000 as $key=>$data)
        {
            $results = DB::table("bets")
                    ->select(DB::raw('SUM(bets.amount) as amount'))
                    ->where("bets.number",$data->number)
                    ->where("bets.date","2024-11-16");
            $results = $results->get();
            $amountOfNumber[]=array(
                "number"=>$data->number,
                "amount" => $results[0]->amount == null ? 0: $results[0]->amount
            );
            $total[] = $results[0]->amount == null ? 0: $results[0]->amount;
        }
        return response()->json([
            "status" => true,
            "msg" => " Three number list",
            "data" => $amountOfNumber,
            "total" => number_format(array_sum($total),2)
        ]);
    }
}
