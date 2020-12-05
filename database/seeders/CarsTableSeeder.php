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
        //city1
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


        //city2
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

        //city3
        DB::table('cars')->insert([

            'model' => 'Clio',
            'brand' => 'Renault',
            'type' => 'hatchback',
            'engine' => '1.9',
            'fuel_type' => 'DIESEL',
            'color' => 'niebieski',
            'power' => 110,
            'price' => 220,
            'city_id' => 3,
        ]);

        DB::table('cars')->insert([

            'model' => 'Megane',
            'brand' => 'Renault',
            'type' => 'sedan',
            'engine' => '1.6',
            'fuel_type' => 'PB 95',
            'color' => 'zielony',
            'power' => 116,
            'price' => 239,
            'city_id' => 3,
        ]);

        DB::table('cars')->insert([

            'model' => 'Laguna',
            'brand' => 'Renault',
            'type' => 'kombi',
            'engine' => '1.6',
            'fuel_type' => 'PB 95',
            'color' => 'brązowy',
            'power' => 136,
            'price' => 299,
            'city_id' => 3,
        ]);

        DB::table('cars')->insert([

            'model' => 'Mustang',
            'brand' => 'Ford',
            'type' => 'sedan',
            'engine' => '3.0',
            'fuel_type' => 'PB 95',
            'color' => 'czarny',
            'power' => 336,
            'price' => 450,
            'city_id' => 3,
        ]);

        DB::table('cars')->insert([

            'model' => 'Mondeo',
            'brand' => 'Ford',
            'type' => 'sedan',
            'engine' => '2.0',
            'fuel_type' => 'PB 95',
            'color' => 'zielony',
            'power' => 120,
            'price' => 190,
            'city_id' => 3,
        ]);

        //city4
        DB::table('cars')->insert([

            'model' => 'Saxo',
            'brand' => 'Citroen',
            'type' => 'hatchback',
            'engine' => '1.4',
            'fuel_type' => 'DIESEL',
            'color' => 'niebieski',
            'power' => 100,
            'price' => 110,
            'city_id' => 4,
        ]);

        DB::table('cars')->insert([

            'model' => 'Duster',
            'brand' => 'Dacia',
            'type' => 'sedan',
            'engine' => '1.6',
            'fuel_type' => 'PB 95',
            'color' => 'czarny',
            'power' => 101,
            'price' => 95,
            'city_id' => 4,
        ]);

        DB::table('cars')->insert([

            'model' => 'Civic',
            'brand' => 'Honda',
            'type' => 'sedan',
            'engine' => '1.4',
            'fuel_type' => 'PB 95',
            'color' => 'srebrny',
            'power' => 90,
            'price' => 140,
            'city_id' => 4,
        ]);

        DB::table('cars')->insert([

            'model' => 'Coupe',
            'brand' => 'Hyundai',
            'type' => 'hathback',
            'engine' => '2.5',
            'fuel_type' => 'PB 95',
            'color' => 'źółty',
            'power' => 186,
            'price' => 250,
            'city_id' => 4,
        ]);

        DB::table('cars')->insert([

            'model' => 'Astra',
            'brand' => 'Opel',
            'type' => 'sedan',
            'engine' => '2.0',
            'fuel_type' => 'DIESEL',
            'color' => 'czerwony',
            'power' => 115,
            'price' => 130,
            'city_id' => 4,
        ]);

        //city5
        DB::table('cars')->insert([

            'model' => 'Saxo',
            'brand' => 'Citroen',
            'type' => 'hatchback',
            'engine' => '1.4',
            'fuel_type' => 'DIESEL',
            'color' => 'niebieski',
            'power' => 100,
            'price' => 110,
            'city_id' => 5,
        ]);

        DB::table('cars')->insert([

            'model' => 'Toledo',
            'brand' => 'Seat',
            'type' => 'sedan',
            'engine' => '2.6',
            'fuel_type' => 'PB 95',
            'color' => 'czarny',
            'power' => 201,
            'price' => 226,
            'city_id' => 5,
        ]);

        DB::table('cars')->insert([

            'model' => '9-3',
            'brand' => 'Saab',
            'type' => 'sedan',
            'engine' => '2.0t',
            'fuel_type' => 'PB 95',
            'color' => 'srebrny',
            'power' => 150,
            'price' => 290,
            'city_id' => 5,
        ]);

        DB::table('cars')->insert([

            'model' => 'Avensis',
            'brand' => 'Toyota',
            'type' => 'sedan',
            'engine' => '2.0',
            'fuel_type' => 'PB 95',
            'color' => 'czarny',
            'power' => 107,
            'price' => 150,
            'city_id' => 5,
        ]);

        DB::table('cars')->insert([

            'model' => 'V70',
            'brand' => 'Volvo',
            'type' => 'kombi',
            'engine' => '2.0',
            'fuel_type' => 'DIESEL',
            'color' => 'czerwony',
            'power' => 125,
            'price' => 230,
            'city_id' => 5,
        ]);

        //city6
        DB::table('cars')->insert([

            'model' => 'Fabia',
            'brand' => 'Skoda',
            'type' => 'hatchback',
            'engine' => '1.2',
            'fuel_type' => 'PB 95',
            'color' => 'niebieski',
            'power' => 60,
            'price' => 90,
            'city_id' => 6,
        ]);

        DB::table('cars')->insert([

            'model' => '406',
            'brand' => 'Peugeot',
            'type' => 'sedan',
            'engine' => '2.6',
            'fuel_type' => 'PB 95',
            'color' => 'czarny',
            'power' => 175,
            'price' => 295,
            'city_id' => 6,
        ]);

        DB::table('cars')->insert([

            'model' => '911',
            'brand' => 'Porshe',
            'type' => 'sedan',
            'engine' => '4.0t',
            'fuel_type' => 'PB 95',
            'color' => 'srebrny',
            'power' => 550,
            'price' => 690,
            'city_id' => 6,
        ]);

        DB::table('cars')->insert([

            'model' => 'B 180',
            'brand' => 'Mercedes',
            'type' => 'kombi',
            'engine' => '2.0',
            'fuel_type' => 'PB 95',
            'color' => 'czerwony',
            'power' => 147,
            'price' => 170,
            'city_id' => 6,
        ]);

        DB::table('cars')->insert([

            'model' => 'Ceed',
            'brand' => 'Kia',
            'type' => 'kombi',
            'engine' => '2.0',
            'fuel_type' => 'DIESEL',
            'color' => 'czerwony',
            'power' => 135,
            'price' => 180,
            'city_id' => 6,
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
