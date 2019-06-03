<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\UserInterface;
use App\Repository\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
     //  $this->app->singleton(UserInterface::class,UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
