<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Current extends Model
{
    use HasFactory;
    protected $fillable = [
        'dt','sunrise','sunset','temp','feels_like','pressure','humidity',
        'dew_point','clouds','uvi','visibility','wind_speed',
        'wind_deg','weather_id','weather_main','weather_description','weather_icon'
    ];
}
