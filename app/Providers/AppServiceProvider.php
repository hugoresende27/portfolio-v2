<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('welcome.first', 'welcome-first');
        Blade::component('welcome.second', 'welcome-second');
        Blade::component('welcome.third', 'welcome-third');
        Blade::component('welcome.topbar', 'welcome-topbar');
    }
}
