<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
			['title' => 'super-admin', 'slug' => 'super-admin', 'status'=>'active','created_by'=>'1','updated_by'=>'1'],
            ['title' => 'admin', 'slug' => 'admin', 'status'=>'active','created_by'=>'1','updated_by'=>'1'],
            ['title' => 'cms-user', 'slug' => 'cms-user', 'status'=>'active','created_by'=>'1','updated_by'=>'1'],
            ['title' => 'site-user', 'slug' => 'site-user', 'status'=>'active','created_by'=>'1','updated_by'=>'1'],
            ['title' => 'distributor', 'slug' => 'distributor', 'status'=>'active','created_by'=>'1','updated_by'=>'1'],

        ]);
    }
}
