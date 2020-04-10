<?php

namespace App\Providers;

use App\Coursework;
use App\Observers\CourseworkObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Coursework::observe(CourseworkObserver::class);
    }
}
