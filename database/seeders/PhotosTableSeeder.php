<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('pl_PL');    //pl_PL spowoduje ze dane bd polskie

        //dla userow
        for($i =1; $i<=10; $i++)
        {
            DB::table('photos')->insert([
                'photoable_type' => 'App\User',
                'photoable_id' => $faker->unique()->numberBetween(1,10),
                'path' => $faker->imageUrl(275,150,'people'), //wykorzystuje lorempixel
            ]);

        }

        //dla aut
        for($i =1; $i<=40; $i++)
        {
            DB::table('photos')->insert([
                'photoable_type' => 'App\Car',
                'photoable_id' => $faker->numberBetween(1,10),
                'path' => $faker->imageUrl(800,400,'transport'),
                //wykorzystuje lorempixel
            ]);

        }
    }
}
