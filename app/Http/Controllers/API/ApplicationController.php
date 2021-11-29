<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cloud;
use App\Models\PredictResult;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function predictResult(Request $req){
        $code = $req->code;
        $img = $req->img;
        $cloud = Cloud::where('cloud_code',$code)->first();
        $time = date("Y-m-d-h-i-sa");

        $req->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4086',
        ]);

        if($req->hasFile('img')){
            $avaname = $time.'chuonchuon--'.$req->cloud_code.'--'.$req->file('img')->getClientOriginalName();

            if($req->file('img')->move(public_path('img/predicts/'),$avaname)){
                $img = "img/predicts/".$avaname;
            }else{
                $img = "not saved to public folder";
            }
        }else{
            $img = "1";
        }

        $predictResult = new PredictResult();
        $predictResult->user_id = '618fe2733726000004000993';
        $predictResult->img_predict = $img;
        $predictResult->cloud_code = $cloud->cloud_code;
        $predictResult->cloud_id = $cloud->_id;

        if($predictResult->save()){
            return response()->json([
                'cloud_name' => $cloud->cloud_name,
                'cloud_code' => $cloud->cloud_code,
                'structure' => $cloud->structure,
                'weather' => $cloud->weather,
                'note' => $cloud->note,
                'img' => $cloud->img_thumbnail,
                'message' => 'Success',
            ]);
        }else{
            return response()->json([
                'messeage' => 'Something went wrong',
            ]);
        }


    }
}
