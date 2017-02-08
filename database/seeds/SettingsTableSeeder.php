<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'type' => 'product-code',
            'last_number' => '2',
            'increment' => '2',
            'status' => 'active',
            'code' => 'bgin',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at'=> '2017-01-01 00:00:00',
            'updated_at'=>'2017-01-01 00:00:00',
        ]);
    }
}
