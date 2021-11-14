<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Current;
use App\Models\Daily;
use App\Models\Hourly;
use App\Models\RequestCount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class WeatherController extends Controller
{
    public function daily(){
        $url = "https://api.openweathermap.org/data/2.5/onecall?lat=16.0678&lon=108.2208&exclude=hourly,minutely,current&mode=json&units=metric&appid=b3a64e07a9cb08c942f2d1711c1d47e6";
        $data = Http::get($url)->json();


        return response()->json($this->reformatDailyJson($data['daily']));
    }


    public function hourly(){
        $url = "https://api.openweathermap.org/data/2.5/onecall?lat=16.0678&lon=108.2208&exclude=daily,minutely,current&mode=json&units=metric&appid=b3a64e07a9cb08c942f2d1711c1d47e6";
        $data = Http::get($url)->json();
        return response()->json($this->reformatHourlyJson($data['hourly']));
    }

    public function current(){
        $url = "https://api.openweathermap.org/data/2.5/onecall?lat=16.0678&lon=108.2208&exclude=&mode=json&units=metric&appid=b3a64e07a9cb08c942f2d1711c1d47e6";
        $data = Http::get($url)->json();
        return response()->json($this->reformatCurrentJson($data['current']));
    }

    public function allin(){
        $url = "https://api.openweathermap.org/data/2.5/onecall?lat=16.0678&lon=108.2208&exclude=&mode=json&units=metric&appid=b3a64e07a9cb08c942f2d1711c1d47e6";
        $data = Http::get($url)->json();
        $current = $this->reformatCurrentJson($data['current']);
        $hourly = $this->reformatHourlyJson($data['hourly']);
        $daily = $this->reformatDailyJson($data['daily']);

        return response()->json([
            'current' => $current,
            'hourly' => $hourly,
            'daily' => $daily,
        ]);
    }

    public function get_weather(Request $req){
        $lat = $req->lat;
        $lon = $req->lon;
        $type = $req->type;
        $head_url = "https://api.openweathermap.org/data/2.5/onecall?lat=".$lat."&&lon=".$lon.'&lang=vi';
        $apikey="b3a64e07a9cb08c942f2d1711c1d47e6";
        $url_2 = "&mode=json&units=metric&appid=".$apikey;
        // type = 1 means current; 2 means hourly forecast; 3 means daily forecast; 4 means minutely forecast (4 is not used); 0 for all (except minutely)
        if($type == 1) $exclude = "hourly,daily,minutely";
        elseif($type == 2) $exclude = "current,daily,minutely";
        elseif($type == 3) $exclude = "current,hourly,minutely";
        elseif($type == 4) $exclude = "current,hourly,daily";
        elseif($type == 0) $exclude = "minutely";

        $url = $head_url."&&exclude=".$exclude.$url_2;
        $res = Http::get($url);
        $data = $res->json();

        $count = new RequestCount();
        $count->req_type = $type;
        $count->save();

        return $this->returnJsonResult($data, $type);
    }

    function returnJsonResult($jsonData, $type){
        if($type == 1) return response()->json($this->reformatCurrentJson($jsonData['current']));
        elseif($type == 2) return response()->json($this->reformatHourlyJson($jsonData['hourly']));
        elseif($type == 3) return response()->json($this->reformatDailyJson($jsonData['daily']));
        elseif($type == 4) return response()->json($jsonData);
        elseif($type == 0){
            $current = $this->reformatCurrentJson($jsonData['current']);
            $hourly = $this->reformatHourlyJson($jsonData['hourly']);
            $daily = $this->reformatDailyJson($jsonData['daily']);
            return response()->json([
                'current' => $current,
                'hourly' => $hourly,
                'daily' => $daily,
            ]);
        }
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

        return $curr;
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

        return $hourly_list;
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
        return $daily_list;
    }


}
