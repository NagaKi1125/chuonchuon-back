<?php

namespace App\Http\Controllers;

use App\Models\WeatherExplanation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeatherExplainController extends Controller
{
    public function getExplain(){
        $explain_checked = WeatherExplanation::where('checked',1)->get();
        $explain_un_checked = WeatherExplanation::where('checked',0)->get();
        return view('admin/weather-explain', ['checked'=>$explain_checked, 'unchecked'=>$explain_un_checked]);
    }

    public function checked($id){
        $explain = WeatherExplanation::find($id);
        $explain->checked = 1;
        $explain->save();
        return redirect()->route('weather_explain.view');
    }

    public function unChecked($id){
        $explain = WeatherExplanation::find($id);
        $explain->checked = 0;
        $explain->save();
        return redirect()->route('weather_explain.view');
    }

    public function store(Request $req, $uid){
        $explain = new WeatherExplanation();
        $explain->type = $req->type;
        $explain->explanation = $req->explanation;
        $explain->user_id = $uid;
        $explain->checked = 1; // checked post form admin site means it's already proofed
        $explain->save();

        return redirect()->route('weather_explain.view');
    }

    public function edit(Request $req, $id, $uid){
        $explain = WeatherExplanation::find($id);
        $explain->type = $req->type;
        $explain->explanation = $req->explanation;
        $explain->user_id = $uid;
        $explain->save();
        return redirect()->route('weather_explain.view');
    }

    public function delete($id){
        $explain = WeatherExplanation::find($id);
        $explain->delete();
        return redirect()->route('weather_explain.view');
    }

}
