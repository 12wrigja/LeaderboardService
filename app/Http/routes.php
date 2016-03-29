<?php

Route::group(['prefix'=>'api','middleware'=>['appkey']],function(){
    Route::post('devices', 'DeviceController@index');
    Route::post('devices/register','DeviceController@registerForDeviceId');
    Route::post('devices/login','DeviceController@signInWithCurrentDevice');
    Route::post('devices/logout','DeviceController@logOutOfCurrentDevice');
    Route::post('leaderboard','LeaderboardController@index');
    Route::post('register','Auth\AuthController@register');
    Route::post('leaderboard/submit','LeaderboardController@addToLeaderboard');
});