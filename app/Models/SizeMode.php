<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeMode extends Model
{
    public $timestamps = true;
    protected $table = "size_modes";
    protected $guarded  = [];
}
