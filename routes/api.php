<?php

use App\Http\Controllers\API\ApplicationController;
use App\Http\Controllers\API\UserRequest;
use App\Http\Controllers\API\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('weather-daily',[WeatherController::class, 'daily']);
Route::get('weather-minutely',[WeatherController::class, 'minutely']);
Route::get('weather-hourly',[WeatherController::class, 'hourly']);
Route::get('weather-current',[WeatherController::class, 'current']);
Route::get('weather',[WeatherController::class, 'allin']);

Route::post('weather-now',[WeatherController::class,"get_weather"]);
Route::post('predict',[ApplicationController::class, "predictResult"]);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
], function () {
    Route::post('/login', [UserRequest::class, 'login']);
    Route::post('/register', [UserRequest::class, 'register']);
    Route::post('/logout', [UserRequest::class, 'logout']);
    Route::post('/refresh', [UserRequest::class, 'refresh']);
    Route::get('/user-profile', [UserRequest::class, 'userProfile']);
    Route::post('/change-pass', [UserRequest::class, 'changePassWord']);
});
