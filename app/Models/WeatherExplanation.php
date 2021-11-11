<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class WeatherExplanation extends Eloquent
{
    use HasFactory;

    protected $connection = "mongodb";

    protected $fillable = [
        'type',
        'explanation',
        'user_id',
        'checked',
    ];
}
