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

        DB::table('cars')->insert([

                'model' => 'A3',
                'brand' => 'Audi',
                'type' => 'sedan',
                'engine' => '1.8t',
                'fuel_type' => 'PB 95',
                'color' => 'czarny',
                'power' => 163,
                'price' => 249,
                'city_id' => 1,
        ]);

        DB::table('cars')->insert([

            'model' => 'A4',
            'brand' => 'Audi',
            'type' => 'kombi',
            'engine' => '2.0',
            'fuel_type' => 'DIESEL',
            'color' => 'żółty',
            'power' => 131,
            'price' => 346,
            'city_id' => 1,
        ]);

        DB::table('cars')->insert([

            'model' => 'E36',
            'brand' => 'BMW',
            'type' => 'sedan',
            'engine' => '1.8',
            'fuel_type' => 'DIESEL',
            'color' => 'zielony',
            'power' => 131,
            'price' => 346,
            'city_id' => 1,
        ]);


        DB::table('cars')->insert([

            'model' => 'E60',
            'brand' => 'BMW',
            'type' => 'kombi',
            'engine' => '2.8',
            'fuel_type' => 'PB 95',
            'color' => 'czerwony',
            'power' => 192,
            'price' => 400,
            'city_id' => 1,
        ]);

        DB::table('cars')->insert([

            'model' => 'E92',
            'brand' => 'BMW',
            'type' => 'sedan',
            'engine' => '3.0',
            'fuel_type' => 'DIESEL',
            'color' => 'niebieski',
            'power' => 200,
            'price' => 568,
            'city_id' => 1,
        ]);



        DB::table('cars')->insert([

            'model' => 'W124',
            'brand' => 'Mercedes',
            'type' => 'sedan',
            'engine' => '3.0',
            'fuel_type' => 'DIESEL',
            'color' => 'fioletowy',
            'power' => 90,
            'price' => 336,
            'city_id' => 2,
        ]);

        DB::table('cars')->insert([

            'model' => 'W200',
            'brand' => 'Mercedes',
            'type' => 'kombi',
            'engine' => '2.4',
            'fuel_type' => 'PB 95',
            'color' => 'czarny',
            'power' => 130,
            'price' => 205,
            'city_id' => 2,
        ]);

        DB::table('cars')->insert([

            'model' => 'Panda',
            'brand' => 'Fiat',
            'type' => 'hatchback',
            'engine' => '1.4',
            'fuel_type' => 'PB 95',
            'color' => 'czarny',
            'power' => 60,
            'price' => 130,
            'city_id' => 2,
        ]);

        DB::table('cars')->insert([

            'model' => 'Lybra',
            'brand' => 'Lancia',
            'type' => 'sedan',
            'engine' => '1.9',
            'fuel_type' => 'DIESEL',
            'color' => 'srebrny',
            'power' => 115,
            'price' => 195,
            'city_id' => 2,
        ]);

        DB::table('cars')->insert([

            'model' => 'Passat',
            'brand' => 'Volkswagen',
            'type' => 'kombi',
            'engine' => '1.9',
            'fuel_type' => 'DIESEL',
            'color' => 'niebieski',
            'power' => 130,
            'price' => 260,
            'city_id' => 2,
        ]);

//        $faker = Factory::create('pl_PL');    //pl_PL spowoduje ze dane bd polskie
//
//        for($i =1; $i<=20; $i++)
//        {
//            DB::table('cars')->insert([
//
//                'model' => $faker->word,
//                'brand' => $faker->word,
//                'type' => $faker->word,
//                'engine' => $faker->word,
//                'fuel_type' => $faker->word,
//                'color' => $faker->word,
//                'power' => $faker->numberBetween(60,163),
//                'price' => $faker->numberBetween(200, 400),
//                'city_id' => $faker->numberBetween(1,10),
//            ]);
//        }
    }
}
