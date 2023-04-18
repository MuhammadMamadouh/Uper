<?php

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
Route::post('submit', 'App\Http\Controllers\LoginController@submit');
Route::post('verfiy', 'App\Http\Controllers\LoginController@verify');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('driver', 'App\Http\Controllers\DriverController@show');
    Route::post('driver', 'App\Http\Controllers\DriverController@update');

    Route::post('/trip', [App\Http\Controllers\TripController::class, 'store']);
    Route::get('/trip/{trip}', [App\Http\Controllers\TripController::class, 'show']);
    Route::post('/trip/{trip}/accept', [App\Http\Controllers\TripController::class, 'accept']);
    Route::post('/trip/{trip}/start', [App\Http\Controllers\TripController::class, 'start']);
    Route::post('/trip/{trip}/end', [App\Http\Controllers\TripController::class, 'end']);
    Route::post('/trip/{trip}/location', [App\Http\Controllers\TripController::class, 'location']);

    // Route::get('trips', 'App\Http\Controllers\TripController@index');
    // Route::post('trips', 'App\Http\Controllers\TripController@store');
    // Route::get('trips/{trip}', 'App\Http\Controllers\TripController@show');
    // Route::post('trips/{trip}/cancel', 'App\Http\Controllers\TripController@cancel');
    // Route::post('trips/{trip}/complete', 'App\Http\Controllers\TripController@complete');
    // Route::post('trips/{trip}/rate', 'App\Http\Controllers\TripController@rate');
});
