<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('pl_PL');    //pl_PL spowoduje ze dane bd polskie

        for($i =1; $i<=60; $i++)
        {
            DB::table('notifications')->insert([

                'content' => $faker->sentence(10,true),
                'status' => $faker->boolean(50),
                'shown' => $faker->boolean(0),
                'user_id' => $faker->numberBetween(1,10),

            ]);
        }
    }
}
