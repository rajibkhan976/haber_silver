<?php

use Illuminate\Database\Seeder;
use Modules\User\Models\RolePermission;

class RolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles_id = DB::table('roles')->where([['slug','admin']])->first();
        $query_permissions=DB::table('permissions')->get();

            foreach ($query_permissions as $values){
                $permissions_id =$values->id;
                $route_url      = $values->route_url;
                $permission_exists = RolePermission::where('permissions_id','=',$permissions_id)->exists();

                if(!$permission_exists){
                    DB::table('roles_permissions')->insert([
                            'roles_id' => $roles_id->id,
                            'permissions_id' => $permissions_id,
                            'status' => 'active',
                            'created_by' => 1,
                            'updated_by' => 1,
                            'created_at'=> '2017-01-01 00:00:00',
                            'updated_at'=>'2017-01-01 00:00:00',
                        ]);
                }
            }
    }
}
