<?php

namespace App\Http\Controllers;

use App\Models\City;
use Request;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Http;
use App\Models\Daily;
use App\Models\Current;
use App\Models\Hourly;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\RequestCount;

class WebPageController extends Controller
{

    function getIpAddress() {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipAddresses = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim(end($ipAddresses));
        }
        else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    public function dailyForecast(){
        $ip = $this->getIpAddress();
        $currentUserInfo = \Location::get($ip);
        $lat= $currentUserInfo->latitude;
        $lon =$currentUserInfo->longitude;
        dd($currentUserInfo);
        // $lat = 14.94826;
        // $lon = 108.9125679;

        $url = "https://api.openweathermap.org/data/2.5/onecall?lat=".$lat."8&lon=".$lon."&exclude=hourly,minutely,current&mode=json&units=metric&lang=vi&appid=b3a64e07a9cb08c942f2d1711c1d47e6";
        $data = Http::get($url)->json();

        $daily = $this->reformatDailyJson($data['daily']);

        $count = new RequestCount();
        $count->req_type = 3;
        $count->save();

        return view('web-front.dailyForecast',['daily'=>$daily]);
    }

    public function hourlyForecast(){
        $ip = $this->getIpAddress();
        $currentUserInfo = Location::get($ip);
        $lat= $currentUserInfo->latitude;
        $lon =$currentUserInfo->longitude;
        $url = "https://api.openweathermap.org/data/2.5/onecall?lat=".$lat."8&lon=".$lon."&exclude=daily,minutely,current&mode=json&units=metric&lang=vi&appid=b3a64e07a9cb08c942f2d1711c1d47e6";
        $data = Http::get($url)->json();

        $hourly = $this->reformatHourlyJson($data['hourly']);

        return view('web-front.hourly',['hourly'=>$hourly]);
    }

    public function about_us(){
        return view('web-front.about_us');
    }

    public function search(Request $req){
        $select = explode("-",$req->select);

        $lat = $select[1];
        $lon = $select[2];
        $name = $select[0];

        $location = [$lat,$lon,$name];

        $file_cities = public_path('cities/worldcities.csv');
        $cities = array_map('str_getcsv',file($file_cities));
        array_shift($cities);
        $city_list = [];
        foreach($cities as $c){
            $city = new City();

            $city->city = $c[0];
            $city->lat = $c[1];
            $city->lng = $c[2];
            $city->country = $c[3];

            array_push($city_list, $city);
        }

        $url = "https://api.openweathermap.org/data/2.5/onecall?lat=".$lat."8&lon=".$lon."&exclude=minutely,&mode=json&units=metric&lang=vi&appid=b3a64e07a9cb08c942f2d1711c1d47e6";
        $data = Http::get($url)->json();
        // return $lat.'-'.$lon.'-'.$name;

        // current weather
        $current = $this->reformatCurrentJson($data['current']);
        // daily weather
        $daily = $this->reformatDailyJson($data['daily']);
        // hourly weather
        $hourly = $this->reformatHourlyJson($data['hourly']);

        // return $city_list;
        return view('welcome',['cities'=>$city_list,'hourly'=>$hourly,'daily'=>$daily])->with('current',$current)->with('location',$location);
    }

    public function home(){
        $file_cities = public_path('cities/worldcities.csv');
        $cities = array_map('str_getcsv',file($file_cities));
        array_shift($cities);
        $city_list = [];
        $location = null;
        foreach($cities as $c){
            $city = new City();

            $city->city = $c[0];
            $city->lat = $c[1];
            $city->lng = $c[2];
            $city->country = $c[3];

            array_push($city_list, $city);
        }

        $ip = $this->getIpAddress();
        $currentUserInfo = Location::get($ip);
        $lat= $currentUserInfo->latitude;
        $lon =$currentUserInfo->longitude;
        $url = "https://api.openweathermap.org/data/2.5/onecall?lat=".$lat."&lon=".$lon."&exclude=minutely,&mode=json&units=metric&lang=vi&appid=b3a64e07a9cb08c942f2d1711c1d47e6";
        $data = Http::get($url)->json();
        // current weather
        $current = $this->reformatCurrentJson($data['current']);
        // daily weather
        $daily = $this->reformatDailyJson($data['daily']);
        // hourly weather
        $hourly = $this->reformatHourlyJson($data['hourly']);

        // return $city_list;
        return view('welcome',['cities'=>$city_list,'hourly'=>$hourly,'daily'=>$daily])->with('current',$current)->with('location',$location);
        // return $current;
        // return $daily;
        // return $hourly;
    }

    function reformatDailyJson($jsonData){
        $daily_list = [];

        foreach($jsonData as $dw){
            $dl = new Daily();

            foreach($dw['weather'] as $weather){
                $weather_id = $weather['id'];
                $weather_main = $weather['main'];
                $weather_desc = $weather['description'];
                $weather_icon = $weather['icon'];
            }

            $weather_desc = Str::ucfirst($weather_desc);
            $weather_icon_url = asset('img/icongif/'.$weather_icon.'.gif');
            $time = Carbon::createFromTimestamp($dw['dt'])->format('d/m');
            $sunrise = Carbon::createFromTimestamp($dw['sunrise'])->format('H:i A');
            $sunset = Carbon::createFromTimestamp($dw['sunset'])->format('H:i A');
            $moonrise = Carbon::createFromTimestamp($dw['moonrise'])->format('H:i A');
            $moonset = Carbon::createFromTimestamp($dw['moonset'])->format('H:i A');

            $dl->dt = $time;
            $dl->sunrise = $sunrise;
            $dl->sunset = $sunset;
            $dl->moonrise = $moonrise;
            $dl->moonset = $moonset;
            $dl->moon_phase = $dw['moon_phase'];
            $dl->temp_morn = $dw['temp']['morn'];
            $dl->temp_day = $dw['temp']['day'];
            $dl->temp_eve = $dw['temp']['eve'];
            $dl->temp_night = $dw['temp']['night'];
            $dl->temp_min = $dw['temp']['min'];
            $dl->temp_max = $dw['temp']['max'];
            $dl->pressure = $dw['pressure'];
            $dl->humidity = $dw['humidity'];
            $dl->dew_point = $dw['dew_point'];
            $dl->wind_speed = $dw['wind_speed'];
            $dl->wind_deg = $dw['wind_deg'];
            $dl->clouds = $dw['clouds'];
            $dl->pop = $dw['pop'];
            $dl->uvi = $dw['uvi'];
            $dl->weather_id = $weather_id;
            $dl->weather_main = $weather_main;
            $dl->weather_description = $weather_desc;
            $dl->weather_icon = $weather_icon_url;

            array_push($daily_list, $dl);
        }

        $count = new RequestCount();
        $count->req_type = 3;
        $count->save();
        return $daily_list;
    }

    function reformatHourlyJson($jsonData){
        $hourly_list = [];
        foreach($jsonData as $hw){
            $hr = new Hourly();
            foreach($hw['weather'] as $h_child){
                $weather_id = $h_child['id'];
                $weather_main = $h_child['main'];
                $weather_desc = $h_child['description'];
                $weather_icon = $h_child['icon'];
            }

            $weather_desc = Str::ucfirst($weather_desc);
            $weather_icon_url = asset('img/icongif/'.$weather_icon.'.gif');
            $time = Carbon::createFromTimestamp($hw['dt'])->format('H:i A');

            $hr->dt = $time;
            $hr->temp = $hw['temp'];
            $hr->feels_like = $hw['feels_like'];
            $hr->pressure = $hw['pressure'];
            $hr->humidity = $hw['humidity'];
            $hr->dew_point = $hw['dew_point'];
            $hr->clouds = $hw['clouds'];
            $hr->uvi = $hw['uvi'];
            $hr->visibility = $hw['visibility'];
            $hr->wind_speed = $hw['wind_speed'];
            $hr->wind_deg = $hw['wind_deg'];
            $hr->pop = $hw['pop'];
            $hr->weather_id = $weather_id;
            $hr->weather_main = $weather_main;
            $hr->weather_description = $weather_desc;
            $hr->weather_icon = $weather_icon_url;

            array_push($hourly_list,$hr);
        }

        $count = new RequestCount();
        $count->req_type = 2;
        $count->save();

        return $hourly_list;
    }

    function reformatCurrentJson($jsonData){
        $curr = new Current();
        foreach($jsonData['weather'] as $cw){
            $weather_id = $cw['id'];
            $weather_main = $cw['main'];
            $weather_desc = $cw['description'];
            $weather_icon = $cw['icon'];
        }
        $weather_desc = Str::ucfirst($weather_desc);
        $weather_icon_url = asset('img/icongif/'.$weather_icon.'.gif');
        $time = Carbon::createFromTimestamp($jsonData['dt'])->format('d/m/Y H:i A');
        $sunrise = Carbon::createFromTimestamp($jsonData['sunrise'])->format('H:i A');
        $sunset = Carbon::createFromTimestamp($jsonData['sunset'])->format('H:i A');

        $curr->dt = $time;
        $curr->sunrise = $sunrise;
        $curr->sunset = $sunset;
        $curr->temp = $jsonData['temp'];
        $curr->feels_like = $jsonData['feels_like'];
        $curr->pressure = $jsonData['pressure'];
        $curr->humidity = $jsonData['humidity'];
        $curr->dew_point = $jsonData['dew_point'];
        $curr->clouds = $jsonData['clouds'];
        $curr->uvi = $jsonData['uvi'];
        $curr->visibility = $jsonData['visibility'];
        $curr->wind_speed = $jsonData['wind_speed'];
        $curr->wind_deg = $jsonData['wind_deg'];
        $curr->weather_id = $weather_id;
        $curr->weather_main = $weather_main;
        $curr->weather_description = $weather_desc;
        $curr->weather_icon = $weather_icon_url;

        $count = new RequestCount();
        $count->req_type = 1;
        $count->save();

        return $curr;
    }
}
