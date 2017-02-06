<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UserNavComposer extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('user.parts.user-nav', 'App\Http\ViewComposers\UserNavComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
