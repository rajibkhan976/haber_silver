<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Modules\User\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routeCollection = Route::getRoutes();

        foreach ($routeCollection as $value) {
            $routes_list[] = Str::lower($value->getPath());
        }

        //store all permission into permission table
        foreach ($routes_list as $route)
        {
            $permission_exists = Permission::where('route_url','=',$route)->exists();
            if(!$permission_exists){
                $model = new Permission();
                $model->title = $route;
                $model->route_url = $route;
                $model->description = $route;
                $model->created_by = 1;
                $model->updated_by = 1;
                $model->created_at = '2017-01-01 00:00:00';
                $model->updated_at = '2017-01-01 00:00:00';
                DB::beginTransaction();

                    $model->save();
                    DB::commit();

            }

        }

    }
}
