<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create('pl_PL');    //pl_PL spowoduje ze dane bd polskie

        for($i =1; $i<=4; $i++)
        {
            DB::table('reservations')->insert([

                //w rental_day_in pojawia sie jakies daty 10 dni wstecz od teraz
                'rental_day_in' => $faker->dateTimeBetween('-10 days', 'now'),
                'rental_day_out' => $faker->dateTimeBetween('now', '+10 days'),
                'status' => $faker->boolean(50),
                'user_id' => $faker->numberBetween(2,10),
                'city_id' => $faker->numberBetween(1,2),
                'car_id' => $faker->numberBetween(1,10),

            ]);
        }
    }
}
