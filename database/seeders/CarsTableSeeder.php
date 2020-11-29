<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create('pl_PL');    //pl_PL spowoduje ze dane bd polskie

        for($i =1; $i<=20; $i++)
        {
            DB::table('cars')->insert([

                'model' => $faker->word,
                'brand' => $faker->word,
                'type' => $faker->word,
                'engine' => $faker->word,
                'fuel_type' => $faker->word,
                'color' => $faker->word,
                'power' => $faker->numberBetween(60,163),
                'price' => $faker->numberBetween(200, 400),
                'city_id' => $faker->numberBetween(1,10),
            ]);
        }
    }
}
