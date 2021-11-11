<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Cloud extends Eloquent
{
    use HasFactory;
    protected $connection = "mongodb";

    protected $fillable = [
        'cloud_code',
        'cloud_name',
        'structure',
        'weather',
        'note',
        'img_thumbnail',
    ];
}
