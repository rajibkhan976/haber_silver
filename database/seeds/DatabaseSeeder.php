<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Users Table Seeder
        $this->call(UserTableSeeder::class);

        //Roles Table Seeder
        $this->call(RoleTableSeeder::class);

        //Country Table Seeder
        $this->call(CountryTableSeeder::class);

    }
}
