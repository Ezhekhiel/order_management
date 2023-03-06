<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dailyBalance extends Model
{
    public $timestamps = true;
    protected $table = "daily_balance_percobaans";
    protected $guarded  = [];
}
