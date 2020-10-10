<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('pl_PL'); //przywolanie biblioteki Faker
        //argument funkcji create zapewni nam polskie dane podczas losowego tworzenia.

        for($i =1; $i<=10; $i++)
        {
            DB::table('users')->insert([

                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'email' => $faker->email,
                'password' => bcrypt('password'),
                'phone' => $faker->phoneNumber,

            ]);
        }
    }
}
