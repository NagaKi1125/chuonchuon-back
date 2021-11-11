<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hourly extends Model
{
    use HasFactory;

    protected $fillable = [
        'dt','temp','feels_like','pressure','humidity','dew_point','uvi',
        'clouds','visibility','wind_speed','wind_deg','pop','weather_id',
        'weather_main','weather_description','weather_icon',
    ];
}
