<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cell_target extends Model
{
    public $timestamps = true;
    protected $table = "cell_targets";
    protected $fillable = ['cell', 'eolr', 'mp_direct'];
}
