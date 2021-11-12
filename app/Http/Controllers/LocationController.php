<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function saveLocation(Request $req){
        $geo = new Location();
        $lat = $req->lat;
        $lon = $req->lon;
        $geo->user_id = Auth::user()->_id;
        $geo->lat = $lat;
        $geo->lon = $lon;
        $geo->save();

        return view('adminhome');
    }
}
