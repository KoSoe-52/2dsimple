<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwodList extends Model
{
    use HasFactory;
    protected $fillable =["name","status"];
    public function twodTotal(){
        return $this->hasMany("App\Models\TwodLuckyRecord","number","number");
    }
    public function terminateNumber(){
        return $this->belongsTo("App\Models\TerminateNumber","number","number");
    }
    //dubai
    public function dubaitwodTotal(){
        return $this->hasMany("App\Models\DubiaLuckRecord","number","number");
    }
    public function dubaiterminateNumber(){
        return $this->belongsTo("App\Models\DubaiTerminateNumber","number","number");
    }
}
