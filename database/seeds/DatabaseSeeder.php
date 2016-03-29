<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AppKey::class,1)->create();
        factory(App\User::class,10)->create();
        factory(App\Device::class,10)->create();
//        factory(App\Leaderboard::class,1000)->create();
    }
}
