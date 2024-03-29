<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('pl_PL');    //pl_PL spowoduje ze dane bd polskie

        for($i =1; $i<=10; $i++)
        {
            DB::table('cities')->insert([

                'name' => $faker->unique()->city,

            ]);
        }
    }
}
