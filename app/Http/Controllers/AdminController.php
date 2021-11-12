<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function user_view(){
        return view('user-manager');
    }

    public function cloud_view(){
        return view('cloud-manager');
    }

    public function predict_view(){
        return view('predict-result');
    }

    public function weather_explain(){
        return view('weather-explain');
    }
}
