<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpinionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('pl_PL');    //pl_PL spowoduje ze dane bd polskie

        for($i =1; $i<=50; $i++)
        {
            DB::table('opinions')->insert([

                'content' => $faker->text(50),
                'rating' => $faker->numberBetween(1,5),
                'user_id' => $faker->numberBetween(1,10),

            ]);
        }
    }
}
