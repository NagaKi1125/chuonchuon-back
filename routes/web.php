<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LocationController;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {

    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::post('users', [LocationController::class, 'saveLocation'])->name('user.location');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('users',[AdminController::class, 'user_view'])->name('user.view');
    Route::get('cloud',[AdminController::class, 'cloud_view'])->name('cloud.view');
    Route::get('predict',[AdminController::class, 'predict_view'])->name('predict.view');
    Route::get('weather-explain',[AdminController::class, 'weather_explain'])->name('weather_explain.view');
});
