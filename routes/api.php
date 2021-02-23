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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::post('/login', 'Api\AuthController@login');
Route::post('login', 'App\Http\Controllers\API\UserController@login');
Route::post('setting', 'App\Http\Controllers\API\UserController@getsetting');
Route::post('register', 'App\Http\Controllers\API\UserController@register');
Route::post('store', 'App\Http\Controllers\API\UserController@store');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'App\Http\Controllers\API\UserController@details');
});
Route::apiResources(
	[
		'user' => 'API\UserController'
	]
);

Route::post('index', 'App\Http\Controllers\API\BatteryController@index');
Route::post('update', 'App\Http\Controllers\API\BatteryController@update');
Route::post('destroy', 'App\Http\Controllers\API\BatteryController@destroy');