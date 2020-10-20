<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsTableSeeder extends Seeder
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
            DB::table('contacts')->insert([

                'email' => $faker->email,
                'message_content' => $faker->sentence(10,true),

            ]);
        }
    }
}
