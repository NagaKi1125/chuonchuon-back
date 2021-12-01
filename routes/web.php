<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CloudController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\WeatherExplainController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin/dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::post('users', [LocationController::class, 'saveLocation'])->name('user.location');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('users',[AdminController::class, 'user_view'])->name('user.view');
    Route::prefix('user')->group( function() {
        Route::put('update/{id}',[AdminController::class, 'updateUser'])->name('user.update');
        Route::delete('delete/{id}',[AdminController::class, 'deleteUser'])->name('user.delete');
    });

    Route::get('cloud',[CloudController::class, 'cloud_view'])->name('cloud.view');
    Route::prefix('cloud')->group( function() {
        Route::get('add', [CloudController::class, 'getAdd'])->name('cloud.add');
        Route::post('store',[CloudController::class, 'store_cloud'])->name('cloud.store');
        Route::put('edit/{cloud_id}',[CloudController::class, 'edit'])->name('cloud.edit');
        Route::delete('delete/{cloud_id}',[CloudController::class,'delete'])->name('cloud.delete');
    });

    Route::get('predict',[AdminController::class, 'predict_view'])->name('predict.view');

    Route::get('weather-explain',[WeatherExplainController::class, 'getExplain'])->name('weather_explain.view');
    Route::prefix('explain')->group(function () {
        Route::post('store/{uid}', [WeatherExplainController::class, 'store'])->name('explain.store');
        Route::put('edit/{id}/{uid}', [WeatherExplainController::class, 'edit'])->name('explain.edit');
        Route::get('check/{id}', [WeatherExplainController::class, 'checked'])->name('explain.checked');
        Route::get('un-check/{id}', [WeatherExplainController::class, 'unChecked'])->name('explain.un_checked');
        Route::delete('delete/{id}', [WeatherExplainController::class, 'delete'])->name('explain.delete');
    });

});
