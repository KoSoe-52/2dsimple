<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreedLuckyRecord extends Model
{
    use HasFactory;
    protected $fillable =["name","phone","date","number","price","user_id","vouncher_id","inser_date_time"];
    public function users(){
        return $this->belongsTo("App\Models\User","user_id","id");
    }
}
