<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->userName,
        'password' => bcrypt(str_random(10)),
        'email' => $faker->email,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\AppKey::class, function (Faker\Generator $faker) {
    return [
        'app_key' => $faker->uuid,
    ];
});

$factory->define(App\Device::class, function (Faker\Generator $faker) {
    $ids = App\User::lists('id');
    $base = [
        'device_uuid' => $faker->uuid,
    ];
    if(count($ids)>0){
        if(random_int(0,100)<20){
            $id = $ids[random_int(0,count($ids)-1)];
            $base['user_id'] = $id;
        }
    }
    return $base;
});

$factory->define(App\Leaderboard::class, function (Faker\Generator $faker) {
    $ids = App\Device::lists('id');
    if(count($ids) == 0){
        factory(App\Device::class)->create();
        $device = App\Device::first();
    } else {
        $dbID = $ids[random_int(0,count($ids)-1)];
        $device = App\Device::find($dbID);
    }
    return [
        'device_id'=>$device->device_uuid,
        'user_id'=>$device->user_id,
        'score'=>$faker->randomDigit(1,10000)
    ];
});