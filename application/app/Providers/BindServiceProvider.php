<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     * @return void
     */
    public function boot()
    {
        App::bind('App\Contracts\RepositoryInterface','App\Repositories\UserRepository');
    }
}
