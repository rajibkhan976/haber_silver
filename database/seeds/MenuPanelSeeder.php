<?php

use Illuminate\Database\Seeder;

class MenuPanelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_panel')->insert(
            ['menu_id' => '1', 'menu_type' => 'ROOT', 'menu_name'=>'ROOT','route'=>'#','parent_menu_id'=>'1','icon_code'=>'ROOT001','menu_order'=>'0','status'=>'active','created_by'=>'1','updated_by'=>'1' ]);
    }
}
