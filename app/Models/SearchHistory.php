<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class SearchHistory extends Eloquent
{
    use HasFactory;

    protected $connection = "mongodb";
    protected $fillable = [
        'user_id',
        'city_search',
        'city_lat',
        'city_lon',
    ];
}
