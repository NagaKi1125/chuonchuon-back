<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily extends Model
{
    use HasFactory;

    protected $fillable = [
        'dt','sunrise','sunset','moonrise','moonset','moon_phase',
        'temp_morn','temp_day','temp_eve','temp_night','temp_min','temp_max',
        'pressure','humidity','dew_point','wind_speed','wind_deg','clouds','pop','uvi',
        'weather_id','weather_main','weather_description','weather_icon'
    ];
}
