<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function user_view(){
        $user = User::all();
        return view('user-manager',['user'=>$user]);
    }



    public function predict_view(){
        return view('predict-result');
    }

    public function weather_explain(){
        return view('weather-explain');
    }
}
