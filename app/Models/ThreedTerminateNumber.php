<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreedTerminateNumber extends Model
{
    use HasFactory;
    protected $fillable=["date","number","branch_id"];
}