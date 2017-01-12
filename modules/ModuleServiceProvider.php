<?php

/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 10/31/16
 * Time: 6:16 PM
 */

namespace Modules;

use Illuminate\Support\ServiceProvider;


class ModuleServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $modules = config("module.modules");
        while (list(,$module) = each($modules)) {
            if(file_exists(__DIR__.'/'.$module.'/routes/routes.php')) {
                include __DIR__.'/'.$module.'/routes/routes.php';
            }
            if(is_dir(__DIR__.'/'.$module.'/Views')) {
                $this->loadViewsFrom(__DIR__.'/'.$module.'/Views', $module);
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }



}