<?php

namespace App\Http\Controllers;

use App\Models\PredictResult;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function user_view(){
        $user = User::paginate(15);
        return view('admin/user-manager',['user'=>$user]);
    }

    public function weather_explain(){
        return view('admin/weather-explain');
    }

    public function editUser($id){
        $user = User::find($id);
        return view('admin/user-edit', ['user'=>$user]);
    }

    public function updateUser(Request $req, $id){
        $user = User::find($id);

        $user->name = $req->name;
        $user->email = $req->email;
        $user->level = $req->level;
        $user->save();
        return redirect()->route('user.view');

    }

    public function deleteUser($id){
        $user = User::find($id);
        $user->level = 0;
        $user->save();
        return redirect()->route('user.view');
    }

    public function predict_view(){
        $result = PredictResult::paginate(60);
        return view('admin/predict-result',['result'=>$result]);
    }
}
