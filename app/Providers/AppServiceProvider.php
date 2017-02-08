<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    protected $no_image;
    protected $video_not_found;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       view()->share('no_image', 'assets/images/admin/no_img.jpg');
       view()->share('video_not_found','assets/images/admin/video_not_found.jpg');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
