<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('pl_PL');    //pl_PL spowoduje ze dane bd polskie

        DB::table('roles')->insert([

            'user_id' => $faker->unique()->numberBetween(1,1),
            'role_name' => $faker->randomElement(['admin']),

        ]);

        for($i =1; $i<=9; $i++)
        {
            DB::table('roles')->insert([

                'user_id' => $faker->unique()->numberBetween(2,10),
                'role_name' => $faker->randomElement(['client']),

            ]);
        }


    }
}
