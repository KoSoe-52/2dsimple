<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreedList extends Model
{
    use HasFactory;
    protected $fillable=["name"];
    public function threedTerminateNumber(){
        return $this->belongsTo("App\Models\ThreedTerminateNumber","number","number");
    }
    public function threedTotal(){
        return $this->hasMany("App\Models\ThreedLuckyRecord","number","number");
    }
}
