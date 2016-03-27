<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'api','middleware'=>['appkey']],function(){
    Route::post('devices', 'DeviceController@index');
    Route::post('devices/register','DeviceController@registerForDeviceId');
    Route::post('devices/login','DeviceController@signInWithCurrentDevice');
    Route::post('devices/logout','DeviceController@logOutOfCurrentDevice');
    Route::post('leaderboard','LeaderboardController@index');
    Route::post('leaderboard/submit','LeaderboardController@addToLeaderboard');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
