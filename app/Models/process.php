<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class process extends Model
{
    public $timestamps = true;
    protected $table = "process";
    protected $guarded  = [];
}
