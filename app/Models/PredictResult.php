<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class PredictResult extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $fillable = [
        'user_id',
        'img_predict',
        'cloud_code',
        'cloud_id',
    ];
}
