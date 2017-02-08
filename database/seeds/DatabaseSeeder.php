<?php

use Illuminate\Database\Seeder;
//use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Roles Table Seeder
        $this->call(RoleTableSeeder::class);

        //Permissions Table Seeder
        $this->call(PermissionsTableSeeder::class);

        //SuperAdminSeeder users Table Seeder
        $this->call(SuperAdminSeeder::class);

        //AdminUserSeeder users Table Seeder
        $this->call(AdminUserSeeder::class);

        //RolesPermissions Table Seeder
        $this->call(RolesPermissionsTableSeeder::class);

        //Users Table Seeder
       // $this->call(UserTableSeeder::class);

        //Country Table Seeder
        $this->call(CountryTableSeeder::class);

        //Menu Panel Seeder
        $this->call(MenuPanelSeeder::class);
    }
}
