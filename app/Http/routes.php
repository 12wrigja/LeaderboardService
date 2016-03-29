<?php

Route::group(['prefix'=>'api','middleware'=>['appkey']],function(){
    Route::post('devices', 'DeviceController@index');
    Route::post('devices/register','DeviceController@registerForDeviceId');
    Route::post('devices/login','DeviceController@signInWithCurrentDevice');
    Route::post('devices/logout','DeviceController@logOutOfCurrentDevice');
    Route::post('leaderboard','LeaderboardController@index');
    Route::post('register',function(){
        $request = request();
        $response =  (new \App\Http\Controllers\Auth\AuthController)->postRegister($request);
        return $response;
    });
    Route::post('leaderboard/submit','LeaderboardController@addToLeaderboard');
});