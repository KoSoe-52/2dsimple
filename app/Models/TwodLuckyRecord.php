<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwodLuckyRecord extends Model
{
    use HasFactory;
    protected $fillable =["name","phone","date","time","number","price","user_id","vouncher_id"];
    public function users(){
        return $this->belongsTo("App\Models\User","user_id","id");
    }
}
