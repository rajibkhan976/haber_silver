<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles_id = DB::table('roles')->where([['slug','admin']])->first();

        DB::table('users')->insert([
            'username' => 'admin@admin.com',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'first_name' => 'admin',
            'last_name' => 'admin',
            'image' => '',
            'thumb' => '',
            'auth_key'  => '',
            'access_token'  => '',
            'ip_address' => '',
            'last_visit' => '2017-01-01 00:00:00',
            'roles_id' => $roles_id->id,
            'status' => 'active',
            'remember_token' => str_random(10),
            'created_by' => 1,
            'updated_by' => 1,
            'created_at'=> '2017-01-01 00:00:00',
            'updated_at'=>'2017-01-01 00:00:00',
        ]);

    }
}
