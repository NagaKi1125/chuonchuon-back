<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class PredictHistory extends Eloquent
{
    use HasFactory;

    protected $connection ="mongodb";
    protected $fillable = [
        'user_id',
        'result_id',
        'cloud_name',
    ];
}
