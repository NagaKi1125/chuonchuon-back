<?php

namespace App\Http\Controllers;

use App\Models\Cloud;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CloudController extends Controller
{


    public function cloud_view(){
        $cloud = Cloud::all();
        return view('cloud-manager', ['cloud'=>$cloud]);
    }

    public function getAdd(){
        return view('cloud-add');
    }
    public function store_cloud(Request $req){
        $cloud = new Cloud();
        $cloud->cloud_code = $req->cloud_code;
        $cloud->cloud_name = $req->cloud_name;
        $cloud->structure = $req->structure;
        $cloud->weather = $req->weather;
        $cloud->note = $req->note;
        $time = date("Y-m-d-h-i-sa");
        $img_thumbnail = "";

        $req->validate([
            'img_thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($req->hasFile('img_thumbnail')){
            $avaname = $time.'chuonchuon--'.$req->cloud_code.'--'.$req->file('img_thumbnail')->getClientOriginalName();

            if($req->file('img_thumbnail')->move(public_path('img/uploads/'),$avaname)){
                $img_thumbnail = "img/uploads/".$avaname;
            }else{
                $img_thumbnail = "not saved to public folder";
            }
        }else{
            $img_thumbnail = "1";
        }
        $cloud->img_thumbnail = $img_thumbnail;

        if($cloud->save()){
            return redirect()->route('cloud.view');
        }else{
            return redirect()->route('cloud.add');
        }
    }

    public function delete($cloud_id){
        $cloud = Cloud::find($cloud_id);
        $cloud->delete();
        return redirect()->route('cloud.view');
    }

    public function edit(Request $req, $cloud_id){
        $cloud = Cloud::find($cloud_id);
        $cloud->cloud_code = $req->cloud_code;
        $cloud->cloud_name = $req->cloud_name;
        $cloud->structure = $req->structure;
        $cloud->weather = $req->weather;
        $cloud->note = $req->note;
        $time = date("Y-m-d-h-i-sa");
        $img_thumbnail = "";

        if($req->hasFile('img_thumbnail')){
            if(Str::contains($cloud->img_thumbnail, $req->file('img_thumbnail')->getClientOriginalName())){
                $img_thumbnail = $cloud->img_thumbnail;
            }else{
                $avaname = $time.'chuonchuon--'.$req->cloud_code.'--'.$req->file('img_thumbnail')->getClientOriginalName();
                $req->file('img_thumbnail')->move(public_path('img\uploads'),$avaname);
                $img_thumbnail = "img/uploads/".$avaname;
            }
        }else{
            $img_thumbnail = $cloud->img_thumbnail;
        }
        $cloud->img_thumbnail = $img_thumbnail;
        $cloud->save();

        return redirect()->route('cloud.view');
    }
}
