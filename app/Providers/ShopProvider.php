<?php

namespace App\Providers;

use Amsgames\LaravelShop\LaravelShop;
use Illuminate\Support\ServiceProvider;

class ShopProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['shop'] = $this->app->share(function($app)
        {
            return new LaravelShop($app);
        });
    }
}
