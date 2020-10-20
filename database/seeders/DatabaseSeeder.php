<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(OpinionsTableSeeder::class);
        $this->call(PhotosTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(CarsTableSeeder::class);
        $this->call(ReservationsTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
    }
}
